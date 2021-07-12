<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php');

    $connection = mysqli_connect('localhost', 'root', '', 'adminpanel');
    $connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");

    $today = getdate();
    $date = $today['year']."-".$today['mon']."-".$today['mday'];
    $time = $today['hours'].":".$today['minutes'].":".$today['seconds'];
    $name = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Contact</title>
    </head>
    <body>
    <style>
body {
    width: 100%;
    height: 100%;
    margin:0;
    padding: 0;
    background-color: white;
}

.box1 {
    background: #222222;
    font-family: Arial, Helvetica, sans-serif;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
}

.box2 {
    background: #222;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
    font-family: Arial, Helvetica, sans-serif;
    overflow: auto;
}

.box4 {
    background: #222222;
    font-family: Arial, Helvetica, sans-serif;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
}

.content {
    display: grid;
    width: 100%;
    height: 100vh;
    grid-template-columns: 1fr 2fr;
    grid-template-rows: 1fr 1fr;
}

.box1 {
    grid-column: 1/2;
    grid-row: 1/2;

    margin: 50px 5px 5px 50px;
}

.box2 {
    grid-row: 1/3; 

    margin: 50px 50px 50px 5px;
}

.box4 {
    grid-column: 1/2;
    grid-row: 2/3;

    margin: 5px 5px 50px 50px;
}

/*form email*/

.form-style-6{
	font: 95% Arial, Helvetica, sans-serif;
    max-width: 100%;
    margin: 10px 10px 10px 10px;
	padding: 2px;
	background: #F7F7F7;
}
.form-style-6 h1{
    background: #222222;
    padding: 2px 0;
    top: 20px;
	font-size: 140%;
	font-weight: bold;
	text-align: center;
	color: #fff;
    margin: 0 auto;
}
.form-style-6 input[type="text"],
.form-style-6 input[type="date"],
.form-style-6 input[type="datetime"],
.form-style-6 input[type="email"],
.form-style-6 input[type="number"],
.form-style-6 input[type="search"],
.form-style-6 input[type="time"],
.form-style-6 input[type="url"],
.form-style-6 textarea,
.form-style-6 select 
{
	outline: none;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	background: #fff;
	margin-bottom: 4%;
	border: 1px solid #ccc;
	padding: 3%;
	color: #555;
    font: 95% Arial, Helvetica, sans-serif;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}
.form-style-6 input[type="text"]:focus,
.form-style-6 input[type="date"]:focus,
.form-style-6 input[type="datetime"]:focus,
.form-style-6 input[type="email"]:focus,
.form-style-6 input[type="number"]:focus,
.form-style-6 input[type="search"]:focus,
.form-style-6 input[type="time"]:focus,
.form-style-6 input[type="url"]:focus,
.form-style-6 textarea:focus,
.form-style-6 select:focus
{
	box-shadow: 0 0 5px fuchsia;
	padding: 3%;
	border: 1px solid fuchsia;
}

.form-style-6 input[type="submit"],
.form-style-6 input[type="button"]{
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	padding: 3%;
	background: purple;
	border-bottom: 2px solid purple;
	border-top-style: none;
	border-right-style: none;
	border-left-style: none;	
    color: #fff;
    font-weight: bold;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}
.form-style-6 input[type="submit"]:hover,
.form-style-6 input[type="button"]:hover{
    background: orange;
    color: #222;
}

#txtfield {
    margin-top: 10px;
}

#areacon {
    height: 200px;
}

/*grid 4*/

h2 {
    font: 95% Arial, Helvetica, sans-serif;
    color: white;
    font-size: 25px;
    font-weight: bold;
    text-align: center;
    display: block;
    background: black;
    padding: 2px;
    box-shadow: 0 2px 5px 0 rgba(255, 1, 200, 0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}

#ul-contact {
    list-style: none;
}

#ul-contact li {
    font: 95% Arial, Helvetica, sans-serif;
    color: white;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    display: block;
    background: rgba(0,0,0,0.5);
    margin: 5px 5px 5px 5px;
    box-shadow: 0 2px 5px 0 rgba(255, 0, 0, 0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}

.box2 h1 {
    color: white;
    text-align: center;
    font-size: 20px;
    border-top-style: solid;
    border-bottom-style: solid;
    border-top-color: purple;
    border-bottom-color: purple;
    margin: 0;
    padding: 2px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}

#ul-messagecon {
    color: white;
    text-align: left;
    font-size: 20px;
    list-style: none;
    border-top-style: solid;
    border-bottom-style: solid;
    border-top-color: purple;
    border-bottom-color: purple;
    display: block;
    background: rgba(0,0,0,0.5);
    margin: 10px 30px 5px 30px;
    padding: 5px;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}

#li-title {
    display: block;
    background: #555;
    padding: 5px;
    margin-top: 5px;
    box-shadow: 0 2px 5px 0 rgba(255, 0, 0, 0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}

#li-message {
    display: block;
    background: purple;
    padding: 5px;
    margin-top: 5px;
    word-wrap: break-word;
    box-shadow: 0 2px 5px 0 rgba(255, 0, 0, 0.8), 0 2px 10px 0 rgba(0,0,0,0.8);
}
#li-autor{
    color: red;
}
#comboemail{
    height: 50px;
}
    </style>
        <div class="content">
            <div class="box1">
                <div class="form-style-6">
                    <h1>Kontakt z klientem:</h1>
                    <form action="helpercode.php" method="POST">
                        <input type="text" name="email1" placeholder="Nazwa administratora" value="<?php echo $name; ?>" disabled/>
                        <select class="form-control" name="guidemail" id="comboemail">
                            <?php
                            $query = "SELECT * from messagecon GROUP BY email";
                            $query_run = mysqli_query($connection, $query);
                            
                            while ($row1 = mysqli_fetch_array($query_run)):; ?>
                            <option><?php echo $row1[1]; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <input id="txtfield" type="text" name="text2" placeholder="Tytuł"/>                      
                        <textarea name="textarea3" id="areacon" placeholder="Wpisz wiadomość..."></textarea>
                        <input type="submit" name="messagebtn" value="Wyślij"/>
                    </form>
                </div>
            </div>
            <div class="box2">
                <h1>Wiadomości:</h1>

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
                    $query = "SELECT * from messagecon ORDER BY email";
                    $query_run = mysqli_query($connection, $query);
                ?>

                    <?php
                        if (mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                    ?>

                <ul id="ul-messagecon">
                    <li>Klient: <?php echo $row['email']; ?></li>
                    <li id="li-autor">Autor: <?php echo $row['autor']; ?></li>
                    <li id="li-title">Tytuł: <?php echo $row['title']; ?></li>
                    <li id="li-message">Wiadomość: <?php echo $row['note']; ?></li>
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
                <h2>Klient:</h2>
                
            </div>
        </div>
        <script src="signx.js"></script>
    </body>
</html>




<?php
    include('includes/scripts.php');
?>