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
        $bookingID = isset($_GET['bookingID']) ? $_GET['bookingID'] : '';
        $db = new SQLite3('hotelm.db');
        $stmt = $db -> prepare("SELECT * FROM Booking WHERE bookingID = :bid");
        $stmt -> bindValue(':bid',$bookingID,SQLITE3_INTEGER);
        $result = $stmt -> execute();
        $row = $result -> fetchArray(SQLITE3_ASSOC);
        $checkInDate = $row['bookingCheckInDate'];
        $checkOutDate = $row['bookingCheckOutDate'];
        $cost = $row['bookingCost'];
        $hotelID = $row['hotelID'];
        $roomNo = $row['roomNo'];
        $guestID = $row['guestID'];
    ?>
    <div id="navbar-container"></div>
    <div class="content-area">
        <h1 class="form-header">Update Booking</h1>
        <div class="fieldset">
        <form action="bookings-update.php" method="post" autocomplete="on" target="_blank">
                <input type="number" readonly placeholder=<?php echo $bookingID?> value=<?php echo $bookingID?> id="bookingID" name="bookingID" step="1" required>
                <label for="bookingCheckInDate">Check In</label>
                <input type="date" id="bookingCheckInDate" placeholder=<?php echo $checkInDate?> value=<?php echo $checkInDate?> name="bookingCheckInDate" required>
                <label for="bookingCheckOutDate">Check Out</label>
                <input type="date" id="bookingCheckOutDate" placeholder=<?php echo $checkOutDate?> value=<?php echo $checkOutDate?> name="bookingCheckOutDate" required>
                <input type="number" placeholder=<?php echo $cost?> value=<?php echo $cost?> id="bookingCost" name="bookingCost" step="1" required>
                <label for="hotelID">Hotel</label>
                <?php
                    $db = new SQLite3('hotelm.db');
                    $query = "SELECT hotelID, hotelName FROM Hotel";
                    $result = $db -> query($query);
                    echo '<select name="hotelID" id="hotelID">';
                    while($row=$result->fetchArray(SQLITE3_ASSOC)) {
                        if($row['hotelID']==$hotelID){
                            echo '<option selected value="'.$row['hotelID'].'">'.$row['hotelName'].'</option>';
                        }
                        else{
                            echo '<option value="'.$row['hotelID'].'">'.$row['hotelName'].'</option>';
                        }
                    }
                    echo '</select>';
                    $db -> close();
                ?>
                <input type="number" placeholder=<?php echo $roomNo?> value=<?php echo $roomNo?> id="roomNo" name="roomNo" required>
                <label for="guestID">Guest</label>
                <?php
                    $db = new SQLite3('hotelm.db');
                    $query = "SELECT guestID, guestFirstName, guestLastName FROM Guest";
                    $result = $db -> query($query);
                    echo '<select name="guestID" id="guestID">';
                    while($row=$result->fetchArray(SQLITE3_ASSOC)) {
                        if($row['guestID']==$guestID){
                            echo '<option selected value="'.$row['guestID'].'">'.$row['guestFirstName'].' '.$row['guestLastName'].'</option>';
                        }
                        else{
                            echo '<option value="'.$row['guestID'].'">'.$row['guestFirstName'].' '.$row['guestLastName'].'</option>';
                        }
                    }
                    echo '</select>';
                    $db -> close();
                ?>
                <br>
                <input type="submit">
                <input type="reset">
            </form>
        </div>
    </div>
</body>
</html>