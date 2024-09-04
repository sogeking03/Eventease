<?php
// Include database connection file
require_once "db_connection.php";

// Check if search query is provided
if(isset($_GET['query'])) {
    // Sanitize the search query to prevent SQL injection
    $searchQuery = mysqli_real_escape_string($conn, $_GET['query']);

    // Perform search query
    $sql = "SELECT * FROM Auditoriums WHERE Name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);

    // Check if any results are found
    if(mysqli_num_rows($result) > 0) {
        // Display search results
        echo "<h2>Search Results</h2>";
        echo "<div class='container'>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='auditorium'>";
            echo "<h3><a href='auditorium.php?id=" . $row['AuditoriumID'] . "'>Auditorium Name: " . $row['Name'] . "</a></h3>";
            echo "<p>Address: " . $row['Address'] . "</p>";
            // Add more details as needed
            echo "</div>";
        }
        echo "</div>";
    } else {
        // No results found
        echo "<h2>No results found for '$searchQuery'.</h2>";
    }
} else {
    // Redirect to dashboard if search query is not provided
    header("Location: dashboard.php");
    exit;
}
?>
