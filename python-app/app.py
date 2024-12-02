from flask import Flask, request, jsonify, render_template
import pandas as pd

app = Flask(__name__)

@app.route('/hitung', methods=['POST'])
def hitung():
    # Data yang diterima dari request JSON
    data = request.json

    # Validasi input JSON
    if not data or 'alternatif' not in data or 'bobot' not in data:
        return jsonify({"error": "Data tidak lengkap"}), 400

    alternatif = data['alternatif']
    bobot = data['bobot']

    # Konversi data alternatif ke DataFrame
    df = pd.DataFrame(alternatif)

    # Normalisasi nilai kriteria
    # Kriteria C1: Cost (minimizing)
    df['C1_normalisasi'] = df['C1'].min() / df['C1']

    # Kriteria C2: Benefit (maximizing)
    df['C2_normalisasi'] = df['C2'] / df['C2'].max()

    # Kriteria C3: Benefit (maximizing)
    df['C3_normalisasi'] = df['C3'] / df['C3'].max()

    # Hitung Skor SAW
    df['skor_saw'] = (
        df['C1_normalisasi'] * bobot['C1'] +
        df['C2_normalisasi'] * bobot['C2'] +
        df['C3_normalisasi'] * bobot['C3']
    )

    # Urutkan berdasarkan skor
    hasil = df[['nama', 'C1_normalisasi', 'C2_normalisasi', 'C3_normalisasi', 'skor_saw']]\
        .sort_values(by='skor_saw', ascending=False).to_dict(orient='records')

    return jsonify(hasil)

@app.route('/')
def index():
    return render_template('index.html')  # Pastikan template index.html ada di folder templates

if __name__ == "__main__":
    app.run(debug=True)
