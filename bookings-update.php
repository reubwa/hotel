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
    $bookingID = $_POST['bookingID'];
    $bookingCheckInDate = $_POST['bookingCheckInDate'];
    $bookingCheckOutDate = $_POST['bookingCheckOutDate'];
    $bookingCost = $_POST['bookingCost'];
    $hotelID = $_POST['hotelID'];
    $roomNo = $_POST['roomNo'];
    $guestID = $_POST['guestID'];
    $db = new SQLite3('hotelm.db');
    $stmt = $db -> prepare("UPDATE Booking SET bookingCheckInDate=:bcid, bookingCheckOutDate=:bcod, bookingCost=:bc, hotelID=:hid, roomNo=:rn, guestID=:gid WHERE bookingID=:bid");
    $stmt -> bindValue(':bid', $bookingID, SQLITE3_INTEGER);
    $stmt -> bindValue(':bcid', $bookingCheckInDate, SQLITE3_TEXT);
    $stmt -> bindValue(':bcod', $bookingCheckOutDate, SQLITE3_TEXT);
    $stmt -> bindValue(':bc', $bookingCost, SQLITE3_INTEGER);
    $stmt -> bindValue(':hid', $hotelID, SQLITE3_INTEGER);
    $stmt -> bindValue(':rn', $roomNo, SQLITE3_INTEGER);
    $stmt -> bindValue(':gid', $guestID, SQLITE3_INTEGER);
    if($stmt->execute()){
        echo "The booking has been updated successfully.";
    } else {
        echo "Failed to update booking.";
    }
}
echo '</div>';
echo '</body>';

// Close the database connection when done
$db->close();
?>