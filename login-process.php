<?php
    session_start(); /* Starts the session */
        
    /* Check Login form submitted */        
    if(isset($_POST['Submit'])){
            /* Define username and associated password array */
            $logins = array('admin' => '123456','admin2' => '123456');
            
            /* Check and assign submitted Username and Password to new variable */
            $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
            $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
            
            /* Check Username and Password existence in defined array */            
            if (isset($logins[$Username]) && $logins[$Username] == $Password){
                    /* Success: Set session variables and redirect to Protected page  */
                    $_SESSION['UserData']['Username']=$logins[$Username];
                    header("location:index.php");
                    exit;
            } else {
                    /*Unsuccessful attempt: Set error message */
                    $msg="<span style='color:red'>Invalid Login Details</span>";
                    header("location:login.php");
                    exit;
            }
    }
?>