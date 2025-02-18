<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Hotel Management</title>
</head>
<body>
    <div class="content-area">
        <h1 class="form-header">Login</h1>
        <div class="fieldset">
            <form action="login-process.php" method="post" autocomplete="on">
                <?php
                    if(isset($msg)){
                        echo $msg;
                    }
                ?>
                <input name="Username" type="text" placeholder="Username">
                <input name="Password" type="password" placeholder="Password">
                <input name="Submit" type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>