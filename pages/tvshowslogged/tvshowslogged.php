<?php
session_start();
include("../auth/connection.php");
include("../auth/functions.php");

$user_data = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
?>


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
    <a href="../auth/logout.php">
        <button class="signup-button">Log Out</button>
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
    <a href="../getstartedpageRO/getstartedRo.php" style="text-decoration: none;">
        <button class="lang-button">en</button>
    </a>
</header>

<div class="service-buttons">
    <a href="tvshowslogged.php?service=netflix"><button class="service-button" id="netflix-button">Netflix</button></a>
    <a href="tvshowslogged.php?service=disney"><button class="service-button" id="disney-button">Disney+</button></a>
    <div class="dropdown">
        <button class="dropbtn">Export</button>
        <div class="dropdown-content">
            <a href="#" onclick="exportData('CSV')">CSV</a>
            <a href="#" onclick="exportData('WebP')">WebP</a>
            <a href="#" onclick="exportData('SVG')">SVG</a>
        </div>
    </div>
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

        $movies = [];

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

                $movies[] = [
                    'title' => $title,
                    'rating' => $rating,
                    'posterUrl' => $posterUrl
                ];

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
<script>
    const movies = <?php echo json_encode($movies); ?>;

    function exportData(format) {
        if (format === 'CSV') {
            exportCSV(movies);
        } else if (format === 'WebP') {
            exportWebP(movies);
        } else if (format === 'SVG') {
            exportSVG(movies);
        }
    }

    function exportCSV(data) {
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Title,Rating,Poster URL\n";
        data.forEach(movie => {
            csvContent += `${movie.title},${movie.rating},${movie.posterUrl}\n`;
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "movies.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportWebP(data) {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = 1920;
        canvas.height = 1080;
        context.fillStyle = "#fff";
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.fillStyle = "#000";
        context.font = "20px Arial";
        let y = 30;
        data.forEach(movie => {
            context.fillText(movie.title, 10, y);
            y += 30;
        });

        canvas.toBlob(function(blob) {
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "movies.webp";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }, 'image/webp');
    }

    function exportSVG(data) {
        let svgContent = `<svg xmlns="http://www.w3.org/2000/svg" width="800" height="${30 * data.length}">`;
        let y = 30;
        data.forEach(movie => {
            svgContent += `<text x="10" y="${y}" font-family="Arial" font-size="20">${movie.title}</text>`;
            y += 30;
        });
        svgContent += `</svg>`;

        const blob = new Blob([svgContent], { type: 'image/svg+xml' });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "movies.svg";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>


</body>
</html>
