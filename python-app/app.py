from flask import Flask, render_template
import pandas as pd
import pymysql
from decimal import Decimal

app = Flask(__name__)

# Database connection
def get_db_connection():
    return pymysql.connect(
        host='localhost',
        user='root',
        password='',
        database='iCareService',
        cursorclass=pymysql.cursors.DictCursor
    )

# Fetch data from database
def fetch_data():
    connection = get_db_connection()
    try:
        with connection.cursor() as cursor:
            # Fetch data from barangs table
            cursor.execute("SELECT id_barang, nama_barang AS nama, harga FROM barangs")
            barangs = pd.DataFrame(cursor.fetchall())

            # Fetch data from transaksis table for C2 (beli) and C3 (jual)
            cursor.execute("SELECT id_barang, SUM(jumlah_barang) AS jumlah_beli FROM transaksis WHERE tipe_transaksi = 'beli' GROUP BY id_barang")
            barang_masuk = pd.DataFrame(cursor.fetchall())

            cursor.execute("SELECT id_barang, SUM(jumlah_barang) AS jumlah_jual FROM transaksis WHERE tipe_transaksi = 'jual' GROUP BY id_barang")
            barang_keluar = pd.DataFrame(cursor.fetchall())

            return barangs, barang_masuk, barang_keluar
    finally:
        connection.close()

# Prepare decision matrix
def prepare_decision_matrix():
    barangs, barang_masuk, barang_keluar = fetch_data()

    # Merge barang masuk and keluar into decision matrix
    decision_matrix = barangs.copy()
    decision_matrix = decision_matrix.merge(barang_masuk, on="id_barang", how="left")
    decision_matrix = decision_matrix.merge(barang_keluar, on="id_barang", how="left", suffixes=("_beli", "_jual"))

    # Replace NaN with 0 for C2 and C3
    decision_matrix.fillna({"jumlah_beli": 0, "jumlah_jual": 0}, inplace=True)

    # Rename columns
    decision_matrix.rename(columns={"harga": "C1", "jumlah_beli": "C2", "jumlah_jual": "C3"}, inplace=True)

    return decision_matrix

# Normalize decision matrix
def normalize_column(column, maximize=True):
    # Avoid division by zero
    min_val = column.min()
    max_val = column.max()

    if maximize:
        return column / max_val
    else:
        if min_val == 0:
            return column  # or handle this case differently (e.g., return NaN or a fixed value)
        else:
            return min_val / column

def normalize_and_calculate_scores(decision_matrix):
    normalized_matrix = decision_matrix.copy()
    normalized_matrix["C1"] = normalize_column(decision_matrix["C1"], maximize=True)
    normalized_matrix["C2"] = normalize_column(decision_matrix["C2"], maximize=False)
    normalized_matrix["C3"] = normalize_column(decision_matrix["C3"], maximize=True)

    # AHP weights (user-defined or calculated via pairwise comparison)
    weights = {
        "C1": 0.5,  # Price importance
        "C2": 0.3,  # Minimum stock importance
        "C3": 0.2   # Maximum sales importance
    }

    # Calculate SAW scores (use Decimal to avoid float-Decimal issues)
    normalized_matrix["Score"] = (
        normalized_matrix["C1"].apply(Decimal) * Decimal(str(weights["C1"])) +
        normalized_matrix["C2"].apply(Decimal) * Decimal(str(weights["C2"])) +
        normalized_matrix["C3"].apply(Decimal) * Decimal(str(weights["C3"]))
    )

    # Round C1, C2, C3, and Score to 2 decimal places
    normalized_matrix["C1"] = normalized_matrix["C1"].round(2)
    normalized_matrix["C2"] = normalized_matrix["C2"].round(2)
    normalized_matrix["C3"] = normalized_matrix["C3"].round(2)
    normalized_matrix["Score"] = normalized_matrix["Score"].round(2)

    # Rank items
    normalized_matrix.sort_values(by="Score", ascending=False, inplace=True)
    return normalized_matrix

def create_dashboard_data():
    decision_matrix = prepare_decision_matrix()
    normalized_matrix = normalize_and_calculate_scores(decision_matrix)

    # Ambil barang dengan skor tertinggi
    best_item = normalized_matrix.iloc[0].to_dict()  # Ambil item dengan skor tertinggi (pertama setelah diurutkan)

    return {
        "decision_matrix": decision_matrix.to_dict(orient="records"),
        "normalized_matrix": normalized_matrix.to_dict(orient="records"),
        "best_item": best_item  # Menambahkan data barang dengan skor tertinggi
    }


@app.route('/')
def dashboard():
    data = create_dashboard_data()
    return render_template('index.html', data=data)

if __name__ == '__main__':
    app.run(debug=True)
