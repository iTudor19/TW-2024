document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost:5500/database/netflix_titles.csv') // Asigură-te că acest URL este corect
        .then(response => response.text())
        .then(data => {
            Papa.parse(data, {
                header: true,
                dynamicTyping: true,
                complete: function (results) {
                    const movieDatabase = results.data.map(row => ({
                        type: row['type'],
                        title: row['title'],
                        director: row['director'] ? row['director'].split(', ') : [],
                        cast: row['cast'] ? row['cast'].split(', ') : [],
                        country: row['country'] || "",
                        date_added: row['date_added'] || "",
                        release_year: row['release_year'],
                        rating: row['rating'] || "",
                        duration: row['duration'] || "",
                        listed_in: row['listed_in'] ? row['listed_in'].split(', ') : [],
                        description: row['description'] || ""
                    }));

                    displayData(movieDatabase);
                }
            });
        });
});

function displayData(data) {
    const table = document.createElement('table');
    table.border = '1';

    // Adaugă antetul tabelului
    const headerRow = table.insertRow();
    const headers = ['Type', 'Title', 'Director', 'Cast', 'Country', 'Date Added', 'Release Year', 'Rating', 'Duration', 'Listed In', 'Description'];
    headers.forEach(headerText => {
        const headerCell = document.createElement('th');
        headerCell.textContent = headerText;
        headerRow.appendChild(headerCell);
    });

    // Adaugă datele în tabel
    data.forEach(item => {
        const row = table.insertRow();
        row.insertCell().textContent = item.type;
        row.insertCell().textContent = item.title;
        row.insertCell().textContent = item.director.join(', ');
        row.insertCell().textContent = item.cast.join(', ');
        row.insertCell().textContent = item.country;
        row.insertCell().textContent = item.date_added;
        row.insertCell().textContent = item.release_year;
        row.insertCell().textContent = item.rating;
        row.insertCell().textContent = item.duration;
        row.insertCell().textContent = item.listed_in.join(', ');
        row.insertCell().textContent = item.description;
    });

    document.body.appendChild(table);
}
