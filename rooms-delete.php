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
    $hotelID = isset($_GET['hotelID']) ? $_GET['hotelID'] : '';
    $roomNo = isset($_GET['roomNo']) ? $_GET['roomNo'] : '';

    $db = new SQLite3('hotelm.db');

    $stmt = $db -> prepare("DELETE FROM Room WHERE hotelID = :hid AND roomNo = :rn");
    $stmt -> bindValue(':hid',$hotelID,SQLITE3_INTEGER);
    $stmt -> bindValue(':rn',$roomNo,SQLITE3_INTEGER);
    if($stmt->execute())
        echo 'Room deleted';
    else
        echo 'Failed to delete room';
    $db -> close();
?>