<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
    <p class="p0">GENRE</p>
    <p class="p1">MOVIES</p>
    <p class="p2">TV SHOWS</p>
    <p class="p3">TOP TMDB</p>
    <a href="../getstartedpageRO/getstartedRo.php" style="text-decoration: none;">
        <button class="lang-button">en</button>
    </a>
</header>

<p class="p4">Search Results</p>
<div class="search-results-container">
    <?php
    if (isset($_GET['query'])) {
        $searchQuery = $_GET['query'];
        $searchResults = fetchSearchResults($searchQuery);

        displaySearchResults($searchResults);
    } else {
        echo '<p>No search results found.</p>';
    }

    function fetchSearchResults($query) {
        $dummyResults = array(
            array('title' => 'Movie 1', 'overview' => 'Overview of Movie 1'),
            array('title' => 'Movie 2', 'overview' => 'Overview of Movie 2'),
            array('title' => 'Movie 3', 'overview' => 'Overview of Movie 3'),
        );
        return $dummyResults;
    }

    function displaySearchResults($results) {
        foreach ($results as $result) {
            echo '<div class="search-result">';
            echo '<h2>' . htmlspecialchars($result['title']) . '</h2>';
            echo '<p>' . htmlspecialchars($result['overview']) . '</p>';
            echo '</div>';
        }
    }
    ?>
</div>

<script src="searchresults.js"></script>

</body>
</html>
