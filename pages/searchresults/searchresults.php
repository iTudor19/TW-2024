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
    <a href="../signuppageUser/signup.php">
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
    <!-- Search results will be loaded here -->
    <?php
    // Check if query parameter 'query' is set
    if (isset($_GET['query'])) {
        $searchQuery = $_GET['query'];

        // Perform server-side operations, e.g., fetch data from database or API
        // For demonstration, we'll simulate search results
        $searchResults = fetchSearchResults($searchQuery);

        // Display search results
        displaySearchResults($searchResults);
    } else {
        echo '<p>No search results found.</p>';
    }

    function fetchSearchResults($query) {
        // Here you can implement fetching search results from database or API
        // This is a mock function returning dummy data for demonstration
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
