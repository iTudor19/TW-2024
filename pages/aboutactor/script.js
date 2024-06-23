const apiKey = '30525dbccc50717fd5dafc1219c94c9c'; // Replace with your TMDB API key

// Function to fetch actor details from TMDB API
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

// Function to update HTML with fetched actor details
async function updateActorDetails() {
    // Extract actorId from query parameter
    const params = new URLSearchParams(window.location.search);
    const actorId = params.get('actorId');

    if (!actorId) {
        console.error('No actorId found in query parameter');
        return;
    }

    const actorDetails = await fetchActorDetails(actorId);
    if (!actorDetails) return;

    // Update HTML elements with fetched actor details
    document.getElementById('actor-name').textContent = actorDetails.name;
    document.querySelector('.actorphoto').src = `https://image.tmdb.org/t/p/w500${actorDetails.profile_path}`;
    document.getElementById('actor-biography').textContent = actorDetails.biography;
    document.getElementById('actor-birthdate').textContent = actorDetails.birthday ? new Date(actorDetails.birthday).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) : 'N/A';
    document.getElementById('actor-nationality').textContent = actorDetails.place_of_birth ? actorDetails.place_of_birth : 'N/A';

    // Fetch actor's movies and update
    const movies = actorDetails.combined_credits.cast.filter(movie => movie.media_type === 'movie').slice(0, 5); // Limit to 5 movies
    const moviesElement = document.getElementById('actor-movies');
    moviesElement.innerHTML = ''; // Clear previous content

    movies.forEach(movie => {
        const movieLink = document.createElement('a');
        movieLink.href = `../aboutmoviepage/aboutmovie.html?movieId=${movie.id}`;
        movieLink.textContent = movie.title;
        movieLink.style.color = 'inherit';
        movieLink.style.textDecoration = 'none';
        movieLink.style.marginRight = '10px'; // Optional: Adjust spacing between movie titles
        moviesElement.appendChild(movieLink);
    });

    // Update other actor details like height, weight, languages (if available)
    document.getElementById('actor-height').textContent = actorDetails.height ? `${actorDetails.height} cm` : 'N/A';
    document.getElementById('actor-weight').textContent = actorDetails.weight ? `${actorDetails.weight} kg` : 'N/A';
    document.getElementById('actor-languages').textContent = actorDetails.languages ? actorDetails.languages.join(', ') : 'N/A';
}

// Call updateActorDetails function when the page loads
window.onload = updateActorDetails;