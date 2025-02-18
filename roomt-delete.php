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
    $roomtID = isset($_GET['roomtID']) ? $_GET['roomtID'] : '';

    $db = new SQLite3('hotelm.db');

    $stmt = $db -> prepare("DELETE FROM RoomType WHERE typeID = :tid");
    $stmt -> bindValue(':tid',$roomtID,SQLITE3_INTEGER);
    if($stmt->execute())
        echo 'Room type deleted';
    else
        echo 'Failed to delete room type';
    $db -> close();
?>