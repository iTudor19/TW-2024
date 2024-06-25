const apiKey = '30525dbccc50717fd5dafc1219c94c9c';

async function fetchActorDetails(actorId) {
    const url = `https://api.themoviedb.org/3/person/${actorId}?api_key=${apiKey}&language=en-US&append_to_response=combined_credits`;

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Failed to fetch actor details');
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching actor details:', error.message);
    }
}

async function updateActorDetails() {
    const params = new URLSearchParams(window.location.search);
    const actorId = params.get('actorId');

    if (!actorId) {
        console.error('No actorId found in query parameter');
        return;
    }

    const actorDetails = await fetchActorDetails(actorId);
    if (!actorDetails) return;

    document.getElementById('actor-name').textContent = actorDetails.name;
    document.querySelector('.actorphoto').src = `https://image.tmdb.org/t/p/w500${actorDetails.profile_path}`;
    document.getElementById('actor-biography').textContent = actorDetails.biography;
    document.getElementById('actor-birthdate').textContent = actorDetails.birthday ? new Date(actorDetails.birthday).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : 'N/A';
    document.getElementById('actor-nationality').textContent = actorDetails.place_of_birth ? actorDetails.place_of_birth : 'N/A';

    const movies = actorDetails.combined_credits.cast.filter(movie => movie.media_type === 'movie').slice(0, 5);
    const moviesElement = document.getElementById('actor-movies');
    moviesElement.innerHTML = '';

    movies.forEach(movie => {
        const movieLink = document.createElement('a');
        movieLink.href = `../aboutmoviepageRo/aboutmovieRo.php?movieId=${movie.id}`;
        movieLink.textContent = movie.title;
        movieLink.style.color = 'inherit';
        movieLink.style.textDecoration = 'none';
        movieLink.style.marginRight = '10px';
        moviesElement.appendChild(movieLink);
    });

    document.getElementById('actor-height').textContent = actorDetails.height ? `${actorDetails.height} cm` : 'N/A';
    document.getElementById('actor-weight').textContent = actorDetails.weight ? `${actorDetails.weight} kg` : 'N/A';
    document.getElementById('actor-languages').textContent = actorDetails.languages ? actorDetails.languages.join(', ') : 'N/A';
}

window.onload = updateActorDetails;