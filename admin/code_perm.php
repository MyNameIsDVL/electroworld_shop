<?php
include('security.php');


$connection = mysqli_connect("localhost", "root", "", "adminpanel");
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

if (isset($_POST['registerpermbtn']))
{
    $username = $_POST['username'];
    $calledfunction = $_POST['calledfunction'];
    $action = $_POST['action'];
    $permission = $_POST['permission'];


    $query = "INSERT into security (username, calledfunction, action, permission) values ('$username', '$calledfunction', '$action', '$permission')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION['success'] = "Dodane";
        header('Location: permission.php');
    }
    else{
        $_SESSION['status'] = "Błąd";
        header('Location: permission.php');
    }  
}



if (isset($_POST['edit_btn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * from security where id='$id'";
    $query_run = mysqli_query($connection, $query);
}




if (isset($_POST['updatebtnperm']))
{
    $id = $_POST['edit_id'];
    $permission = $_POST['edit_permission'];

    $query = "UPDATE security set permission='$permission' where id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION['success'] = "Zmieniłem";
        header('Location: permission.php');
    }
    else{
        $_SESSION['status'] = "Błąd";
        header('Location: permission.php');
    }
}



if (isset($_POST['deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE from security where id='$id'";
    $query_run = mysqli_query($connection, $query);
    
    if ($query_run)
    {
        $_SESSION['success'] = "Usunąłem";
        header('Location: permission.php');
    }
    else{
        $_SESSION['status'] = "Błąd";
        header('Location: permission.php');
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