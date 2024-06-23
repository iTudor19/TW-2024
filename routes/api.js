const url = require('url');
const db = require('../db/db'); // Ensure this path is correct

function handleGetRequest(req, res) {
  const parsedUrl = url.parse(req.url, true);

  console.log(`Request received: ${parsedUrl.pathname}`); // Debug log

  if (parsedUrl.pathname === '/movies' && req.method === 'GET') {
    const letter = parsedUrl.query.letter || 'A'; // Default to "A" if no letter is provided
    console.log(`Query letter: ${letter}`); // Debug log

    db.all(`SELECT * FROM media_n WHERE title LIKE ?`, [`${letter}%`], (err, rows) => {
      if (err) {
        console.error('Database error:', err); // Log the error
        res.writeHead(500, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ error: 'Database error' }));
        return;
      }

      res.writeHead(200, { 'Content-Type': 'application/json' });
      res.end(JSON.stringify(rows));
    });
  } else {
    console.log('Endpoint not found'); // Debug log
    res.writeHead(404, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ error: 'Endpoint not found' }));
  }
}

module.exports = handleGetRequest;
