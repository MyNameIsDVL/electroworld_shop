<?php
session_start();

if (!$_SESSION['fullName'])
{
    header('Location: loginuser.php');
}
?>

