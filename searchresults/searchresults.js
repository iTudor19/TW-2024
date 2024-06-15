const apiKey = '30525dbccc50717fd5dafc1219c94c9c'; // Ensure this is your correct and active TMDB API key

async function fetchMovies(endpoint) {
    const url = `https://api.themoviedb.org/3/${endpoint}&api_key=${apiKey}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data.results;
    } catch (error) {
        console.error('Error fetching movies:', error);
        return null;
    }
}

async function displaySearchResults(query) {
    const movies = await fetchMovies(`search/movie?query=${encodeURIComponent(query)}`);
    const container = document.querySelector('.search-results-container');
    container.innerHTML = ''; // Clear previous content

    if (!movies || movies.length === 0) {
        container.innerHTML = '<p>No results found.</p>';
        return;
    }

    movies.forEach(movie => {
        const movieCard = document.createElement('div');
        movieCard.className = 'movie-card';
        movieCard.innerHTML = `
            <a href="../aboutmoviepage/aboutmovie.html?movieId=${movie.id}" style="text-decoration: none;">
                <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title}">
                <p class="movie-name">${movie.title}</p>
                <p class="movie-rating">Rating: ${movie.vote_average}</p>
            </a>
        `;
        container.appendChild(movieCard);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('query');
    if (query) {
        displaySearchResults(query);
    }
});
