<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetStarted</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<header>
    <a href="../homepage/home.php" style="text-decoration: none;">
        <h1>MoX</h1>
    </a>
    <a href="../auth/signup.php">
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

    <a href="../toptmdb/toptmdb.php" style="text-decoration: none; color: inherit;">
        <p class="p3">TOP TMDB</p>
    </a>
    <a href="../getstartedpageRO/getstartedRo.php" style="text-decoration: none;">
        <button class="lang-button">en</button>
    </a>
</header>

<p class="p4">Find Movies, TV Shows and more...</p>
<div class="search-container">
    <form id="searchForm" method="GET" action="../searchresults/searchresults.php">
        <input type="text" class="search-bar" id="searchInput" name="query" placeholder="Enter keywords...">
    </form>
</div>

<p class="p5">Trending</p>
<button class="toggle-button" data-section="T" data-type="movie">Movies</button>
<button class="toggle-button" data-section="T" data-type="tv">TV Shows</button>

<div class="container" id="containerT">
    <?php include 'getstarted.php'; ?>
</div>

<p class="p6">Latest</p>
<button class="toggle-button" data-section="L" data-type="movie">Movies</button>
<button class="toggle-button" data-section="L" data-type="tv">TV Shows</button>

<div class="container" id="containerL">
    <?php include 'getstarted.php'; ?>
</div>

<p class="p7">Upcoming</p>
<button class="toggle-button" data-section="U" data-type="movie">Movies</button>
<button class="toggle-button" data-section="U" data-type="tv">TV Shows</button>

<div class="container" id="containerU">
    <?php include 'getstarted.php'; ?>
</div>

<script src="getstarted.js"></script>

</body>

</html>
