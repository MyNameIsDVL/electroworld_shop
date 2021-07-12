<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="app1.css">
</head>
<body>
 <div class="rlform">
  <div class="rlform rlform-wrapper">
   <div class="rlform-box">
    <div class="rlform-box-inner">
   <form  action="selectLogin.php" method="post">
    <p>Sign in to continue</p>

    <?php
    
			if (isset($_SESSION['status']) && $_SESSION['status'] !='')
			{
				echo '<h2 class="bg-danger"> '.$_SESSION['status'].' </h2>';
				unset($_SESSION['status']);
			}
		?>

    <div class="rlform-group">
     <label>Email</label>
     <input type="email" name="email" class="rlform-input" required>
    </div>

    <div class="rlform-group password-group">
     <label>Password</label>
     <input type="password" name="passwordd" class="rlform-input" required>
    </div>

    <button type="submit" class="rlform-btn" name="submit">Sign In
    </button>

    <div class="text-foot">
    Don't have an account? <a href="registeruser.php">Register</a>
    </div>
    <a href="remindpass.php" class="login-forgot">Zapomniałeś/aś loginu/hasła?</a>
   </form>
  </div>
   </div>
     </div>
 </div>
 </body>
</html>