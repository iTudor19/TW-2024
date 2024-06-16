const apiKey = '30525dbccc50717fd5dafc1219c94c9c'; // Replace with your TMDB API key

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

async function displayContent(sectionId, endpoint) {
    const content = await fetchContent(endpoint);
    const container = document.getElementById(sectionId);
    container.innerHTML = ''; // Clear previous content

    if (!content) {
        container.innerHTML = '<p>Error loading content.</p>';
        return;
    }

    content.forEach(item => {
        const contentCard = document.createElement('div');
        contentCard.className = 'content-card';
        contentCard.innerHTML = `
            <a href="../aboutmoviepage/aboutmovie.html?movieId=${item.id}" style="text-decoration: none;">
                <img src="https://image.tmdb.org/t/p/w500${item.poster_path}" alt="${item.title || item.name}">
                <p class="content-name">${item.title || item.name}</p>
                <p class="content-rating">Rating: ${item.vote_average}</p>
            </a>
        `;
        container.appendChild(contentCard);
    });
}

// Fetch and display data when the page loads
document.addEventListener('DOMContentLoaded', () => {
    displayContent('containerT', 'trending/movie/week');
    displayContent('containerL', 'movie/now_playing');
    displayContent('containerU', 'movie/upcoming');

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

    const toggleButtons = document.querySelectorAll('.toggle-button');
    toggleButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const section = event.target.getAttribute('data-section');
            const type = event.target.getAttribute('data-type');
            let endpoint = '';

            if (section === 'T') {
                endpoint = type === 'movie' ? 'trending/movie/week' : 'trending/tv/week';
            } else if (section === 'L') {
                endpoint = type === 'movie' ? 'movie/now_playing' : 'tv/on_the_air';
            } else if (section === 'U') {
                endpoint = type === 'movie' ? 'movie/upcoming' : 'tv/airing_today';
            }

            displayContent(`container${section}`, endpoint);
        });
    });
});
