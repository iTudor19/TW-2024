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
        <a href="../homepageRo/homeRo.php" style="text-decoration: none;">
            <h1>MoX</h1>
        </a>
        <a href="../authsignupRo.php">
            <button class="signup-button">Conectare</button>
        </a>

        <a href="../moviebygenre/moviebygenre.php" style="text-decoration: none; color: inherit;"></a>
        <p class="p0">GEN</p>

        <a href="../movies/movies.php" style="text-decoration: none; color: inherit;"></a>
        <p class="p1">FILME</p>

        <a href="../tvshows/tvshows.php" style="text-decoration: none; color: inherit;">
            <p class="p2">SERIALE TV</p>

            <a href="../toptmdb/toptmdb.php" style="text-decoration: none; color: inherit;"></a>
            <p class="p3">TOP TMDB</p>

            <a href="../getstartedpage/getstarte.php" style="text-decoration: none;">
                <button class="lang-button">ro</button>
            </a>
    </header>

    <p class="p4">Gaseste Filme, Seriale TV si altele...</p>
    <div class="search-container">
        <form id="searchForm" method="GET" action="../searchresults/searchresults.php">
            <input type="text" class="search-bar" id="searchInput" placeholder="Introdu cuvinte cheie...">
        </form>
    </div>

    <p class="p5">Populare</p>
    <button class="toggle-button" data-section="T" data-type="movie">Filme</button>
    <button class="toggle-button" data-section="T" data-type="tv">Seriale TV</button>

    <div class="container" id="containerL">
        <?php include 'getstartedRO.php'; ?>
    </div>


    <p class="p6">Recente</p>
    <button class="toggle-button" data-section="L" data-type="movie">Filme</button>
    <button class="toggle-button" data-section="L" data-type="tv">Seriale TV</button>

    <div class="container" id="containerL">
    </div>


    <p class="p7">In Viitor...</p>
    <button class="toggle-button" data-section="U" data-type="movie">Movies</button>
    <button class="toggle-button" data-section="U" data-type="tv">TV Shows</button>

    <div class="container" id="containerU">
        <?php include 'getstartedRO.php'; ?>
    </div>

    <script src="getstartedRO.js"></script>


</body>

</html>