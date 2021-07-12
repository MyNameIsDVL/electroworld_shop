<?php
session_start();

if (isset($_POST['logoutshop']))
{
    session_destroy();
    unset($_SESSION['fullName']);
    header('Location: index.html');
}
?>