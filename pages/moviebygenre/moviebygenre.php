<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviesByGenre</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <a href="../homepage/home.php" style="text-decoration: none;">
        <h1>MoX</h1>
    </a>
    <a href="../signuppageUser/signup.php">
        <button class="signup-button">Sign Up</button>
    </a>
    <p class="p0">GENRE</p>
    <p class="p1">MOVIES</p>
    <p class="p2">TV SHOWS</p>
    <p class="p3">TOP TMDB</p>
    <a href="../getstartedpageRO/getstartedRo.php" style="text-decoration: none;">
        <button class="lang-button">en</button>
    </a>
</header>

<div class="service-buttons">
    <a href="moviebygenre.php?service=netflix"><button class="service-button" id="netflix-button">Netflix</button></a>
    <a href="moviebygenre.php?service=disney"><button class="service-button" id="disney-button">Disney+</button></a>
</div>

<div class="genre-buttons">
    <form action="moviebygenre.php" method="get">
        <?php
        // Define genres array
        $genres = [
            "Action", "Adventure", "Animation", "Comedy", "Crime",
            "Documentary", "Drama", "Family", "Fantasy", "Horror",
            "Music", "Mystery", "Romance", "Science Fiction", "Thriller",
            "War"
        ];

        // Retrieve selected service from query parameter
        $selectedService = isset($_GET['service']) ? $_GET['service'] : '';

        // Display hidden input for selected service
        if ($selectedService) {
            echo '<input type="hidden" name="service" value="' . htmlspecialchars($selectedService) . '">';
        }

        // Display genre checkboxes dynamically
        foreach ($genres as $genre) {
            echo '<input type="checkbox" id="' . $genre . '" name="genres[]" value="' . $genre . '"';
            if (isset($_GET['genres']) && in_array($genre, $_GET['genres'])) {
                echo ' checked';
            }
            echo '><label for="' . $genre . '">' . $genre . '</label>';
        }
        ?>
        <button type="submit">Search</button>
    </form>
</div>

<div class="movie-containerL">
    <!-- Movies will be dynamically loaded here -->
    <?php
    try {
        // Connect to SQLite database
        $db = new SQLite3('../../db/BD_final.db');

        // Default table to fetch movies from
        $table = 'media_d'; // Default to Disney+ table

        // Change table based on selected service
        if ($selectedService === 'netflix') {
            $table = 'media_n'; // Netflix table
        }

        // Retrieve selected genres from query parameter
        $selectedGenres = isset($_GET['genres']) ? $_GET['genres'] : [];

        // Build WHERE condition for selected genres
        if (!empty($selectedGenres)) {
            $genreConditions = [];
            foreach ($selectedGenres as $genre) {
                $genreConditions[] = "listed_in LIKE '%$genre%'";
            }
            $genreCondition = implode(' AND ', $genreConditions);
            $query = "SELECT title FROM $table WHERE $genreCondition LIMIT 30";
        } else {
            $query = "SELECT title FROM $table LIMIT 30"; // Default query
        }

        // Prepare and execute SQL query
        $stmt = $db->prepare($query);
        if (!$stmt) {
            throw new Exception($db->lastErrorMsg());
        }
        $result = $stmt->execute();

        // Loop through results and display movie cards
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $title = $row['title'];

            // Fetch movie details from TMDB API
            $apiKey = '30525dbccc50717fd5dafc1219c94c9c'; // Replace with your TMDB API key
            $tmdbUrl = "https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&query=" . urlencode($title);

            // Perform API request
            $response = file_get_contents($tmdbUrl);
            $tmdbData = json_decode($response, true);

            // Check if results are found and fetch details
            if (isset($tmdbData['results'][0])) {
                $tmdbMovie = $tmdbData['results'][0];
                $posterPath = isset($tmdbMovie['poster_path']) ? $tmdbMovie['poster_path'] : null;
                $rating = isset($tmdbMovie['vote_average']) ? $tmdbMovie['vote_average'] : 'N/A'; // Fetch rating, default to 'N/A' if not available
                $posterUrl = $posterPath ? "https://image.tmdb.org/t/p/w500{$posterPath}" : "../pics/movieposter.jpg"; // Poster URL or default poster

                // Display movie card
                echo '<div class="movie-card">';
                echo '<a href="../aboutmoviepage/aboutmovie.php?movieId=' . $tmdbMovie['id'] . '" style="text-decoration: none;">';
                echo '<img src="' . htmlspecialchars($posterUrl) . '" alt="' . htmlspecialchars($title) . '">';
                echo '<p class="movie-name">' . htmlspecialchars($title) . '</p>';
                echo '<p class="movie-rating">Rating: ' . htmlspecialchars($rating) . '</p>';
                echo '</a>';
                echo '</div>';
            } else {
                // Handle case where no movie details are found
                echo '<div class="movie-card">';
                echo '<img src="../pics/movieposter.jpg" alt="' . htmlspecialchars($title) . '">';
                echo '<p class="movie-name">' . htmlspecialchars($title) . '</p>';
                echo '<p class="movie-rating">Rating: N/A</p>'; // Default rating if not found
                echo '</div>';
            }
        }

        // Close database connection
        $db->close();
    } catch (Exception $e) {
        echo '<p>Exception caught: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
</div>

</body>
</html>
