<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DespreActor</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <a href="../homepageRo/homeRo.php" style="text-decoration: none;">
            <h1>MoX</h1>
        </a>
        <a href="../authRO/signupRO.php">
            <button class="signup-button">Inregisreaza-te</button>
        </a>
        <p class="p0">GEN</p>
        <p class="p1">FILME</p>
        <p class="p2">SERIALE TV</p>
        <p class="p3">TOP TMDB</p>
        <a href="../aboutactor/aboutactor.php" style="text-decoration: none;">
        <button class="lang-button">ro</button>
        </a>
    </header>

    <div class="container">
        <img src="../pics/poza_actor_generic.jpg" class="actorphoto" alt="ActorPhoto">
        <div class="text-container">
            <p class="p4" id="actor-name">Nume Actor</p>
            <p class="p5"  id="actor-biography">Se incarca...</p>

            <div class="additional-info">
                <div class="left-info">
                    <p class="p6"><b>Nascut(a)</b>: <span id="actor-birthdate">Se incarca...</span></p>
                    <p class="p7"><b>Nationalitate</b>: <span id="actor-nationality">Loading...</span></p>
                    <p class="p8"><b>Filme</b>: <span id="actor-movies">
                        <?php
                        $apiKey = '30525dbccc50717fd5dafc1219c94c9c';
                        $actorId = $_GET['actorId'];

                        if ($actorId) {
                            $url = "https://api.themoviedb.org/3/person/$actorId?api_key=$apiKey&language=en-US&append_to_response=combined_credits";
                            $response = file_get_contents($url);
                            $actorDetails = json_decode($response, true);

                            if (isset($actorDetails['combined_credits']['cast'])) {
                                $movies = array_slice(array_filter($actorDetails['combined_credits']['cast'], function($movie) {
                                    return $movie['media_type'] === 'movie';
                                }), 0, 5);

                                foreach ($movies as $movie) {
                                    $movieId = $movie['id'];
                                    $title = $movie['title'];
                                    echo "<a href='../aboutmoviepage/aboutmovieRo.php?movieId=$movieId'>$title</a>, ";
                                }
                            }
                        }
                        ?>
                    </span></p>
                </div>
                <div class="right-info">
                    <p class="p9"><b>Inaltime</b>: <span id="actor-height">Loading...</span></p>
                    <p class="p10"><b>Greutate</b>: <span id="actor-weight">Loading...</span></p>
                    <p class="p11"><b>Limbi vorbite</b>: <span id="actor-languages">Loading...</span></p>
            </div>
        </div>
        <button class="trailer">Interviu</button>
    </div>

    <script src="script.js"></script>

</body>

</html>