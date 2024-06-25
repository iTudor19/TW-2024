const apiKey = '30525dbccc50717fd5dafc1219c94c9c'; 

async function fetchContent(endpoint) {
    const url = `https://api.themoviedb.org/3/${endpoint}?api_key=${apiKey}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data.results;
    } catch (error) {
        console.error('Error fetching content:', error);
        return null;
    }
}

async function displayTopMovies() {
    const movies = await fetchContent('movie/top_rated');
    const container = document.querySelector('.top-movies-container');

    if (!container) {
        console.error('Top movies container not found.');
        return;
    }

    container.innerHTML = ''; // Clear previous content

    if (!movies || movies.length === 0) {
        container.innerHTML = '<p>No top movies found.</p>';
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

async function displayTopTVShows() {
    const tvShows = await fetchContent('tv/top_rated');
    const container = document.querySelector('.top-tvshows-container');

    if (!container) {
        console.error('Top TV shows container not found.');
        return;
    }

    container.innerHTML = ''; // Clear previous content

    if (!tvShows || tvShows.length === 0) {
        container.innerHTML = '<p>No top TV shows found.</p>';
        return;
    }

    tvShows.forEach(tvShow => {
        const tvShowCard = document.createElement('div');
        tvShowCard.className = 'movie-card';
        tvShowCard.innerHTML = `
            <a href="../aboutmoviepage/aboutmovie.html?tvShowId=${tvShow.id}" style="text-decoration: none;">
                <img src="https://image.tmdb.org/t/p/w500${tvShow.poster_path}" alt="${tvShow.name}">
                <p class="movie-name">${tvShow.name}</p>
                <p class="movie-rating">Rating: ${tvShow.vote_average}</p>
            </a>
        `;
        container.appendChild(tvShowCard);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    displayTopMovies();
    displayTopTVShows();
});
