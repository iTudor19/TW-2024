const apiKey = '30525dbccc50717fd5dafc1219c94c9c';

async function fetchMovieDetails(movieId) {
    const url = `https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=en-US&append_to_response=credits`;

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

async function updateMovieDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get('movieId');

    if (!movieId) {
        console.error('No movieId found in query parameter');
        return;
    }

    const movieDetails = await fetchMovieDetails(movieId);
    if (!movieDetails) return;

    document.getElementById('movie-title').textContent = movieDetails.title;
    document.querySelector('.movieposter').src = `https://image.tmdb.org/t/p/w500${movieDetails.poster_path}`;
    document.getElementById('movie-overview').textContent = movieDetails.overview;
    document.getElementById('release-date').textContent = movieDetails.release_date;
    document.getElementById('genres').textContent = movieDetails.genres.map(genre => genre.name).join(', ');
    document.getElementById('languages').textContent = movieDetails.spoken_languages.map(language => language.english_name).join(', ');

    const castList = movieDetails.credits.cast.slice(0, 5);
    const castElement = document.getElementById('cast');
    castElement.innerHTML = '';

    castList.forEach(actor => {
        const actorLink = document.createElement('a');
        actorLink.href = `../aboutactor/aboutactor.html?actorId=${actor.id}`;
        actorLink.textContent = actor.name;
        actorLink.style.color = 'inherit';
        actorLink.style.textDecoration = 'none';
        actorLink.style.marginRight = '10px';s
        castElement.appendChild(actorLink);
    });

    document.getElementById('duration').textContent = `${movieDetails.runtime} min`;
    const countriesList = movieDetails.production_countries.map(country => country.name);
    document.getElementById('countries').textContent = countriesList.join(', ');
}

window.onload = updateMovieDetails;