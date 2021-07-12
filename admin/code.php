<?php
include('security.php');


$connection = mysqli_connect("localhost", "root", "", "adminpanel");
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

if (isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    if ($password === $cpassword)
    {
        $query = "INSERT into register (username, email, password) values ('$username', '$email', '$password')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run)
        {
            $_SESSION['success'] = "Dodany";
            header('Location: register.php');
        }
        else{
            $_SESSION['status'] = "Błąd";
            header('Location: register.php');
        }
    }
    else{
        $_SESSION['status'] = "Password and conform password does not match";
        header('Location: register.php');
    }   
}



if (isset($_POST['edit_btn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * from register where id='$id'";
    $query_run = mysqli_query($connection, $query);
}




if (isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register set username='$username', email='$email', password='$password' where id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION['success'] = "Zmieniłem";
        header('Location: register.php');
    }
    else{
        $_SESSION['status'] = "Błąd";
        header('Location: register.php');
    }
}



if (isset($_POST['deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE from register where id='$id'";
    $query_run = mysqli_query($connection, $query);
    
    if ($query_run)
    {
        $_SESSION['success'] = "Usunąłem";
        header('Location: register.php');
    }
    else{
        $_SESSION['status'] = "Błąd";
        header('Location: register.php');
    }
}



if (isset($_POST['login_btn']))
{  

    $username_login = $_POST['text'];
    $password_login = $_POST['password'];

    $query = "SELECT username, password from register where username='".$username_login."'AND password='".$password_login."' limit 1";


    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $username_login, $password_login);
    $stmt->execute();
    $stmt->bind_result($username_login, $password_login);
    $stmt->store_result();

 
        if ($stmt->fetch())
        {
            $_SESSION['username'] = $username_login;
            header('Location: linksmod.php');
        }
        else{
            $_SESSION['status'] = "Nazwa lub hasło jest błędne";
            header('Location: login.php');
        }
 
}






?>