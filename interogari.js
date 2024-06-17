const sqlite3 = require('sqlite3').verbose();

// Deschidem conexiunea la baza de date
let db = new sqlite3.Database('./BD_final.db', (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Connected to the media database.');
});

// Interogare pentru numărul de intrări din `media_d` cu `release_year` 2020
let query1 = `SELECT COUNT(*) AS count FROM media_d WHERE release_year = 2020`;
db.get(query1, (err, row) => {
    if (err) {
        console.error(err.message);
    }
    console.log(`Number of entries in media_d with release_year 2020: ${row.count}`);
});

// Interogare pentru numărul de intrări din `media_n` cu `release_year` 2021
let query2 = `SELECT COUNT(*) AS count FROM media_n WHERE release_year = 2021`;
db.get(query2, (err, row) => {
    if (err) {
        console.error(err.message);
    }
    console.log(`Number of entries in media_n with release_year 2021: ${row.count}`);
});

// Interogare pentru obținerea unui `username` din tabelul `users`
let query3 = `SELECT username FROM users LIMIT 1`;
db.get(query3, (err, row) => {
    if (err) {
        console.error(err.message);
    }
    console.log(`Username from users table: ${row.username}`);
});

// Închidem conexiunea la baza de date
db.close((err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Close the database connection.');
});
