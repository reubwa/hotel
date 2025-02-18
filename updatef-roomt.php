<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="script.js"></script>
    <title>Hotel Management</title>
</head>
<body onload="loadNavbar()">
    <?php
        session_start();
        if(!isset($_SESSION['UserData']['Username'])){
            header("location:login.php");
            exit;
        }
        $roomtID = isset($_GET['roomtID']) ? $_GET['roomtID'] : '';
        $db = new SQLite3('hotelm.db');
        $stmt = $db -> prepare("SELECT * FROM RoomType WHERE typeID = :rtid");
        $stmt -> bindValue(':rtid',$roomtID,SQLITE3_INTEGER);
        $result = $stmt -> execute();
        $row = $result -> fetchArray(SQLITE3_ASSOC);
        $name = $row['typeName'];
        $capacity = $row['capacity'];
        $costPerNight = $row['costPerNight'];
        $db -> close();  
    ?>
    <div id="navbar-container"></div>
    <div class="content-area">
        <h1 class="form-header">Update Room Type</h1>
        <div class="fieldset">
            <form action="roomt-update.php" method="post" autocomplete="on" target="_blank">
                <input type="number" placeholder=<?php echo $roomtID?> value=<?php echo $roomtID?> readonly name="typeID" id="typeID" step="1" required>
                <input type="text" placeholder=<?php echo $name?> value=<?php echo $name?> name="typeName" id="typeName" required>
                <input type="number" placeholder=<?php echo $capacity?> value=<?php echo $capacity?> name="capacity" id="capacity" step="1" required>
                <input type="number" placeholder=<?php echo $costPerNight?> value=<?php echo $costPerNight?> name="costPerNight" id="costPerNight" step="1" required>
                <input type="submit">
                <input type="reset">
            </form>
        </div>
    </div>
</body>
</html>