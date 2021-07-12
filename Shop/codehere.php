<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "adminpanel");
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

if (isset($_POST['registerbtn']))
{
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phonen = $_POST['phonenumber'];
    $country = $_POST['country'];
    $place = $_POST['place'];

    $passw = mysqli_real_escape_string($connection, $password);
    if (strlen($passw) >= 8) {
        if (!ctype_upper($passw) && !ctype_lower($passw) && !ctype_digit($passw)) {
            if (preg_match("#[0-9]+#",$passw) && preg_match("#[A-Z]+#",$passw) && preg_match("#[a-z]+#",$passw)) {
                if(mysqli_connect_error()){
                    die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
                }else{
                    $passw = md5($passw);

                    //$query1 = "INSERT into users (phonenumber, country, place) values ('$phonen', '$country', '$place') where id='$id'";
                    //$query_run1 = mysqli_query($connection, $query1);
                    $query = "UPDATE users set fullName='$username', email='$email', passwordd='$passw', phonenumber='$phonen', country='$country', place='$place' where id='$id'";   
                    $query_run = mysqli_query($connection, $query);

                    if ($query_run)
                    {
                        session_destroy();
                        unset($_SESSION['fullName']);
                        header('Location: loginuser.php');    
                    }
                    else{
                        $_SESSION['status'] = "Error";
                        header('Location: profile.php');
                    }
                }
                }
                    else {
                        $_SESSION['status'] = "The password must contain uppercase and lowercase letters and numbers!"; 
                        header("Location: profile.php");
                    }
                }
                else {
                    $_SESSION['status'] = "The password cannot contain all uppercase or lowercase letters or only numbers!"; 
                    header("Location: profile.php");
                }
            }
            else {
                $_SESSION['status'] = "The password must have more than 8 characters!"; 
                header("Location: profile.php");
            } 

}




?>
