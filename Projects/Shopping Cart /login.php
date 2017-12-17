<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
include "sql/connect_mysql.php";





$email = $mysqli->escape_string($_POST['email']);

$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");


if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.html");
}
else { // User exists
    $user = $result->fetch_assoc();
    $username = $user['username'];
    $amountspent = $user['amountspent'];
    if ( password_verify($_POST['password'], $user['password']) ) {


        setcookie("username", $username,time()+36000);
        setcookie("amountspent", $amountspent,time()+36000);

        $_SESSION['email'] = $user['email'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;



       header("location: getSite.html");
    }
    else  {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: errorpass.html");
    }


}
