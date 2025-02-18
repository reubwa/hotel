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
    //$typeID = $_POST['typeID'];
    $typeName = $_POST['typeName'];
    $capacity = $_POST['capacity'];
    $costPerNight = $_POST['costPerNight'];
    $db = new SQLite3('hotelm.db');
    $db -> exec("CREATE TABLE IF NOT EXISTS RoomType(
                    typeID INTEGER PRIMARY KEY AUTOINCREMENT,
                    typeName TEXT NOT NULL UNIQUE,
                    capacity INTEGER NOT NULL,
                    costPerNight INTEGER NOT NULL

                );");
    $stmt = $db -> prepare("INSERT INTO RoomType(typeName, capacity, costPerNight) VALUES (:tn, :c, :cpn)");
    //$stmt -> bindValue(':tid', $typeID, SQLITE3_INTEGER);
    $stmt -> bindValue(':tn', $typeName, SQLITE3_TEXT);
    $stmt -> bindValue(':c', $capacity, SQLITE3_INTEGER);
    $stmt -> bindValue(':cpn', $costPerNight, SQLITE3_INTEGER);
    if($stmt->execute()){
        echo "A new room type has been added successfully.";
    } else {
        echo "Failed to add room type.";
    }
}
echo '</div>';
echo '</body>';

// Close the database connection when done
$db->close();
?>