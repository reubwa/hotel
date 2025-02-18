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
        $hotelID = isset($_GET['hotelID']) ? $_GET['hotelID'] : '';
        $db = new SQLite3('hotelm.db');
        $stmt = $db -> prepare("SELECT * FROM Hotel WHERE hotelID = :hid");
        $stmt -> bindValue(':hid',$hotelID,SQLITE3_INTEGER);
        $result = $stmt -> execute();
        $row = $result -> fetchArray(SQLITE3_ASSOC);
        $name = $row['hotelName'];
        $address = $row['hotelAddress'];
        $city = $row['city'];
        $postcode = $row['postcode'];
        $hotelTelNo = $row['hotelTelNo'];
        $db -> close();
    ?>
    <div id="navbar-container"></div>
    <div class="content-area">
        <h1 class="form-header">Update Hotel</h1>
        <div class="fieldset">
            <form action="hotels-update.php" method="post" autocomplete="on" target="_blank">
                <input type="number" placeholder=<?php echo $hotelID?> value=<?php echo $hotelID?> step="1" id="hotelID" name="hotelID" readonly required>
                <input type="text" placeholder=<?php echo $name?> value=<?php echo $name?> id="hotelName" name="hotelName" required>
                <textarea placeholder=<?php echo $address?> id="hotelAddress" name="hotelAddress" required><?php echo $address?></textarea>
                <input type="text" placeholder=<?php echo $city?> value=<?php echo $city?> id="city" name="city" required>
                <input type="text" placeholder=<?php echo $postcode?> value=<?php echo $postcode?> id="postcode" name="postcode" required>
                <input type="number" placeholder=<?php echo $hotelTelNo?> value=<?php echo $hotelTelNo?> id="hotelTelNo" name="hotelTelNo" required>
                <input type="submit">
                <input type="reset">
            </form>
        </div>
    </div>
</body>
</html>