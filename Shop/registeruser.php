<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link href="app1.css" rel="stylesheet"/>
    </head>
    <body>
        <form action="insert.php" method="POST">
        <div class="rlform">
            <div class="rlform rlform-wrapper">
                <div class="rlform-box">
                    <div class="rlform-box-inner">
                        <form method="post" oninput="validatePassword()">
                            <p>
                                Lets create your new account!
                            </p>

                            <?php
    
                                if (isset($_SESSION['status']) && $_SESSION['status'] !='')
                                {
                                    echo '<h2 class="bg-danger"> '.$_SESSION['status'].' </h2>';
                                    unset($_SESSION['status']);
                                }
                            ?>

                            <div class="rlform-group">
                                <label>Full Name</label>
                                <input type="text" name="fullName" class="rlform-input" required>
                            </div>

                            <div class="rlform-group">
                                <label>Email</label> 
                                <input type="email" name="email" class="rlform-input" required>
                            </div>
                            <div class="rlform-group">
                                <label>Password</label>
                                <input type="password" name="passwordd" id="newPass" class="rlform-input" required>
                            </div>
                            <button type="submit" class="rlform-btn" name="signIn">Register
                            </button>
                            <div class="text-foot">
                                Already have an account? <a href="loginuser.php">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <script type="text/javascript">
            function validatePassword(){
                if(newPass.value!=conformPass.value){
                    conformPass.setCustomValidity('Password not match');
                }
                else{
                    conformPass.setCustomValidity('');
                }
            }
        </script>
    </body>
</html>