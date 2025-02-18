<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="script.js"></script>
    <title>Hotel Management</title>
    <?php
        session_start();
        if(!isset($_SESSION['UserData']['Username'])){
            header("location:login.php");
            exit;
        }
    ?>
</head>
<body onload="loadNavbar()">
    <?php
        $hotelID = isset($_GET['hotelID']) ? $_GET['hotelID'] : '';
        $roomNo = isset($_GET['roomNo']) ? $_GET['roomNo'] : '';
        $stmt = $db -> prepare("SELECT * FROM Room WHERE hotelID = :hid AND roomNo = :rn");
        $stmt -> bindValue(':hid',$hotelID,SQLITE3_INTEGER);
        $stmt -> bindValue(':rn',$roomNo,SQLITE3_INTEGER);
        $result = $stmt -> execute();
        $row = $result -> fetchArray(SQLITE3_ASSOC);
        $typeID = $row['typeID'];
        $db -> close();
    ?>
    <div id="navbar-container"></div>
    <div class="content-area">
        <h1 class="form-header">Update Room</h1>
        <div class="fieldset">
            <form action="rooms-update.php" method="post" autocomplete="on" target="_blank">
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
            <input type="number" placeholder=<?php echo $roomNo?> value=<?php echo $roomNo?> id="roomNo" name="roomNo" step="1" required>
            <label for="typeID">Room Type</label>
                <?php
                    $db = new SQLite3('hotelm.db');
                    $query = "SELECT typeID, typeName FROM RoomType";
                    $result = $db -> query($query);
                    echo '<select name="typeID" id="typeID">';
                    while($row=$result->fetchArray(SQLITE3_ASSOC)) {
                        if($row['typeID'==$typeID]){
                            echo '<option selected value="'.$row['typeID'].'">'.$row['typeName'].'</option>';
                        }
                        else{
                            echo '<option value="'.$row['typeID'].'">'.$row['typeName'].'</option>';
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