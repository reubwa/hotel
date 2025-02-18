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
    $hotelName = $_POST['hotelName'];
    $hotelAddress = $_POST['hotelAddress'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $hotelTelNo = $_POST['hotelTelNo'];
    $db = new SQLite3('hotelm.db');
    $db -> exec("CREATE TABLE IF NOT EXISTS Hotel(
                    hotelID INTEGER PRIMARY KEY AUTOINCREMENT,
                    hotelName TEXT NOT NULL,
                    hotelAddress TEXT NOT NULL,
                    city TEXT NOT NULL,
                    postcode TEXT NOT NULL,
                    hotelTelNo INTEGER NOT NULL
                );");
    $stmt = $db -> prepare("INSERT INTO Hotel(hotelName, hotelAddress, city, postcode, hotelTelNo) VALUES (:hn, :ha, :c, :pc, :htn)");
    $stmt -> bindValue(':hn', $hotelName, SQLITE3_TEXT);
    $stmt -> bindValue(':ha', $hotelAddress, SQLITE3_TEXT);
    $stmt -> bindValue(':c', $city, SQLITE3_TEXT);
    $stmt -> bindValue(':pc', $postcode, SQLITE3_TEXT);
    $stmt -> bindValue(':htn', $hotelTelNo, SQLITE3_INTEGER);
    if($stmt->execute()){
        echo "A new hotel has been added successfully.";
        $db->close();
    } else {
        echo "Failed to add hotel.";
        $db->close();
    }
}
echo '</div>';
echo '</body>';
?>