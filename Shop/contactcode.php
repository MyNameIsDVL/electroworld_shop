<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "adminpanel");
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

if (isset($_POST['messagebtn']))
{
    $email = $_SESSION['fullName'];
    $title = $_POST['text2'];
    $note = $_POST['textarea3'];

    $query = "INSERT into messagecon (email, title, note) values ('$email', '$title', '$note')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION['success'] = "Message sended";
        header('Location: contact.php');
    }
    else{
        $_SESSION['status'] = "Message not sended";
        header('Location: contact.php');
    }
}

?>