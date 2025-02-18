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
    $roomNo = $_POST['roomNo'];
    $typeID = $_POST['typeID'];
    $db = new SQLite3('hotelm.db');
    $db -> exec("CREATE TABLE IF NOT EXISTS Room(
                    hotelID INTEGER,
                    roomNo INTEGER,
                    typeID INTEGER NOT NULL,
                    FOREIGN KEY (hotelID) REFERENCES Hotel (hotelID) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (typeID) REFERENCES RoomType (typeID) ON DELETE CASCADE ON UPDATE CASCADE,
                    PRIMARY KEY(hotelID, roomNo)
                );");
    $stmt = $db -> prepare("INSERT INTO Room(hotelID, roomNo, typeID) VALUES (:hid, :rn, :tid)");
    $stmt -> bindValue(':hid', $hotelID, SQLITE3_INTEGER);
    $stmt -> bindValue(':rn', $roomNo, SQLITE3_INTEGER);
    $stmt -> bindValue(':tid', $typeID, SQLITE3_INTEGER);
    if($stmt->execute()){
        echo "A new room has been added successfully.";
    } else {
        echo "Failed to add room.";
    }
}
echo '</div>';
echo '</body>';

// Close the database connection when done
$db->close();
?>