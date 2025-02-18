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
    <div id="navbar-container"></div>
    <div class="content-area">
        <h1 class="form-header">New Hotel</h1>
        <div class="fieldset">
            <form action="hotels-new.php" method="post" autocomplete="on" target="_blank">
                <input type="text" placeholder="Name" id="hotelName" name="hotelName" required>
                <textarea placeholder="Address" id="hotelAddress" name="hotelAddress" required></textarea>
                <input type="text" placeholder="City" id="city" name="city" required>
                <input type="text" placeholder="Postcode" id="postcode" name="postcode" required>
                <input type="number" placeholder="Phone Number" id="hotelTelNo" name="hotelTelNo" required>
                <input type="submit">
                <input type="reset">
            </form>
        </div>
    </div>
</body>
</html>