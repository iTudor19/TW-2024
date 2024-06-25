// movies.js
document.addEventListener('DOMContentLoaded', function() {
  const letterLinks = document.querySelectorAll('.letter-link');

  letterLinks.forEach(function(letterLink) {
      letterLink.addEventListener('click', function(event) {
          event.preventDefault();
          const letter = letterLink.getAttribute('data-letter');
          const service = "<?php echo isset($_GET['service']) ? $_GET['service'] : ''; ?>";
          window.location.href = `movieslogged.php?service=${service}&letter=${letter}`;
      });
  });
});

  
  function fetchMovies(letter) {
    fetch(`http://localhost:8081/movieslogged?letter=${letter}`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(movies => {
        displayMovies(movies);
      })
      .catch(error => {
        console.error('Error fetching movies:', error);
      });
  }
  
  function displayMovies(movies) {
    const container = document.querySelector('.movie-containerL');
  
    if (!movies || movies.length === 0) {
      container.innerHTML = '<p>No movies found</p>';
      return;
    }
  
    container.innerHTML = ''; // Clear previous movies
    movies.forEach(movie => {
      const movieCard = document.createElement('div');
      movieCard.className = 'movie-card';
      movieCard.innerHTML = `
        <h2>${movie.title}</h2>
        <p>Director: ${movie.director}</p>
        <p>Rating: ${movie.rating}</p>
      `;
      container.appendChild(movieCard);
    });
  }
  

