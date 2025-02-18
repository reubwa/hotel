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
    <div id="navbar-container"></div>
    <div class="content-area">
        <h1 class="form-header">New Booking</h1>
        <div class="fieldset">
            <form action="bookings-new.php" method="post" autocomplete="on" target="_blank">
                <label for="bookingCheckInDate">Check In</label>
                <input type="date" id="bookingCheckInDate" name="bookingCheckInDate" required>
                <label for="bookingCheckOutDate">Check Out</label>
                <input type="date" id="bookingCheckOutDate" name="bookingCheckOutDate" required>
                <input type="number" placeholder="Cost" id="bookingCost" name="bookingCost" step="1" required>
                <label for="hotelID">Hotel</label>
                <?php
                    session_start();
                    if(!isset($_SESSION['UserData']['Username'])){
                        header("location:login.php");
                        exit;
                    }
                    $db = new SQLite3('hotelm.db');
                    $query = "SELECT hotelID, hotelName FROM Hotel";
                    $result = $db -> query($query);
                    echo '<select name="hotelID" id="hotelID">';
                    while($row=$result->fetchArray(SQLITE3_ASSOC)) {
                        echo '<option value="'.$row['hotelID'].'">'.$row['hotelName'].'</option>';
                    }
                    echo '</select>';
                    $db -> close();
                ?>
                <input type="number" placeholder="Room Number" id="roomNo" name="roomNo" required>
                <label for="guestID">Guest</label>
                <?php
                    $db = new SQLite3('hotelm.db');
                    $query = "SELECT guestID, guestFirstName, guestLastName FROM Guest";
                    $result = $db -> query($query);
                    echo '<select name="guestID" id="guestID">';
                    while($row=$result->fetchArray(SQLITE3_ASSOC)) {
                        echo '<option value="'.$row['guestID'].'">'.$row['guestFirstName'].' '.$row['guestLastName'].'</option>';
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