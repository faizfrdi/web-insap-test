import pandas as pd
import sqlalchemy
from sqlalchemy import create_engine
import pickle
from flask import Flask, request, jsonify
import os
import shutil
import json
import re
app = Flask(__name__)

# @app.route('/model_faq', methods=['POST'])
def proses(text):
    from sentence_transformers import SentenceTransformer

    # Membuka file model.pkl
    current_dir = os.path.abspath(os.path.join(os.path.dirname(__file__)))
    embedding_path = os.path.join(current_dir, 'resources/faq_embeddings.pkl')
    model_path = os.path.join(current_dir, 'my_model/')

    # calling data
    with open(embedding_path, 'rb') as file:
            df_pickle = pickle.load(file)

    # calling model
    model = SentenceTransformer(model_path)

    query_vec = model.encode(text, convert_to_numpy=True)

    # Hitung kemiripan cosine similarity
    from sklearn.metrics.pairwise import cosine_similarity
    scores = cosine_similarity([query_vec], list(df_pickle['embedding']))

    # Ambil sebagai array 1 dimensi
    similarities = scores[0]

    # Ambil indeks top-5 skor tertinggi (dari besar ke kecil)
    top_indices = similarities.argsort()[-5:][::-1]

    # Ambil baris dari DataFrame sesuai top indeks
    top_answers = df_pickle.iloc[top_indices].copy()

    # Hanya ambil kolom 'answer' (atau lainnya jika ingin lebih)
    answers_clean = [
        re.sub(r'[\n\r\t\\]+', ' ', str(a)).strip()
        for a in top_answers['answer'].tolist()
    ]

    data_result = {
        'Top 5 Jawaban Terdekat': answers_clean
    }

    # top_idx = scores[0].argmax()

    # # Tambahkan skor cosine ke dalam DataFrame
    # # top_answers['similarity'] = similarities[top_indices]

    # # Ambil hanya kolom yang relevan
    # data_result = df_pickle.iloc[top_idx]['answer'].to_dict()
    # Output ke stdout untuk dibaca PHP
    print(json.dumps(data_result, ensure_ascii=False))

def generate():
    print("Proses Generate")
    from sentence_transformers import SentenceTransformer

    # Ganti 'sqlite:///namafile.db' sesuai jenis DBMS kamu (PostgreSQL, MySQL, dsb)
    engine = create_engine('mysql+pymysql://root:4dh11nf0@localhost:3306/web_sap_adhi')
    # Tes koneksi
    try:
        with engine.connect() as connection:
            print("✅ Koneksi ke database berhasil.")
    except Exception as e:
        print("❌ Gagal konek ke database:", e)

    try:
        print(type(engine))
        df_faq_jasa_konstruksis = pd.read_sql("SELECT * FROM faq_jasa_konstruksis", engine)
        df_faq_jasa_konstruksi_sd_modules = pd.read_sql("SELECT * FROM faq_jasa_konstruksi_sd_modules", engine)
        df_faq_jasa_konstruksi_ps_modules = pd.read_sql("SELECT * FROM faq_jasa_konstruksi_ps_modules", engine)
        df_faq_jasa_konstruksi_mm_modules = pd.read_sql("SELECT * FROM faq_jasa_konstruksi_mm_modules", engine)
        df_faq_jasa_konstruksi_fi_modules = pd.read_sql("SELECT * FROM faq_jasa_konstruksi_fi_modules", engine)
        df_faq_jasa_konstruksi_co_fm_modules = pd.read_sql("SELECT * FROM faq_jasa_konstruksi_co_fm_modules", engine)
        print("✅ Data berhasil dibaca.")
    except Exception as e:
        print("❌ Gagal membaca data:", e)

    print(engine)

    df_all = pd.concat([df_faq_jasa_konstruksis, df_faq_jasa_konstruksi_sd_modules, df_faq_jasa_konstruksi_ps_modules, df_faq_jasa_konstruksi_mm_modules, df_faq_jasa_konstruksi_fi_modules, df_faq_jasa_konstruksi_co_fm_modules], ignore_index=True)

    model = SentenceTransformer('all-MiniLM-L6-v2')
    df_all['embedding'] = model.encode(df_all['question'].values.tolist(), convert_to_numpy=True).tolist()

    # simpan data
    current_dir = os.path.abspath(os.path.join(os.path.dirname(__file__)))
    file_name = os.path.join(current_dir, 'resources/faq_embeddings.pkl')
    model_path = os.path.join(current_dir, 'my_model/')

    # model_path = 'public/python/my_model/'
    # file_name = 'public/python/resoruces/faq_embeddings.pkl'

    df_all.to_pickle(file_name)
    print(f"Data saved to {file_name}")

    #simpan model
    

    # Jika folder sudah ada, hapus dulu
    if os.path.exists(model_path):
        shutil.rmtree(model_path)

    model.save(model_path)
    print(f"Model saved to {model_path}")

if __name__ == "__main__":
    import sys
    if len(sys.argv) > 1:
        if sys.argv[1] == 'generate':
             generate()
        else:   
            print(sys.argv[1])
            proses(sys.argv[1])
    else:
        print("Masukkan teks.")
