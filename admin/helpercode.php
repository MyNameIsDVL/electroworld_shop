<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "adminpanel");
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

if (isset($_POST['messagebtn']))
{
    $email = $_POST['guidemail'];
    $title = $_POST['text2'];
    $note = $_POST['textarea3'];
    $autor = $_SESSION['username'];

    $query = "INSERT into messagecon (email, title, note, autor) values ('$email', '$title', '$note', '$autor')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION['success'] = "Wiadomość wysłana";
        header('Location: techhelper.php');
    }
    else{
        $_SESSION['status'] = "Błąd podczas wysyłania";
        header('Location: techhelper.php');
    }
}

?>