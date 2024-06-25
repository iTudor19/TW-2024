<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DespreFilm</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <a href="../homepageRo/homeRo.php" style="text-decoration: none;">
            <h1>MoX</h1>
        </a>
        <a href="../authRO/signupRO.php">
            <button class="signup-button">Conectare</button>
        </a>
        <p class="p0">GENURI</p>
        <p class="p1">FILME</p>
        <p class="p2">TV SHOWS</p>
        <p class="p3">TOP TMDB</p>
        <a href="../aboutmoviepage/aboutMovie.php" style="text-decoration: none;">

        <button class="lang-button">ro</button>
    </header>

    <div class="container">
        <img src="../pics/movieposter.jpg" class="movieposter" alt="MoviePoster">
        <div class="text-container">
            <button class="trailer">Trailer</button>
            <p class="p4"><b><b id="movie-title">Titlu Film</b></p>
            <p class="p5" id="movie-overview">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nisi sem, pretium a mauris eu, imperdiet placerat est. Mauris non porttitor dui. Quisque nunc nunc, porta in ligula vitae, placerat aliquet odio.</p>

            <div class="additional-info">
                <div class="left-info">
                    <p class="p6"><b>Premiera</b>:<span id="release-date">Se incarca...</span></p>
                    <p class="p7"><b>Genuri</b>: <span id="genres">Se incarca...</span></p>
                    <p class="p8"><b>Distributie</b>: <span id="cast">Se incarca...</span></p>
                </div>
                <div class="right-info">
                    <p class="p9"><b>Durata</b>: <span id="duration">Loading...</span></p>
                    <p class="p10"><b>Tara </b>: <span id="countries">Loading...</span></p>
                    <p class="p11"><b>Limba originala</b>: <span id="languages">English</span></p>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>