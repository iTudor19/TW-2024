// script.js

// Function to fetch movie details from TMDB API
async function fetchMovieDetails(movieId) {
    const apiKey = 'YOUR_TMDB_API_KEY';
    const url = `https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=en-US`;

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Failed to fetch movie details');
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching movie details:', error.message);
    }
}

// Function to update HTML with fetched movie details
async function updateMovieDetails() {
    // Replace 'movieId' with the actual ID of the movie you want to fetch
    const movieId = '12345'; // Example movie ID

    const movieDetails = await fetchMovieDetails(movieId);
    if (!movieDetails) return;

    // Update HTML elements with fetched movie details
    document.getElementById('movie-title').textContent = movieDetails.title;
    document.getElementById('movie-overview').textContent = movieDetails.overview;
    document.getElementById('release-date').textContent = movieDetails.release_date;
    document.getElementById('genres').textContent = movieDetails.genres.map(genre => genre.name).join(', ');
    document.getElementById('cast').textContent = movieDetails.credits.cast.slice(0, 5).map(actor => actor.name).join(', ');
    document.getElementById('duration').textContent = `${movieDetails.runtime} min`;
    document.getElementById('countries').textContent = movieDetails.production_countries.map(country => country.name).join(', ');
    document.getElementById('languages').textContent = movieDetails.spoken_languages.map(language => language.english_name).join(', ');
}

// Call updateMovieDetails function when the page loads
window.onload = updateMovieDetails;
