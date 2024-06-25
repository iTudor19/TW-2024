document.addEventListener('DOMContentLoaded', function() {
  const letterLinks = document.querySelectorAll('.letter-link');

  letterLinks.forEach(function(letterLink) {
      letterLink.addEventListener('click', function(event) {
          event.preventDefault();
          const letter = letterLink.getAttribute('data-letter');
          const service = "<?php echo isset($_GET['service']) ? $_GET['service'] : ''; ?>";
          window.location.href = `tvshows.php?service=${service}&letter=${letter}`;
      });
  });
});

function fetchTVShows(service, letter) {
  const url = `tvshows.php?service=${service}&letter=${letter}`;
  fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(html => {
      const container = document.querySelector('.movie-containerL');
      container.innerHTML = html;
    })
    .catch(error => {
      console.error('Error fetching TV shows:', error);
    });
}
