const apiKey = '30525dbccc50717fd5dafc1219c94c9c'; // Replace with your TMDB API key

async function fetchMovies(endpoint) {
    const url = `https://api.themoviedb.org/3/${endpoint}?api_key=${apiKey}`;
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

async function displayMovies(section, endpoint) {
    const movies = await fetchMovies(endpoint);
    const container = document.querySelector(section);
    container.innerHTML = ''; // Clear previous content

    if (!movies) {
        container.innerHTML = '<p>Error loading movies.</p>';
        return;
    }

    movies.forEach(movie => {
        const movieCard = document.createElement('div');
        movieCard.className = 'movie-card';
        movieCard.innerHTML = `
            <a href="../aboutmoviepage/aboutmovie.html?movieId=${movie.id}" style="text-decoration: none;">
                <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title || movie.name}">
                <p class="movie-name">${movie.title || movie.name}</p>
                <p class="movie-rating">Rating: ${movie.vote_average}</p>
            </a>
        `;
        container.appendChild(movieCard);
    });
}

// Fetch and display data when the page loads
document.addEventListener('DOMContentLoaded', () => {
    displayMovies('.movie-containerT', 'trending/movie/week');
    displayMovies('.movie-containerL', 'movie/now_playing');
    displayMovies('.movie-containerU', 'movie/upcoming');

    const searchForm = document.getElementById('searchForm');
    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const searchInput = document.getElementById('searchInput');
        const query = searchInput.value.trim();

        if (query) {
            window.location.href = `../searchresults/searchresults.html?query=${encodeURIComponent(query)}`;
        } else {
            window.location.href = `../searchresults/searchresults.html?query=`;
        }
    });
});
