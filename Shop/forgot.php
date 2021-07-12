<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'adminpanel');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ELECTROWORLD</title>
		<link href="app1.css" rel="stylesheet"/>
  </head>
  <body>

  <div class="container login-form">
	<div class="rlform">
		<div class="rlform rlform-wrapper">
      <div class="rlform-box">
        <div class="rlform-box-inner">
          <p>Remind password</p>
<?php

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$pass_errors = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	
		
		$q = 'SELECT id FROM users WHERE email="'.  mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
		$r = mysqli_query ($dbc, $q);
		
		if (mysqli_num_rows($r) == 1) { 
			list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM); 
		} else { 
            echo '<h2 style="text-align:center">Your e-mail address is not registered in the database!</h2>';
            echo '<button class="rlform-btn" onclick="tryAgain()">Try one more time</button><script>
            function tryAgain()
            {
                 location.href = "remindpass.php";
            } 
            </script>';
            exit();
		}
		
	} else { 
		echo 'Enter a valid e-mail address!';
	} 
	
	if (empty($pass_errors)) { 


		$p = substr(uniqid(rand(), true), 9);

    $pass = md5($p);
		$q = "UPDATE users SET passwordd='" . $pass . "' WHERE id=$uid LIMIT 1";
		$r = mysqli_query ($dbc, $q);
		
		if (mysqli_affected_rows($dbc) == 1) { 
		
			$body = "The password required to log in to our website has been temporarily changed to '$p'. Log in with this password and e-mail address. After logging in, you can change your password.";
			require_once "PHPMailer.php";
      require_once "SMTP.php";


$mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "mateuszhus1994@gmail.com";
    $mail->Password = "Lenovo123";
    $mail->SetFrom("mateuszhus1994@gmail.com");
    $mail->Subject = "Remind password";
    $mail->Body = $body;
    $mail->AddAddress($_POST['email']);
    $mail->CharSet = 'UTF-8';
    $mail->Send();
   
            echo '<h1 style="text-align:center">Your password has been changed.</h1><p>A message with a temporary password will come to your inbox. After logging in to the site with a new password, you can change it.</p>';
            echo '<button class="rlform-btn" onclick="page()">Home</button><script>
            function page()
            {
                 location.href = "index.html";
            } 
            </script>';
            
			exit(); 
			
		} else { 
	
			trigger_error('The password cannot be changed due to a system error.'); 

		}

    }}
?>
