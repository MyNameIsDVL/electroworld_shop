<?php
session_start();

$username = $_POST['fullName'];
$email = $_POST['email'];
$newpassword = $_POST['passwordd'];


if(!empty($username) || !empty($email) || !empty($newpassword)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "adminpanel";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    $passw = mysqli_real_escape_string($conn, $newpassword);
    if (strlen($passw) >= 8) {
    if (!ctype_upper($passw) && !ctype_lower($passw) && !ctype_digit($passw)) {
        if (preg_match("#[0-9]+#",$passw) && preg_match("#[A-Z]+#",$passw) && preg_match("#[a-z]+#",$passw)) {
            if(mysqli_connect_error()){
                die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
            }else{
                $passw = md5($passw);
                $SELECT = "SELECT email from users where email = ? LIMIT 1";
                $INSERT = "INSERT Into users (fullName, email, passwordd) values (?,?,?)";

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
                    $stmt->bind_param("sss", $username, $email, $passw);
                    $stmt->execute();
                    
                    header("Location: loginuser.php");
                }else{
                    $_SESSION['status'] = "This e-mail already exists!"; 
                    header("Location: registeruser.php");
                }
                $stmt->close();
                $conn->close();
            }
        }
        else {
            $_SESSION['status'] = "The password must contain uppercase and lowercase letters and numbers!"; 
            header("Location: registeruser.php");
        }
    }
    else {
    $_SESSION['status'] = "The password cannot contain all uppercase or lowercase letters or only numbers!"; 
    header("Location: registeruser.php");
    }
    }
    else {
    $_SESSION['status'] = "The password must have more than 8 characters!"; 
    header("Location: registeruser.php");
    } 
}
else{
    echo "All field are required";
    die();
}

?>