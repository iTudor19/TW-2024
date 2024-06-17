import sqlite3
import pandas as pd

# Funcție pentru a crea și popula baza de date
def create_database(db_name):
    # Conectare la baza de date
    conn = sqlite3.connect(db_name)
    cursor = conn.cursor()

    # Citirea datelor din fișierele CSV
    disney_plus_df = pd.read_csv('disney_plus_titles.csv')
    netflix_titles_df = pd.read_csv('netflix_titles.csv')

    # Crearea tabelului media_d
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS media_d (
            show_id TEXT,
            type TEXT,
            title TEXT,
            director TEXT,
            cast TEXT,
            country TEXT,
            date_added TEXT,
            release_year INTEGER,
            rating TEXT,
            duration TEXT,
            listed_in TEXT,
            description TEXT
        )
    ''')

    # Inserarea datelor în tabelul media_d
    for row in disney_plus_df.itertuples():
        cursor.execute('''
            INSERT INTO media_d (show_id, type, title, director, cast, country, date_added, release_year, rating, duration, listed_in, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ''', (row.show_id, row.type, row.title, row.director, row.cast, row.country, row.date_added, row.release_year, row.rating, row.duration, row.listed_in, row.description))

    # Crearea tabelului media_n
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS media_n (
            show_id TEXT,
            type TEXT,
            title TEXT,
            director TEXT,
            cast TEXT,
            country TEXT,
            date_added TEXT,
            release_year INTEGER,
            rating TEXT,
            duration TEXT,
            listed_in TEXT,
            description TEXT
        )
    ''')

    # Inserarea datelor în tabelul media_n
    for row in netflix_titles_df.itertuples():
        cursor.execute('''
            INSERT INTO media_n (show_id, type, title, director, cast, country, date_added, release_year, rating, duration, listed_in, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ''', (row.show_id, row.type, row.title, row.director, row.cast, row.country, row.date_added, row.release_year, row.rating, row.duration, row.listed_in, row.description))

    # Crearea tabelului users
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT,
            email TEXT,
            password TEXT
        )
    ''')

    # Inserarea unei intrări exemplu în tabelul users
    cursor.execute('''
        INSERT INTO users (username, email, password)
        VALUES (?, ?, ?)
    ''', ('example_user', 'user@example.com', 'securepassword'))

    # Confirmarea și închiderea conexiunii la baza de date
    conn.commit()
    conn.close()

# Apelarea funcției pentru a crea și popula baza de date
create_database('BD_final.db')
