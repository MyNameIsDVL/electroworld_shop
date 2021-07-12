<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "adminpanel");
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");


if (isset($_POST['submitf']))
{
    $today = getdate();
    $dt = $today['year']."-".$today['mon']."-".$today['mday']." ".$today['hours'].":".$today['minutes'].":".$today['seconds'];
    $imagese = $_SESSION['avatar'];
    $name = $_SESSION['fullName'];
    $info = $_POST['comf'];


        $query = "INSERT into messageop (email, date, info, photo) values ('$name', '$dt', '$info', '$imagese')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run)
        {
            header('Location: indexshop.php');
        }
        else{
            header('Location: indexshop.php');
        }    
}



?>