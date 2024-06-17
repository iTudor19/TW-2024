const sqlite3 = require('sqlite3').verbose();

// Conectează-te la baza de date
let db = new sqlite3.Database('media_n.db', (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Connected to the media database.');
});

// Interoghează baza de date pentru a număra intrările cu release_year 2020
let sql = `SELECT COUNT(*) AS count FROM netflix_titles WHERE release_year = 2020`;

db.get(sql, [], (err, row) => {
    if (err) {
        throw err;
    }
    console.log(`Numărul de înregistrări cu release_year 2020: ${row.count}`);
});

// Închide conexiunea la baza de date
db.close((err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Close the database connection.');
});