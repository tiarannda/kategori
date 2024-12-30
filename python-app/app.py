from flask import Flask, request, jsonify
from datetime import datetime
import mysql.connector

app = Flask(__name__)

def get_db_connection():
    """
    Fungsi untuk koneksi ke database MySQL.
    """
    conn = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',  # Ganti dengan password MySQL Anda
        database='iCareService'
    )
    return conn

@app.route('/get_data', methods=['GET'])
def get_data():
    """
    Rute untuk mendapatkan data barang dan total penjualan dari laporan berdasarkan bulan dan tahun tertentu.
    """
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)

    # Ambil parameter bulan dan tahun dari query string, default ke bulan dan tahun saat ini
    month = int(request.args.get('month', datetime.now().month))
    year = int(request.args.get('year', datetime.now().year))

    try:
        # Ambil semua barang dari tabel barangs
        cursor.execute('SELECT id_barang, nama_barang, harga, stok_saat_ini FROM barangs')
        barang_data = cursor.fetchall()

        # Ambil total penjualan berdasarkan laporan bulanan
        cursor.execute('''
            SELECT id_barang, SUM(total_barang_keluar) AS total_barang_keluar
            FROM laporans
            WHERE MONTH(tanggal_laporan) = %s AND YEAR(tanggal_laporan) = %s
            GROUP BY id_barang
        ''', (month, year))
        laporan_data = {row['id_barang']: row['total_barang_keluar'] for row in cursor.fetchall()}

        # Gabungkan data barang dengan total penjualan
        for barang in barang_data:
            barang['C3'] = laporan_data.get(barang['id_barang'], 0)  # Isi 0 jika tidak ada data

    except mysql.connector.Error as err:
        return jsonify({'error': str(err)}), 500
    finally:
        cursor.close()
        conn.close()

    return jsonify(barang_data)

@app.route('/hitung', methods=['POST'])
def hitung_saw():
    """
    Rute untuk menghitung skor SAW berdasarkan alternatif dan bobot yang diberikan.
    """
    data = request.get_json()
    alternatif = data.get('alternatif', [])
    bobot = data.get('bobot', {})

    if not alternatif or not bobot:
        return jsonify({'error': 'Data alternatif atau bobot tidak ditemukan!'}), 400

    try:
        # Normalisasi data
        max_c1 = max([item['C1'] for item in alternatif])
        max_c2 = min([item['C2'] for item in alternatif])
        max_c3 = max([item['C3'] for item in alternatif])

        hasil = []
        for item in alternatif:
            normalisasi_c1 = item['C1'] / max_c1
            normalisasi_c2 = item['C2'] / max_c2
            normalisasi_c3 = item['C3'] / max_c3
            skor_saw = (
                normalisasi_c1 * bobot.get('C1', 0) +
                normalisasi_c2 * bobot.get('C2', 0) +
                normalisasi_c3 * bobot.get('C3', 0)
            )
            hasil.append({
                'nama': item['nama_barang'],
                'C1': item['C1'],
                'C2': item['C2'],
                'C3': item['C3'],
                'skor_saw': skor_saw
            })

    except Exception as e:
        return jsonify({'error': str(e)}), 500

    return jsonify(hasil)

if __name__ == '__main__':
    app.run(debug=True)
