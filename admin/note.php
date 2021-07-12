<?php

$connection = mysqli_connect("localhost", "root", "", "adminpanel");

if (isset($_POST['notebtn']))
{
    $area = $_POST['area'];

    $query = "INSERT into notes (note) values ('$area')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION['success'] = "Zapisane";
        header('Location: indexnote.php');
    }
    else{
        $_SESSION['status'] = "Błąd";
        header('Location: indexnote.php');
    }  
}

?>