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
    $typeID = $_POST['typeID'];
    $typeName = $_POST['typeName'];
    $capacity = $_POST['capacity'];
    $costPerNight = $_POST['costPerNight'];
    $db = new SQLite3('hotelm.db');
    $stmt = $db -> prepare("UPDATE RoomType SET typeName=:tn, capacity=:c, costPerNight=:cpn WHERE typeID=:tid");
    $stmt -> bindValue(':tid', $typeID, SQLITE3_INTEGER);
    $stmt -> bindValue(':tn', $typeName, SQLITE3_TEXT);
    $stmt -> bindValue(':c', $capacity, SQLITE3_INTEGER);
    $stmt -> bindValue(':cpn', $costPerNight, SQLITE3_INTEGER);
    if($stmt->execute()){
        echo "The room type has been updated successfully.";
    } else {
        echo "Failed to update room type.";
    }
}
echo '</div>';
echo '</body>';

// Close the database connection when done
$db->close();
?>