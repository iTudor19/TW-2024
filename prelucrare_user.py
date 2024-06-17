import sqlite3

# Conectează-te la baza de date (sau creează-o dacă nu există)
conn = sqlite3.connect('users.db')

# Creează un cursor pentru a executa comenzi SQL
cursor = conn.cursor()

# Creează tabelul users
cursor.execute('''
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )
''')

# Confirmă schimbările
conn.commit()

# Închide conexiunea la baza de date
conn.close()

print("Database and table created successfully.")
