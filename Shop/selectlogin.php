<?php
session_start();

if(isset($_POST['submit']))
{
        $user_name = $_POST['email'];
        $user_pass = $_POST['passwordd'];
        if(!$user_name || !$user_pass)
        {
            echo "You have not entered all the required details.'.'Please try again.";
        }

    
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "adminpanel";

    
    
        $link = new mysqli($host, $user, $pass, $db);
   
    if($link->connect_errno > 0){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{echo "connected"."";}
  
    $user_pass = mysqli_real_escape_string($link, $user_pass);
    $user_pass = md5($user_pass);

    $query = "SELECT email, passwordd, photo FROM users WHERE email='".$user_name."'AND passwordd='".$user_pass."' limit 1";
 
    $result = $link->query($query);

    if(!$result = $link->query($query))
    {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }
    else
    {
        echo "Field";      
    }

    $row = $result->fetch_assoc();

  
    if($row['email']=="$user_name" && $row['passwordd']=="$user_pass")
    {
        $_SESSION['fullName'] = $user_name;
        $_SESSION['avatar'] = $row['photo'];
        header("Location: indexshop.php");
    } 
        else
        {       
            $_SESSION['status'] = "Name or password is wrong";   
            header("Location: loginuser.php"); 
        } 
} 


?>