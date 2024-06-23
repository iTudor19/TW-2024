const sqlite3 = require('sqlite3').verbose();

// Deschidem conexiunea la baza de date
let db = new sqlite3.Database('./BD_final.db', (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Connected to the media database.');
});







// Interogare pentru a adăuga un nou utilizator în tabelul `users`
// let insertUser = `INSERT INTO users (username, email, password) VALUES (?, ?, ?)`;
// let newUser = ['new_user', 'new_user@example.com', 'securepassword'];

// db.run(insertUser, newUser, function(err) {
//     if (err) {
//         return console.error(err.message);
//     }
//     console.log(`A new user has been inserted with rowid ${this.lastID}`);
// });







// let deleteUser = `DELETE FROM users WHERE username = ?`;
// let usernameToDelete = 'new_user';

// db.run(deleteUser, usernameToDelete, function (err) {
//     if (err) {
//         return console.error(err.message);
//     }
//     console.log(`User ${usernameToDelete} has been deleted`);
// });







// Închidem conexiunea la baza de date
db.close((err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Close the database connection.');
});