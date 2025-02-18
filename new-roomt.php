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
        <h1 class="form-header">New Room Type</h1>
        <div class="fieldset">
            <form action="roomt-new.php" method="post" autocomplete="on" target="_blank">
                <!--<input type="number" placeholder="ID" name="typeID" id="typeID" step="1">-->
                <input type="text" placeholder="Name" name="typeName" id="typeName" required>
                <input type="number" placeholder="Capacity" name="capacity" id="capacity" step="1" required>
                <input type="number" placeholder="Cost per Night" name="costPerNight" id="costPerNight" step="1" required>
                <input type="submit">
                <input type="reset">
            </form>
        </div>
    </div>
</body>
</html>