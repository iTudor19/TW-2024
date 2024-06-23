<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TV Shows</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <a href="../homepage/home.html" style="text-decoration: none;">
        <h1>MoX</h1>
    </a>
    <a href="../signuppageUser/signup.html">
        <button class="signup-button">Sign Up</button>
    </a>
    <p class="p0">GENRE</p>
    <a href="../movies/movies.php" style="text-decoration: none; color: inherit;">
        <p class="p1">MOVIES</p>
    </a>
    <p class="p2">TV SHOWS</p>
    <p class="p3">TOP TMDB</p>
    <a href="../getstartedpageRO/getstartedRo.html" style="text-decoration: none;">
        <button class="lang-button">en</button>
    </a>
</header>

<div class="service-buttons">
    <a href="tvshows.php?service=netflix"><button class="service-button" id="netflix-button">Netflix</button></a>
    <a href="tvshows.php?service=disney"><button class="service-button" id="disney-button">Disney+</button></a>
</div>

<div class="alphabet-selector">
    <ul>
        <?php
        // Generate alphabet links dynamically
        $letters = range('A', 'Z');
        foreach ($letters as $letter) {
            echo '<li><a href="#" class="letter-link" data-letter="' . $letter . '">' . $letter . '</a></li>';
        }
        ?>
    </ul>
</div>

<div class="movie-containerL">
    <!-- TV Shows will be dynamically loaded here -->
    <?php
    try {
        // Connect to SQLite database
        $db = new SQLite3('../../db/BD_final.db');

        // Default table and letter to fetch titles from
        $table = 'media_n'; // Default table to fetch titles from
        $letter = isset($_GET['letter']) ? $_GET['letter'] : 'A'; // Default to 'A' if letter is not specified

        // Check if Netflix button is pressed
        if (isset($_GET['service']) && $_GET['service'] === 'netflix') {
            $table = 'media_n'; // Set table to media_n for Netflix (adjust as per your actual table name)
        }

        // Check if Disney+ button is pressed
        if (isset($_GET['service']) && $_GET['service'] === 'disney') {
            $table = 'media_d'; // Set table to media_d for Disney+ (adjust as per your actual table name)
        }

        // Fetch TV shows from selected table starting with selected letter
        $query = "SELECT title FROM $table WHERE type = 'TV Show' AND title LIKE '$letter%' LIMIT 30";
        $result = $db->query($query);

        // Display TV shows
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $title = $row['title'];

            // Fetch TV show details from TMDB API
            $apiKey = '30525dbccc50717fd5dafc1219c94c9c'; // Replace with your TMDB API key
            $tmdbUrl = "https://api.themoviedb.org/3/search/tv?api_key={$apiKey}&query=" . urlencode($title);

            // Perform API request
            $response = file_get_contents($tmdbUrl);
            $tmdbData = json_decode($response, true);

            // Check if results are found and fetch details
            if (isset($tmdbData['results'][0])) {
                $tmdbTVShow = $tmdbData['results'][0];
                $posterPath = isset($tmdbTVShow['poster_path']) ? $tmdbTVShow['poster_path'] : null;
                $rating = isset($tmdbTVShow['vote_average']) ? $tmdbTVShow['vote_average'] : 'N/A'; // Fetch rating, default to 'N/A' if not available
                $posterUrl = $posterPath ? "https://image.tmdb.org/t/p/w500{$posterPath}" : "../pics/movieposter.jpg"; // Poster URL or default poster

                // Display TV show card
                echo '<div class="movie-card">';
                echo '<a href="../aboutmoviepage/aboutmovie.php?mediaId=' . $tmdbTVShow['id'] . '&mediaType=tv" style="text-decoration: none;">';
                echo '<img src="' . htmlspecialchars($posterUrl) . '" alt="' . htmlspecialchars($title) . '">';
                echo '<p class="movie-name">' . htmlspecialchars($title) . '</p>';
                echo '<p class="movie-rating">Rating: ' . htmlspecialchars($rating) . '</p>';
                echo '</a>';
                echo '</div>';
            } else {
                // Handle case where no TV show details are found
                echo '<div class="movie-card">';
                echo '<img src="../pics/movieposter.jpg" alt="' . htmlspecialchars($title) . '">';
                echo '<p class="movie-name">' . htmlspecialchars($title) . '</p>';
                echo '<p class="movie-rating">Rating: N/A</p>'; // Default rating if not found
                echo '</div>';
            }
        }

        // Close the database connection
        $db->close();
    } catch (Exception $e) {
        echo '<p>Exception caught: ' . $e->getMessage() . '</p>';
    }
    ?>
</div>

<script src="tvshows.js"></script>

</body>
</html>
