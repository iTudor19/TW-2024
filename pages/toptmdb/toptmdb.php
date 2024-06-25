<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top TMDB</title>
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

    <a href="../tvshows/tvshows.php" style="text-decoration: none; color: inherit;">
        <p class="p2">TV SHOWS</p>
    </a>
    <a href="toptmdb.php" style="text-decoration: none; color: inherit;">
        <p class="p3">TOP TMDB</p>
    </a>
    <a href="../getstartedpageRO/getstartedRo.php" style="text-decoration: none;">
        <button class="lang-button">en</button>
    </a>
</header>

<p class="p4">Top TMDB</p>

<p class="top-movies-title">Top Movies</p>
<div class="top-movies-container">
    <?php
    function fetchTopMovies() {
        $apiKey = '30525dbccc50717fd5dafc1219c94c9c';
        $url = "https://api.themoviedb.org/3/movie/popular?api_key={$apiKey}&language=en-US&page=1";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        return $data['results'];
    }

    $topMovies = fetchTopMovies();

    foreach ($topMovies as $movie) {
        echo '<div class="top-movie">';
        echo '<h2>' . htmlspecialchars($movie['title']) . '</h2>';
        echo '<p>Release Date: ' . htmlspecialchars($movie['release_date']) . '</p>';
        echo '<p>Rating: ' . htmlspecialchars($movie['vote_average']) . '</p>';
        echo '</div>';
    }
    ?>
</div>

<p class="top-tvshows-title">Top TV Shows</p>
<div class="top-tvshows-container">
    <?php
    function fetchTopTVShows() {
        $apiKey = '30525dbccc50717fd5dafc1219c94c9c';
        $url = "https://api.themoviedb.org/3/tv/popular?api_key={$apiKey}&language=en-US&page=1";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        return $data['results'];
    }

    $topTVShows = fetchTopTVShows();

    foreach ($topTVShows as $tvShow) {
        echo '<div class="top-tvshow">';
        echo '<h2>' . htmlspecialchars($tvShow['name']) . '</h2>';
        echo '<p>First Air Date: ' . htmlspecialchars($tvShow['first_air_date']) . '</p>';
        echo '<p>Rating: ' . htmlspecialchars($tvShow['vote_average']) . '</p>';
        echo '</div>';
    }
    ?>
</div>

<script src="toptmdb.js"></script>

</body>
</html>
