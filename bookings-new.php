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
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingCheckInDate = $_POST['bookingCheckInDate'];
    $bookingCheckOutDate = $_POST['bookingCheckOutDate'];
    $bookingCost = $_POST['bookingCost'];
    $hotelID = $_POST['hotelID'];
    $roomNo = $_POST['roomNo'];
    $guestID = $_POST['guestID'];
    $db = new SQLite3('hotelm.db');
    $db -> exec("CREATE TABLE IF NOT EXISTS Booking(
                    bookingCheckInDate TEXT NOT NULL,
                    bookingCheckOutDate TEXT NOT NULL,
                    bookingCost INTEGER NOT NULL,
                    hotelID INTEGER NOT NULL,
                    roomNo INTEGER NOT NULL,
                    guestID INTEGER NOT NULL,
                    FOREIGN KEY (hotelID) REFERENCES Hotel (hotelID) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (hotelID, roomNo) REFERENCES Room (hotelID, roomNo) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (guestID) REFERENCES Guest (guestID) ON DELETE CASCADE ON UPDATE CASCADE
                );");
    $stmt = $db -> prepare("INSERT INTO Booking(bookingCHeckInDate, bookingCheckOutDate, bookingCost, hotelID, roomNo, guestID) VALUES (:bcid, :bcod, :bc, :hid, :rn, :gid)");
    $stmt -> bindValue(':bcid', $bookingCheckInDate, SQLITE3_TEXT);
    $stmt -> bindValue(':bcod', $bookingCheckOutDate, SQLITE3_TEXT);
    $stmt -> bindValue(':bc', $bookingCost, SQLITE3_INTEGER);
    $stmt -> bindValue(':hid', $hotelID, SQLITE3_INTEGER);
    $stmt -> bindValue(':rn', $roomNo, SQLITE3_INTEGER);
    $stmt -> bindValue(':gid', $guestID, SQLITE3_INTEGER);
    if($stmt->execute()){
        echo "A new booking has been added successfully.";
    } else {
        echo "Failed to add new booking.";
    }
}
?>