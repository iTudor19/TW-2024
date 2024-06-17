import pandas as pd
import sqlite3

csv_file = 'disney_plus_titles.csv'
db_file = 'media_d.db'

df = pd.read_csv(csv_file)

conn = sqlite3.connect(db_file)

df.to_sql('disney_plus_titles', conn, if_exists='replace', index=False)

conn.close()

print(f"Datele din {csv_file} au fost importate cu succes in baza de date {db_file}.")
