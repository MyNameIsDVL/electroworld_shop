<?php

$email = $_POST['email'];

if(!empty($email)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "adminpanel";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }else{
        $SELECT = "SELECT email from mail where email = ? LIMIT 1";
        $INSERT = "INSERT Into mail (email) values (?)";

        //To protected connection
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0)
        {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            header("Location: indexshop.php");
        }else{
            echo 'mail already used';
        }
        $stmt->close();
        $conn->close();
    }
}
else{
    echo "All field are required";
    die();
}

?>