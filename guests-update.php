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
    $guestID = $_POST['guestID'];
    $firstName = $_POST['guestFirstName'];
    $lastName = $_POST['guestLastName'];
    $email = $_POST['guestEmail'];
    $phoneNo = $_POST['guestPhoneNo'];
    $address = $_POST['guestAddress'];
    $db = new SQLite3('hotelm.db');
    $stmt = $db -> prepare("UPDATE Guest SET guestFirstName=:gfn, guestLastName=:gln, guestEmail=:ge, guestPhoneNo=:gpn, guestAddress=:ga WHERE guestID=:gi");
    $stmt -> bindValue(':gi', $guestID, SQLITE3_INTEGER);
    $stmt -> bindValue(':ga', $address, SQLITE3_TEXT);
    $stmt -> bindValue(':gpn', $phoneNo, SQLITE3_INTEGER);
    $stmt -> bindValue(':ge', $email, SQLITE3_TEXT);
    $stmt -> bindValue(':gln', $lastName, SQLITE3_TEXT);
    $stmt -> bindValue(':gfn', $firstName, SQLITE3_TEXT);
    if($stmt->execute()){
        echo "The guest has been updated successfully.";
    } else {
        echo "Failed to update guest.";
    }
}
echo '</div>';
echo '</body>';

// Close the database connection when done
$db->close();
?>