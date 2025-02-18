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
    $guestFirstName = $_POST['guestFirstName'];
    $guestLastName = $_POST['guestLastName'];
    $guestEmail = $_POST['guestEmail'];
    $guestPhoneNo = $_POST['guestPhoneNo'];
    $guestAddress = $_POST['guestAddress'];
    $db = new SQLite3('hotelm.db');
    $db -> exec("CREATE TABLE IF NOT EXISTS Guest(
                    guestID INTEGER PRIMARY KEY AUTOINCREMENT,
                    guestFirstName TEXT NOT NULL,
                    guestLastName TEXT NOT NULL,
                    guestEmail TEXT NOT NULL UNIQUE,
                    guestPhoneNo INTEGER NOT NULL UNIQUE,
                    guestAddress TEXT NOT NULL
                );");
    $stmt = $db -> prepare("INSERT INTO Guest(guestFirstName, guestLastName, guestEmail, guestPhoneNo, guestAddress) VALUES (:gfn, :gln, :ge, :gpn, :ga)");
    $stmt -> bindValue(':gfn', $guestFirstName, SQLITE3_STRING);
    $stmt -> bindValue(':gln', $guestLastName, SQLITE3_STRING);
    $stmt -> bindValue(':ge', $guestEmail, SQLITE3_STRING);
    $stmt -> bindValue(':gpn', $guestPhoneNo, SQLITE3_INTEGER);
    $stmt -> bindValue(':ga', $guestAddress, SQLITE3_STRING);
    if($stmt->execute()){
        echo "A new guest has been added successfully.";
    } else {
        echo "Failed to add guest.";
    }
}
echo '</div>';
echo '</body>';

// Close the database connection when done
$db->close();
?>