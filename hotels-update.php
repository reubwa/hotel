<?php
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<script src="script.js"></script>';
echo '<title>Hotel Management</title>';
echo '<body onload="loadNavbar()">';
echo '<div id="navbar-container"></div>';
echo '<div class="content-area">';
session_start();
    if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
    }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotelID = $_POST['hotelID'];
    $hotelName = $_POST['hotelName'];
    $hotelAddress = $_POST['hotelAddress'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $hotelTelNo = $_POST['hotelTelNo'];
    $db = new SQLite3('hotelm.db');
    $stmt = $db -> prepare("UPDATE Hotel SET hotelName=:hn, hotelAddress=:ha, city=:c, postcode=:p, hotelTelNo=:htn WHERE hotelID=:hid");
    $stmt -> bindValue(':hid', $hotelID, SQLITE3_INTEGER);
    $stmt -> bindValue(':hn', $hotelName, SQLITE3_TEXT);
    $stmt -> bindValue(':ha', $hotelAddress, SQLITE3_TEXT);
    $stmt -> bindValue(':c', $city, SQLITE3_TEXT);
    $stmt -> bindValue(':p', $postcode, SQLITE3_TEXT);
    $stmt -> bindValue(':htn', $hotelTelNo, SQLITE3_INTEGER);
    if($stmt->execute()){
        echo "The hotel has been updated successfully.";
    } else {
        echo "Failed to update hotel.";
    }
}
echo '</div>';
echo '</body>';

// Close the database connection when done
$db->close();
?>