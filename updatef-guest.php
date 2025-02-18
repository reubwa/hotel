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
        $guestID = isset($_GET['guestID']) ? $_GET['guestID'] : '';
        $db = new SQLite3('hotelm.db');
        $stmt = $db -> prepare("SELECT * FROM Guest WHERE guestID = :gid");
        $stmt -> bindValue(':gid',$guestID,SQLITE3_INTEGER);
        $result = $stmt -> execute();
        $row = $result -> fetchArray(SQLITE3_ASSOC);
        $firstName = $row['guestFirstName'];
        $lastName = $row['guestLastName'];
        $email = $row['guestEmail'];
        $phoneNo = $row['guestPhoneNo'];
        $address = $row['guestAddress'];
        $db -> close();  
    ?>
    <div id="navbar-container"></div>
    <div class="content-area">
        <h1 class="form-header">Update Guest</h1>
        <div class="fieldset">
            <form action="guests-update.php" method="post" autocomplete="on" target="_blank">
                <input type="number" placeholder=<?php echo $guestID?> value=<?php echo $guestID?> step="1" id="guestID" name="guestID" readonly required>
                <input type="text" placeholder=<?php echo $firstName?> value=<?php echo $firstName?> id="guestFirstName" name="guestFirstName" required>
                <input type="text" placeholder=<?php echo $lastName?> value=<?php echo $lastName?> id="guestLastName" name="guestLastName" required>
                <input type="text" placeholder=<?php echo $email?> value=<?php echo $email?> id="guestEmail" name="guestEmail" required>
                <input type="number" placeholder=<?php echo $phoneNo?> value=<?php echo $phoneNo?> id="guestPhoneNo" name="guestPhoneNo" required>
                <textarea placeholder=<?php echo $address?> id="guestAddress" name="guestAddress" required><?php echo $address?></textarea>
                <input type="submit">
                <input type="reset">
            </form>
        </div>
    </div>
</body>
</html>