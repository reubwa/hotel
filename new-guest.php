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
        <h1 class="form-header">New Guest</h1>
        <div class="fieldset">
            <form action="guests-new.php" method="post" autocomplete="on" target="_blank">
                <input type="text" placeholder="First Name" id="guestFirstName" name="guestFirstName" required>
                <input type="text" placeholder="Last Name" id="guestLastName" name="guestLastName" required>
                <input type="text" placeholder="Email" id="guestEmail" name="guestEmail" required>
                <input type="number" placeholder="Phone Number" id="guestPhoneNo" name="guestPhoneNo" required>
                <textarea placeholder="Address" id="guestAddress" name="guestAddress" required></textarea>
                <input type="submit">
                <input type="reset">
            </form>
        </div>
    </div>
</body>
</html>