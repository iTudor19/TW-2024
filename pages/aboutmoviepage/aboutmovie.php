<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AboutMovie</title>
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
        <a href="../aboutmoviepageRo/aboutMovieRo.php" style="text-decoration: none;">
            <button class="lang-button">en</button>
        </a>
    </header>

    <div class="container">
        <img src="../pics/movieposter.jpg" class="movieposter" alt="MoviePoster">
        <div class="text-container">
            <button class="trailer">Trailer</button>
            <p class="p4"><b id="movie-title">Movie Title</b></p>
            <p class="p5" id="movie-overview">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisi sem,
                pretium a mauris eu, imperdiet placerat est. Mauris non porttitor dui. Quisque nunc nunc, porta in
                ligula vitae, placerat aliquet odio.</p>

            <!-- New text elements -->
            <div class="additional-info">
                <div class="left-info">
                    <p class="p6"><b>Released</b>: <span id="release-date">Loading...</span></p>
                    <p class="p7"><b>Genres</b>: <span id="genres">Loading...</span></p>
                    <p class="p8"><b>Cast</b>: <span id="cast">Loading...</span></p>
                </div>
                <div class="right-info">
                    <p class="p9"><b>Duration</b>: <span id="duration">Loading...</span></p>
                    <p class="p10"><b>Country</b>: <span id="countries">Loading...</span></p>
                    <p class="p11"><b>Language(s)</b>: <span id="languages">English</span></p>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>
