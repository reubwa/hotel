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
    $guestID = isset($_GET['guestID']) ? $_GET['guestID'] : '';

    $db = new SQLite3('hotelm.db');

    $stmt = $db -> prepare("DELETE FROM Guest WHERE guestID = :gid");
    $stmt -> bindValue(':gid',$guestID,SQLITE3_INTEGER);
    if($stmt->execute())
        echo 'Guest deleted';
    else
        echo 'Failed to delete guest';
    $db -> close();
?>