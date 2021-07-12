<?php
include('security.php');


$connection = mysqli_connect("localhost", "root", "", "adminpanel");
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");


if (isset($_POST['addproduct']))
{
    $name = $_POST['name'];
    $file = $_POST['file'];
    $price = $_POST['price'];
    $info = $_POST['info'];
    $brands = $_POST['brands'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];


        $query = "INSERT into tbl_shop_product (name, image, price, info, brands, type, quan) values ('$name', '$file', '$price', '$info', '$brands', '$type', '$quantity')";
        $query_run = mysqli_query($connection, $query);


        //move file to antother dir
        
        //$tmpfile = 'c:/xampp/tdocs/dhf/files-tmp/'.$file;
        //$newfile = 'c:/xampp/tdocs/dhf/files/'.$file;
        $tmpfile = '../files-tmp/'.$file;
        $newfile = '../images/'.$file;

        if (!copy($tmpfile, $newfile)) {
            echo "failed to copy $tmpfile, $newfile...\n";
        }
        else {
            if (file_exists($newfile)) {
                unlink($tmpfile);
            }
        }
        
        //rename('../files-tmp/$file', '../files/$file');


        if ($query_run)
        {
            $_SESSION['success'] = "Plik został zatwierdzony.";
            header('Location: linksmod.php');
            //print_r($fileT);
        }
        else{
            $_SESSION['status'] = "Niepowodzenie.";
            header('Location: linksmod.php');
        } 

        
}



if (isset($_POST['edit_btn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * from tbl_shop_product where id='$id'";
    $query_run = mysqli_query($connection, $query);
}




if (isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $price = $_POST['edit_price'];
    $info = $_POST['edit_info'];
    $brands = $_POST['edit_brands'];
    $type = $_POST['edit_type'];
    $quantity = $_POST['edit_quantity'];

    $query = "UPDATE tbl_shop_product set name='$name', price='$price', info='$info', brands='$brands', type='$type', quan='$quantity' where id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION['success'] = "Dane zostały zapisane.";
        header('Location: linksmod.php');
    }
    else{
        $_SESSION['status'] = "Niepowodzenie.";
        header('Location: linksmod.php');
    }
}



if (isset($_POST['deletebtn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE from tbl_shop_product where id='$id'";
    $query_run = mysqli_query($connection, $query);
    
    if ($query_run)
    {
        $_SESSION['success'] = "Rekord został usunięty.";
        header('Location: linksmod.php');
    }
    else{
        $_SESSION['status'] = "Niepowodzenie.";
        header('Location: linksmod.php');
    }
}










?>