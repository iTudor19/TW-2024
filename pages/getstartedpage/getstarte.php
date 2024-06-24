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
    <a href="../signuppageUser/signup.php">
        <button class="signup-button">Sign Up</button>
    </a>
    <p class="p0 genre-dropdown-toggle">GENRE</p>
    <div class="genre-dropdown">
    <ul>
    <li data-genre="Action">Action</li>
    <li data-genre="Adventure">Adventure</li>
    <li data-genre="Animation">Animation</li>
    <li data-genre="Comedy">Comedy</li>
    <li data-genre="Crime">Crime</li>
    <li data-genre="Documentar">Documentary</li>
    <li data-genre="Drama">Drama</li>
    <li data-genre="Family">Family</li>
    <li data-genre="Fantasy">Fantasy</li>
    <li data-genre="Horror">Horror</li>
    <li data-genre="Music">Music</li>
    <li data-genre="Mystery">Mystery</li>
    <li data-genre="Romance">Romance</li>
    <li data-genre="Science Fiction">Science Fiction</li>
    <li data-genre="Thriller">Thriller</li>
    <li data-genre="War">War</li>
</ul>

    </div>

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
    <!-- Trending content will be loaded here -->
    <?php include 'getstarted.php'; ?>
</div>

<p class="p6">Latest</p>
<button class="toggle-button" data-section="L" data-type="movie">Movies</button>
<button class="toggle-button" data-section="L" data-type="tv">TV Shows</button>

<div class="container" id="containerL">
    <!-- Latest content will be loaded here -->
    <?php include 'getstarted.php'; ?>
</div>

<p class="p7">Upcoming</p>
<button class="toggle-button" data-section="U" data-type="movie">Movies</button>
<button class="toggle-button" data-section="U" data-type="tv">TV Shows</button>

<div class="container" id="containerU">
    <!-- Upcoming content will be loaded here -->
    <?php include 'getstarted.php'; ?>
</div>

<script src="getstarted.js"></script>

</body>

</html>
