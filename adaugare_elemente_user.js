const sqlite3 = require('sqlite3').verbose();

let db = new sqlite3.Database('users.db', (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Connected to the users database.');
});

db.run(`CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)`, (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Table created or already exists.');
});

function addUser(username, email, password) {
    db.run(`INSERT INTO users (username, email, password) VALUES (?, ?, ?)`, [username, email, password], function(err) {
        if (err) {
            return console.error(err.message);
        }
        console.log(`User ${username} added successfully with ID ${this.lastID}`);
    });
}

addUser('dave', 'dave@example.com', 'davepassword');

db.close((err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Closed the database connection.');
});
