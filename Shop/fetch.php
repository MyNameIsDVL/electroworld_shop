<?php
if (isset($_POST["id"]))
{
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "adminpanel");
    $connect->query("SET NAMES utf8 COLLATE utf8_polish_ci");
    $query = "SELECT * FROM tbl_shop_product where id='".$_POST["id"]."'";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_array($result))
    {

        $output = '
            <p><img src="../images/'.$row["image"].'" class="img-responsive"/><br /></p>
            <p><label>Name: </label> '.$row['name'].' </p>
            <p><label>Type: </label> '.$row['type'].' </p>
            <p><label>Brand: </label> '.$row['brands'].' </p>
            <p><label>Info: </label> '.$row['info'].' </p>
        ';
    }
    echo $output;
}
?>