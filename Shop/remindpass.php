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
        <form action="forgot.php" method="POST">
        <div class="rlform">
            <div class="rlform rlform-wrapper">
                <div class="rlform-box">
                    <div class="rlform-box-inner">
                        <form method="post" oninput="validatePassword()">
                            <p>
                            Remind password!
                            </p>

                            <?php
    
                                if (isset($_SESSION['status']) && $_SESSION['status'] !='')
                                {
                                    echo '<h2 class="bg-danger"> '.$_SESSION['status'].' </h2>';
                                    unset($_SESSION['status']);
                                }
                            ?>

                            <div class="rlform-group">
                            <form action="" method="post">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input id="txtEmail" type="email" class="rlform-input" name="email" placeholder="" required>
                                
                                <button class="rlform-btn" style="margin-top: 10px;" type="submit" name="submit"> Send</button>
                            </form>	
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