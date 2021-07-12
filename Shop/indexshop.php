<?php
    include('securweb.php');

    $connect = new PDO("mysql:host=localhost;dbname=adminpanel", "root", "");
    $connect->query("SET NAMES utf8 COLLATE utf8_polish_ci");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link href="swiper.min.css" rel="stylesheet"/>
        <title>ElectroWorld</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <header id="top" class="headertop">
            <p class="containerbar">+48 546 657 876 | +48 675 221 332<span class="containersale">Free shipping from 240 $ / 30 days for return | electroworld@gmail.com</span></p>              
            <div class="menu">
                <div class="bar"></div>
            </div> 
            <div class="overlay"></div>
        </header>
        <section>     
            <nav class="nav-a">
                <a href="" class="brand">ElectroWorld</a>
                    <ul>
                        <li class="nav.item">
                            <a href="orders.php" class="nav-link" data-text="Orders">Orders</a>
                        </li>
                        <li class="nav.item">
                            <a href="brands.php" class="nav-link" data-text="Brands">Brands</a>
                        </li>
                        <li class="nav.item">
                            <a href="contact.php" class="nav-link" data-text="Contact">Contact</a>
                        </li>
                        <li class="nav.item">
                            <a href="aboutew.html" class="nav-link" data-text="About">About</a>
                        </li>                      
                        <li class="nav.item">
                            <form action="logoutshop.php" method="post">
                                <button type="submit" name="logoutshop" id="btnlogoutshop" class="nav-link" data-text="Logout">Logout</button>
                            </form>
                        </li>
                        <li class="nav.item">
                            <a href="profile.php" class="nav-link" data-text="<?php echo $_SESSION['fullName']; ?>"><?php echo $_SESSION['fullName']; ?></a>
                        </li>
                    </ul>
            </nav>
        </section>   


        <div class="content1">
            <div class="box1">

                <!-- Swiper -->
        <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="imgBox">
                            <img src="../images/Konsole.jpg">
                        </div>
                        <div class="details">
                            <h3><a href="">Consoles</a><br><span></span></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgBox">
                            <img src="../images/Podzespoly.jpg">
                        </div>
                        <div class="details">
                            <h3><a href="">Components</a><br><span></span></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgBox">
                            <img src="../images/Pralki.jpg">
                        </div>
                        <div class="details">
                            <h3>Washing machine<br><span></span></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                            <div class="imgBox">
                                <img src="../images/Telefony.jpg">
                            </div>
                        <div class="details">
                            <h3>Smartphones<br><span></span></h3>
                        </div>
                    </div>  
                    <div class="swiper-slide">
                        <div class="imgBox">
                            <img src="../images/laptopy.jpg">
                        </div>
                        <div class="details">
                            <h3>IdeaPads<br><span></span></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgBox">
                            <img src="../images/słuchawki.jpg">
                        </div>
                        <div class="details">
                            <h3>Headphones<br><span></span></h3>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="imgBox">
                            <img src="../images/budynek.jpg">
                        </div>
                        <div class="details">
                            <h3>Company building<br><span></span></h3>
                        </div>
                    </div>                   
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <script src="swiper.min.js" type="text/javascript"></script>
            <!-- Initialize Swiper -->
            <script>
            var swiper = new Swiper('.swiper-container', {
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows : true,
              },
              pagination: {
                el: '.swiper-pagination',
              },
            });
          </script> 
          
          
            </div>
            <div class="box2">
            <button class="btnSale" onclick="window.location.href = 'orders.php';">Check</button>  
                <div class="form-style-6">
                    <div class="neon-wrapper">
                        <div class="neon-text">-50% <br> SALE</div>
                    </div>
                </div>                            
            </div>    
        </div> 


        


        <div class="container">
            <div class="card">
                <div class="imgBx">
                    <img src="../images/Konsole.jpg">
                </div>
                <div class="details">
                    <div class="content">
                        <h2>Consoles<br><span>
                            Check what we offer
                        </span></h2>
                        <ul>
                            <li><a href="#"><img src="../images/fb.png"></a></li>
                            <li><a href="#"><img src="../images/yt.png"></a></li>
                            <li><a href="#"><img src="../images/inst.png"></a></li>                           
                        </ul>
                        <a href="brands.php">All brands</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="imgBx">
                    <img src="../images/Podzespoly.jpg">
                </div>
                <div class="details">
                    <div class="content">
                        <h2>Components<br><span>
                            Check what we offer
                        </span></h2>
                        <ul>
                            <li><a href="#"><img src="../images/fb.png"></a></li>
                            <li><a href="#"><img src="../images/yt.png"></a></li>
                            <li><a href="#"><img src="../images/inst.png"></a></li>
                        </ul>
                        <a href="brands.php">All brands</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="imgBx">
                    <img src="../images/Pralki.jpg">
                </div>
                <div class="details">
                    <div class="content">
                        <h2>W. machine<br><span>
                            Check what we offer
                        </span></h2>
                        <ul>
                            <li><a href="#"><img src="../images/fb.png"></a></li>
                            <li><a href="#"><img src="../images/yt.png"></a></li>
                            <li><a href="#"><img src="../images/inst.png"></a></li>
                        </ul>
                        <a href="brands.php">All brands</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="imgBx">
                    <img src="../images/Telefony.jpg">
                </div>
                <div class="details">
                    <div class="content">
                        <h2>Smartphones<br><span>
                            Check what we offer
                        </span></h2>
                        <ul>
                            <li><a href="#"><img src="../images/fb.png"></a></li>
                            <li><a href="#"><img src="../images/yt.png"></a></li>
                            <li><a href="#"><img src="../images/inst.png"></a></li>
                        </ul>
                        <a href="brands.php">All brands</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="imgBx">
                    <img src="../images/laptopy.jpg">
                </div>
                <div class="details">
                    <div class="content">
                        <h2>IdeaPads<br><span>
                            Check what we offer
                        </span></h2>
                        <ul>
                            <li><a href="#"><img src="../images/fb.png"></a></li>
                            <li><a href="#"><img src="../images/yt.png"></a></li>
                            <li><a href="#"><img src="../images/inst.png"></a></li>
                        </ul>
                        <a href="brands.php">All brands</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="imgBx">
                    <img src="../images/słuchawki.jpg">
                </div>
                <div class="details">
                    <div class="content">
                        <h2>Headphones<br><span>
                            Check what we offer
                        </span></h2>
                        <ul>
                            <li><a href="#"><img src="../images/fb.png"></a></li>
                            <li><a href="#"><img src="../images/yt.png"></a></li>
                            <li><a href="#"><img src="../images/inst.png"></a></li>
                        </ul>
                        <a href="brands.php">All brands</a>
                    </div>
                </div>
            </div>

        </div> 

        <div class="container">
           
            <ul class="breadcrumb"><!-- breadcrumb Begin -->
                <li>
                Leave your opinion about the shop!
                </li>
            </ul><!-- breadcrumb Finish -->
            
        </div>

        <div class="border-one">

            <form class="formopin" method="post" action="send.php">
            <div class = "form-group">
                <label for = "name">User name</label>
                <input type = "text" id="opininput" class = "form-control" placeholder = "" name="emailf" value="<?php echo $_SESSION['fullName']; ?>" disabled>
            </div>
            <div class = "form-group">
                <label for = "name">Comment</label>
                <textarea class = "form-control" id="opinarea" rows = "3" placeholder = "" name="comf" required></textarea>
            </div>
            <div class = "form-group">
                <button type="submit" class="btn btn-success" id="opinbtn" name="submitf">Add</button>
            </div>
            </form>

            <?php
                $query = "SELECT * from messageop ORDER BY date DESC";
                $statement = $connect->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();            
            ?>

            <?php
                foreach($result as $row)
                {
            ?>

            <!-- Left-aligned -->
            <div class="media">
            <div class="media-left">
                <img src="../images/<?php echo $row['photo']; ?>" class="media-object" style="width:60px">
            </div>
            <div class="media-body">
            <h4 class="media-heading"><?php echo $row['email']; ?> <small><i><?php echo $row['date']; ?></i></small></h4>
                <p><?php echo $row['info']; ?></p>
            </div>
            </div>

            <?php
            }
            ?>
        </div>           


        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-nd-6 footer-info">
                            <h3><i class="fa fa-leaf"></i>ElectroWorld.pl</h3>
                            <p>Welcome to ElectroWorld.pl. You will find all articles hardware / electronic about the lowest prices on the market. The highest quality equipment straight from the manufacturer.
                            </p>
                        </div>
                        <div class="col-lg-3 col-nd-6 footer-links">
                            <h4><i class="fa fa-leaf"></i>Links</h4>
                            <ul>
                                <li><i class="ion-ios-arrow-right"></i><a href="orders.php">Orders</a></li>
                                <li><i class="ion-ios-arrow-right"></i><a href="brands.php">Brands</a></li>
                                <li><i class="ion-ios-arrow-right"></i><a href="aboutew.html">About</a></li>
                                <li><i class="ion-ios-arrow-right"></i><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-nd-6 footer-contact" id="cont">
                            <h4><i class="fa fa-leaf"></i>Follow</h4>
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <div class="col-lg-3 col-nd-6 footer-newsletter">
                            <h4><i class="fa fa-leaf"></i>Newsletter</h4>
                            <p>To keep up with the news, leave us your mail address. We will inform you about them and offers.
                            </p>
                            <form action="mail.php" method="post">
                                <input id="field" type="email" name="email" required><input type="submit" value="Send">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <p class="copyright text-muted">Copyright &copy;ElectroWorld 2019/2020<a href="../admin/login.php">Admin Panel</a></p>
        </footer>
        
        <script src="index.js"></script>  
    </body>
</html>