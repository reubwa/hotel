<?php
    session_start();
    if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
    }
    // Create or open an SQLite3 database
    $db = new SQLite3('hotelm.db');
    // Check if the database was created or opened successfully
    if ($db) {
    echo '<script>console.log("Database created/opened successfully!")</script>';
    } else {
    echo '<script>console.log("Failed to open/create the database.")</script>';
    }

    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<link rel="stylesheet" type="text/css" href="style.css" />';
    echo '<script src="script.js"></script>';
    echo '<title>Hotel Management</title>';
    echo '<body onload="loadNavbar()">';
    echo '<div id="navbar-container"></div>';
    echo '<div class="content-area">';
    echo '<h1>Welcome to the Hotel Management System</h1>';
    echo '</div>';
    echo '</body>';

    // Close the database connection when done
    $db->close();
?>