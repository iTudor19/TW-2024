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
    <a href="../homepage/home.php" style="text-decoration: none;">
        <h1>MoX</h1>
    </a>
    <a href="../auth/signup.html">
        <button class="signup-button">Sign Up</button>
    </a>
    <a href="../moviebygenre/moviebygenre.php" style="text-decoration: none; color: inherit;">
       <p class="p0">GENRE</p>
    </a>
    <a href="../movies/movies.php" style="text-decoration: none; color: inherit;">
        <p class="p1">MOVIES</p>
    </a>
    <p class="p2">TV SHOWS</p>
    <a href="../toptmdb/toptmdb.php" style="text-decoration: none; color: inherit;">
        <p class="p3">TOP TMDB</p>
    </a>
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
        $letters = range('A', 'Z');
        foreach ($letters as $letter) {
            echo '<li><a href="#" class="letter-link" data-letter="' . $letter . '">' . $letter . '</a></li>';
        }
        ?>
    </ul>
</div>

<div class="movie-containerL">
    <?php
    try {
        $db = new SQLite3('../../db/BD_final.db');

        $table = 'media_n'; 
        $letter = isset($_GET['letter']) ? $_GET['letter'] : 'A'; 

        if (isset($_GET['service']) && $_GET['service'] === 'netflix') {
            $table = 'media_n'; 
        }

        if (isset($_GET['service']) && $_GET['service'] === 'disney') {
            $table = 'media_d'; 
        }

        $query = "SELECT title FROM $table WHERE type = 'TV Show' AND title LIKE '$letter%' LIMIT 30";
        $result = $db->query($query);

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $title = $row['title'];

            $apiKey = '30525dbccc50717fd5dafc1219c94c9c'; 
            $tmdbUrl = "https://api.themoviedb.org/3/search/tv?api_key={$apiKey}&query=" . urlencode($title);

            $response = file_get_contents($tmdbUrl);
            $tmdbData = json_decode($response, true);

            if (isset($tmdbData['results'][0])) {
                $tmdbTVShow = $tmdbData['results'][0];
                $posterPath = isset($tmdbTVShow['poster_path']) ? $tmdbTVShow['poster_path'] : null;
                $rating = isset($tmdbTVShow['vote_average']) ? $tmdbTVShow['vote_average'] : 'N/A'; 
                $posterUrl = $posterPath ? "https://image.tmdb.org/t/p/w500{$posterPath}" : "../pics/movieposter.jpg"; 

                echo '<div class="movie-card">';
                echo '<a href="../aboutmoviepage/aboutmovie.php?mediaId=' . $tmdbTVShow['id'] . '&mediaType=tv" style="text-decoration: none;">';
                echo '<img src="' . htmlspecialchars($posterUrl) . '" alt="' . htmlspecialchars($title) . '">';
                echo '<p class="movie-name">' . htmlspecialchars($title) . '</p>';
                echo '<p class="movie-rating">Rating: ' . htmlspecialchars($rating) . '</p>';
                echo '</a>';
                echo '</div>';
            } else {
                echo '<div class="movie-card">';
                echo '<img src="../pics/movieposter.jpg" alt="' . htmlspecialchars($title) . '">';
                echo '<p class="movie-name">' . htmlspecialchars($title) . '</p>';
                echo '<p class="movie-rating">Rating: N/A</p>'; 
                echo '</div>';
            }
        }
        $db->close();
    } catch (Exception $e) {
        echo '<p>Exception caught: ' . $e->getMessage() . '</p>';
    }
    ?>
</div>

<script src="tvshows.js"></script>

</body>
</html>
