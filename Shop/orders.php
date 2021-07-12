<?php 

//index.php

session_start();

$connect = new PDO("mysql:host=localhost;dbname=adminpanel", "root", "");
$connect->query("SET NAMES utf8 COLLATE utf8_polish_ci");
$message = '';

if(isset($_POST["add_to_cart"]))
{
 if(isset($_COOKIE["shopping_cart"]))
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'item_id');

 if(in_array($_POST["hidden_id"], $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
   }
  }
 }
 else
 {
  $item_array = array(
   'item_id'   => $_POST["hidden_id"],
   'item_name'   => $_POST["hidden_name"],
   'item_price'  => $_POST["hidden_price"],
   'item_quantity'  => $_POST["quantity"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:orders.php?success=1");
}

if(isset($_POST['btninfo']))
{
  $id = $_POST['hidden_id'];
  echo '<h2>' . $id . '</h2>';
}

if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['item_id'] == $_GET["id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:orders.php?remove=1");
   }
  }
 }

 if($_GET["action"] == "clear")
 {
  setcookie("shopping_cart", "", time() - 3600);
  header("location:orders.php?clearall=1");
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Item Added into Cart
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Item removed from Cart
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Your Shopping Cart has been clear...
 </div>
 ';
}




?>
<!DOCTYPE html>
<html>
 <head>
  <title>Orders</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <style>
     body {
        background: wheat;
        width: 100%;
        height: 100%;
        margin:0;
        padding: 0;
        overflow-x:hidden;
     }

     table {
        background: white;
     }

     form {
        margin-bottom: 30px;
     }

     #titleme {
        display: block;
        background: white;
        font-weight: bold;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
     }
     #infotext {
        margin-bottom: 40px;
     }
     .closef {
    position: absolute;
    top: 0;
    right: 14px;
    font-size: 42px;
    transform: rotate(45deg);
    cursor: pointer;
  }
  .closef:hover {
      color: white;
  }
  #exampleModalLabel {
    font-size: 16px;
    font-weight: bold;
  }
  #imgset{
    margin-top: 10px;
  }
  .box1 {
    background: #222222;
    font-family: Arial, Helvetica, sans-serif;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
}
.box2 {
    background: #222222;
    font-family: Arial, Helvetica, sans-serif;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
}
.content {
    display: grid;
    width: 100%;
    height: 100vh;
    grid-template-columns: 2fr 3fr;
}
.box1 {
    grid-column: 2/2;
    grid-row: 1/2;

    margin: 50px 10px 50px 5px;
}
.box2 {
    grid-column: 1/1;
    grid-row: 1/1;

    margin: 50px 5px 50px 10px;
}
#orderdet{
  color: white;
}
.middle li{
  list-style: none;
}
.menu {
  overflow: hidden;
}
.item{
  border-top: 1px solid wheat;
  overflow: hidden;
}
.item a{
  text-decoration: none;
}
.btn1{
  display: block;
  padding: 16px 20px;
  background: purple;
  color: white;
  text-decoration: none;
  font-weight: bold;
  position: relative;
}
.btn1:before{
  content: "";
  position: absolute;
  width: 14px;
  height: 14px;
  background: purple;
  left: 20px;
  bottom: -7px;
  transform: rotate(45deg);
}
.btn1 i {
  margin-right: 10px;
}
.btn1:hover {
  color: white;
}
.smenu{
  background: white;
  color: #222;
  overflow: hidden;
  transition: max-height 0.3s;
}
.smenu a{
  display: block;
  padding: 16px 26px;
  color: #222;
  text-decoration: none;
  font-size: 14px;
  font-weight: bold;
  margin: 4px 0;
  position: relative;
}
.smenu a:before{
  content: "";
  position: absolute;
  width: 6px;
  height: 100%;
  background: purple;
  left: 0;
  top: 0;
  transition: 0.3s;
  opacity: 0;
}
.smenu a:hover:before {
  opacity: 1;
}
.search-txt{
  border-style: solid;
  border-color: purple;
  color: #222;
  height: 40px;
  width: 100%;
}
.slider-frame{
  overflow: hidden;
  height: 300px;
  width: 1100px;
  border-style: solid;
  border-color: white;
  margin: 0 auto;
  background-image: linear-gradient(to right, #818187, #86878f, #8b8d97, #9093a0, #9599a8);
  box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);
}

@-webkit-keyframes slide_animation{
  0% {
    left: 500px;
  }
  10% {
    left: 500px;
  }
  20% {
    left: 1600px;
  }
  30 % {
    left: 1600px;
  }
  40% {
    left: 500px;
  }
  50% {
    left: 500px;
  }
  60% {
    left: -600px;
  }
  70% {
    left: -600px;
  }
  80% {
    left: 1600px;
  }
  90% {
    left: 1600px;
  }
  100% {
    left: 500px;
  }
}
.slide-images{
  width: 3600px;
  height: 300px;
  margin: 0 0 0 -1600px;
  position: relative;
  -webkit-animation-name: slide_animation;
  -webkit-animation-duration: 18s;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-direction: alternate;
  -webkit-animation-play-state: running;
}
.img-container{
  height: 300px;
  width: 1100px;
  position: relative;
  float: left;
}
.hover {
  cursor: pointer;
}
.popover {
  width: 230px;
  height: 400px;
}
  </style>
 </head>
 <body>
  <br />
  <div class="content">
    <div class="box2" id="box2id">
        <div class="middle">
          <div class="menu">
          <input class="search-txt" id="Search" type="text" name="" placeholder="Search here...">
            <li class="item" id="productinfo">
              <a href="" class="btn1">Brands</a>
              <div class="smenu">
              <?php
                    $query = "SELECT DISTINCT brands from tbl_shop_product GROUP by brands ORDER BY brands";
                    $query1 = "SELECT DISTINCT type from tbl_shop_product GROUP by type ORDER BY type";
                    $statement = $connect->prepare($query);
                    $statement1 = $connect->prepare($query1);
                    $statement->execute();
                    $statement1->execute();
                    $result = $statement->fetchAll();   
                    $result1 = $statement1->fetchAll();              
                ?>

                    <?php
                        foreach($result as $row)
                        {
                    ?>
                <a>
                <input type="checkbox" class="radiobtn" id="radiobuttons" onClick="" name="brandsradio" value="<?php echo $row['brands']; ?>"> <?php echo $row['brands']; ?> 
                </a>
                <?php
                    }
                ?>
              </div>
            </li>
            <li class="item" id="delivery">
              <a href="#" class="btn1">Type</a>
              <div class="smenu">
                    <?php
                      foreach($result1 as $row)
                      {
                    ?>
                <a>
                <input type="checkbox" class="radiobtn" id="radiotype" onclick="myFilter()" name="typeradio" value="<?php echo $row['type']; ?>"> <?php echo $row['type']; ?> 
                </a>
                <?php
                    }
                ?>
              </div>
            </li>
            <li class="item" id="payment">
              <a href="#" class="btn1">Payment</a>
              <div class="smenu">
                <a href="">Paypal</a>
                <a href="">Master Card</a>
                <a href="">Paysavecard</a>
                <a href="">Visa</a>
              </div>
            </li>
            <li class="item" id="content">
              <a href="#" class="btn1">Contact</a>
              <div class="smenu">
                <a href="" class="contact-op" style="font-size: 13px;">+48 546 657 876</a>
                <a href="" class="contact-op" style="font-size: 13px;">+48 675 221 332</a>
                <a href="" class="contact-op" style="font-size: 13px;">Warszawa (ul. Morsa 5)</a>
              </div>
            </li>
          </div>
        </div>
    </div>
  <div class="box1">
  <div class="container">
    <div class="closef">+</div>    
   <h3 id="titleme" align="center">Welcome <?php echo $_SESSION['fullName']; ?></h3><br />
   
   <div class="slider-frame">
      <div class="slide-images">
        <div class="img-container">
           <img src="../images/grapthicsslider.jpg">         
        </div>   
        <div class="img-container">
           <img src="../images/musicslider.jpg">         
        </div> 
        <div class="img-container">
           <img src="../images/smartphoneslider.jpg">         
        </div>    
      </div>                  
   </div>                 

   <br /><br />
   <div id="result">
   <?php
   $query = "SELECT * FROM tbl_shop_product ORDER BY id ASC";
   $statement = $connect->prepare($query);
   $statement->execute();
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
   ?>
   <div class="col-md-3">
    <form method="post" class="collect">
     <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; box-shadow: 0 2px 5px 0 rgba(0,0,0,0.5), 0 2px 10px 0 rgba(0,0,0,0.5);" align="center">
      <img src="../images/<?php echo $row["image"]; ?>" class="img-responsive"/><br />

      <h4 class="text-info"><a class="hover" id="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></a></h4>

      <h4 class="area-info" id="target"><?php echo $row["info"]; ?></h4>

      <h6 class="text-danger">Quantity: <?php echo (($row["quan"] < 1 )?'lack of goods':''.$row["quan"].''); ?></h6>

      <h4 class="text-danger" id="target">$ <?php echo $row["price"]; ?></h4>

      <input type="number" min="1" max="<?php echo $row["quan"]; ?>" name="quantity" id="quantity <?php $row["id"]; ?>" value="" class="form-control" />
      <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
      <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
      <input type="hidden" name="hidden_id" value="<?php echo $row["id"]; ?>" />
      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" <?php if ($row["quan"] == '0'){ ?> disabled <?php   } ?> /> 
    </div>
    </form>
   </div>
  
   <?php
   }
   ?>
   </div>
   


<!-- Modal Report generator -->
<div class="modal fade" id="docgener" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Generate a report</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h3 id="infotext">The report includes only ordered products that are waiting to be paid.</h3>
      <form action="docgener.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group" id="foldertext">
                  
              </div>
              </div>
            </div>
          </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" name="btngenerpdf" class="btn btn-primary">Generate</button>
        </div>
        </form>
        </div>
        </div>     
    </div>
    </div>

    


   
   <div style="clear:both"></div>
   <br />
   <h3 id="orderdet">Order Details: <?php echo $_SESSION['fullName']; ?></h3>

   <div class="table-responsive">
   <?php echo $message; ?>
   <div align="right">
    <a href="orders.php?action=clear"><b>Clear Cart</b></a>
   </div>
   <table class="table table-bordered">
    <tr>
     <th width="40%">Item Name</th>
     <th width="10%">Quantity</th>
     <th width="20%">Price</th>
     <th width="15%">Total</th>
     <th width="5%">Action</th>
    </tr>
   <?php
   if(isset($_COOKIE["shopping_cart"]))
   {
    $total = 0;
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    foreach($cart_data as $keys => $values)
    {
   ?>
    <form action="" method="post">
    <tr>
     <td><?php echo $values["item_name"]; ?></td>
     <td><?php echo $values["item_quantity"]; ?></td>
     <td>$ <?php echo $values["item_price"]; ?></td>
     <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
     <td><a href="orders.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
    </tr>
   <?php 
     $total = $total + ($values["item_quantity"] * $values["item_price"]);

     if (isset($_POST['btnorder']))
     {
      $today = getdate();
      $dt = $today['year']."-".$today['mon']."-".$today['mday']." ".$today['hours'].":".$today['minutes'].":".$today['seconds'];
      $id_item = $values["item_id"];
      $iden = $_SESSION['fullName'];
      $name = $values['item_name'];
      $quantity = $values['item_quantity'];
      $price = $values['item_price'];
      $totalpricef = $values["item_quantity"] * $values["item_price"];
      $connection = mysqli_connect("localhost", "root", "", "adminpanel");
      $query = "INSERT into tbl_products (email, name, quantity, price, totalprice, date) values ('$iden', '$name', '$quantity', '$price', '$totalpricef', '$dt')";
      $query_run = mysqli_query($connection, $query); 
      
      $sql = "UPDATE tbl_shop_product SET quan = (quan - '$quantity') WHERE id = '$id_item'";
      mysqli_query($connection, $sql); 
     }    
    }
   ?>
    <tr>
     <td colspan="3" align="right">Total</td>
     <td align="right">$ <?php echo number_format($total, 2); ?></td>
     <td><a href="orders.php?action=order&id=<?php echo $values["item_id"]; ?>"><button class="text-success" name="btnorder">Order</button></a></td>
    </tr>
    </form>
   <?php
   }
   else
   {
    echo '
    <tr>
     <td colspan="5" align="center">No Item in Cart</td>
    </tr>
    ';
   }
   ?>
   </table>
   </div>
  </div>
  
  <br />

<h3 id="titleme" align="center">Your orders:</h3><br />

<!--Menu buttons-->
<style>
  #b1 {
    margin-left: 20px;
    margin-bottom: 5px;
  }
  #b2 {
    margin-left: 5px;
    margin-bottom: 5px;
  }
  #fieldtotal {
    width: 200px;
    height: 30px;
    border-color: #222;
    border-radius: 8px;
    margin-left: 5px;
    margin-bottom: 5px;
    color: #222;
  }
</style>
<button type="button" name="btngenerpdf" id="b1" class="btn btn-primary" data-toggle="modal" data-target="#docgener">
  Generate a report
</button>
<button type="button" name="btnpayment" id="b2" class="btn btn-success" data-toggle="modal" onclick="window.location.href='payment.php'">
  Pay
</button>

<?php
$name = $_SESSION['fullName'];
$connection= mysqli_connect('localhost', 'root', '', 'adminpanel');
$query = "SELECT SUM(totalprice) from tbl_products where email='$name'";
$query_run = mysqli_query($connection, $query);

while ($data = mysqli_fetch_array($query_run, MYSQLI_NUM)){
?>

<input type="text" class="totaltext" name="totalp" id="fieldtotal" value="Total: <?php printf($data[0]); ?>" readonly>

<?php
}
?>

<div id="content-wrapper">

<div class="container-fluid">

      <div class="table-responsive">

          <?php
              $connection= mysqli_connect('localhost', 'root', '', 'adminpanel');
              $connection->query("SET NAMES utf8 COLLATE utf8_polish_ci");
              $name = $_SESSION['fullName'];
              $query = "SELECT * from tbl_products where email='$name'";
              $query_run = mysqli_query($connection, $query);
          ?>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Product id</th>
              <th>Your guid</th>
              <th>Product name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total price</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
              <?php
                  if (mysqli_num_rows($query_run) > 0)
                  {
                      while($row = mysqli_fetch_assoc($query_run))
                      {
               ?>                
            <tr>
              <td><?php echo $row['idproduct']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td><?php echo $row['totalprice']; ?></td> 
              <td><?php echo $row['date']; ?></td> 
            </tr>         
            <?php
                      }
                  }
                  else{
                      echo "No record found";
                  }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
   </div>  
  <script src="signx.js"></script>
  <script src="searchme.js"></script>
 </body>
</html>

<script>
      $(document).ready(function(){
          $('.hover').popover({
              title:fetchData,
              html:true,
              placement:'left'
          });

          function fetchData(){
            var fetch_data = '';
            var element = $(this);
            var id = element.attr("id");
            $.ajax({
              url:"fetch.php",
              method:"POST",
              async:false,
              data:{id:id},
              success:function(data){
                fetch_data = data;
              }
            });
            return fetch_data;
          }
      });

      $(document).on('keyup', 'input[name=quantity]', function () {
          var _this = $(this);
          var min = parseInt(_this.attr('min'));
          var max = parseInt(_this.attr('max'));
          var val = parseInt(_this.val()) || (min - 1);
          if(val < min)
              _this.val( min );
          if(val > max)
              _this.val( max );
      });
   </script>