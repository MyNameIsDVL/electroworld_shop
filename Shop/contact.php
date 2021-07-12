<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'adminpanel');
$connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

$today = getdate();
$date = $today['year']."-".$today['mon']."-".$today['mday'];
$time = $today['hours'].":".$today['minutes'].":".$today['seconds'];
$name = $_SESSION['fullName'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Contact</title>
        <link href="contact.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="content">
        <div class="closef">+</div> 
            <div class="box1">
                <div class="form-style-6">
                    <h1>Contact Us Now:</h1>
                    <form action="contactcode.php" method="POST">
                        <input type="email" name="email1" placeholder="Email Address" value="<?php echo $name; ?>" disabled/>
                        <input id="txtfield" type="text" name="text2" placeholder="Title"/>                      
                        <textarea name="textarea3" id="areacon" placeholder="Type your Message"></textarea>
                        <input type="submit" name="messagebtn" value="Send"/>
                    </form>
                </div>
            </div>
            <div class="box2">
                <h1>Your messages:</h1>

                <?php
                    if (isset($_SESSION['success']) && $_SESSION['success'] !="")
                    {
                        echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>';
                        unset($_SESSION['success']);
                    }
                    if (isset($_SESSION['status']) && $_SESSION['status'] !='')
                    {
                        echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                        unset($_SESSION['status']);
                    }
                ?>

                <?php
                    $query = "SELECT * from messagecon where email='$name'";
                    $query_run = mysqli_query($connection, $query);
                ?>

                    <?php
                        if (mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                    ?>

                <ul id="ul-messagecon">
                    <li>Email (Your guid): <?php echo $name; ?></li>
                    <li>Date: <?php echo $date; ?></li>
                    <li>Time: <?php echo $time; ?></li>
                    <li id="li-author">Author: <?php echo $row['autor']; ?></li>
                    <li id="li-title">Title: <?php echo $row['title']; ?></li>
                    <li id="li-message">Message: <?php echo $row['note']; ?></li>
                </ul>

                <?php
                        }
                    }
                    else{
                        echo "No record found";
                    }
                ?>

            </div>
            <div class="box4">
                <h2>Others:</h2>
                <ul id="ul-contact">
                    <li>Numbers:</li>
                    <li>+48 546 657 876</li>
                    <li>+48 675 221 332</li>
                </ul>
            </div>
        </div>
        <script src="signx.js"></script>
    </body>
</html>