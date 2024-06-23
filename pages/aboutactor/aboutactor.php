<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AboutActor</title>
    <link rel="stylesheet" href="style.css">
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
        <a href="../aboutactorRo/aboutactorRo.php" style="text-decoration: none;">
            <button class="lang-button">en</button>
        </a>
    </header>

    <div class="container">
        <img src="../pics/poza_actor_generic.jpg" class="actorphoto" alt="ActorPhoto">
        <div class="text-container">
            <p class="p4" id="actor-name">Actor Name</p>
            <p class="p5" id="actor-biography">Loading...</p>

            <!-- New text elements -->
            <div class="additional-info">
                <div class="left-info">
                    <p class="p6"><b>Born</b>: <span id="actor-birthdate">Loading...</span></p>
                    <p class="p7"><b>Nationality</b>: <span id="actor-nationality">Loading...</span></p>
                    <p class="p8"><b>Movies</b>: <span id="actor-movies">
                        <?php
                        // PHP code to fetch actor's movies and output links
                        $apiKey = '30525dbccc50717fd5dafc1219c94c9c'; // Replace with your TMDB API key
                        $actorId = $_GET['actorId']; // Get actorId from query parameter

                        if ($actorId) {
                            $url = "https://api.themoviedb.org/3/person/$actorId?api_key=$apiKey&language=en-US&append_to_response=combined_credits";
                            $response = file_get_contents($url);
                            $actorDetails = json_decode($response, true);

                            if (isset($actorDetails['combined_credits']['cast'])) {
                                $movies = array_slice(array_filter($actorDetails['combined_credits']['cast'], function($movie) {
                                    return $movie['media_type'] === 'movie';
                                }), 0, 5); // Limit to 5 movies

                                foreach ($movies as $movie) {
                                    $movieId = $movie['id'];
                                    $title = $movie['title'];
                                    echo "<a href='../aboutmoviepage/aboutmovie.php?movieId=$movieId'>$title</a>, ";
                                }
                            }
                        }
                        ?>
                    </span></p>
                </div>
                <div class="right-info">
                    <p class="p9"><b>Height</b>: <span id="actor-height">Loading...</span></p>
                    <p class="p10"><b>Weight</b>: <span id="actor-weight">Loading...</span></p>
                    <p class="p11"><b>Languages</b>: <span id="actor-languages">Loading...</span></p>
                </div>
            </div>
        </div>
        <button class="trailer">Interview</button>
    </div>

    <script src="script.js"></script>

</body>

</html>
