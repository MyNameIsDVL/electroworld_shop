<?php
session_start();

$connection= mysqli_connect('localhost', 'root', '', 'adminpanel');

$today = getdate();
$date = $today['year']."-".$today['mon']."-".$today['mday'];
$time = $today['hours'].":".$today['minutes'].":".$today['seconds'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Payment</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="payment.css"/>
        <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    </head>
    <body>
        <div class="closef">+</div> 
        <div class="contener">
            <div class="content">
            <?php
                $name = $_SESSION['fullName'];
                $query = "SELECT SUM(totalprice) from tbl_products where email='$name'";
                $query_run = mysqli_query($connection, $query);

                while ($data = mysqli_fetch_array($query_run, MYSQLI_NUM)){
            ?>

                <h1 id="titlepayment">Welcome to payment system:</h1>
                <p>Your guid: <?php echo $name; ?></p>
                <p>Date: <?php echo $date; ?></p>
                <p>Time: <?php echo $time; ?></p>
                <p>Total price: <?php printf($data[0]); ?></p>
                
            

                <div id="paypal-button-container"></div>
                <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                    // Set up the transaction
                    return actions.order.create({
                        purchase_units: [{
                        amount: {
                            value: '<?php printf($data[0]); ?>',
                            currency: 'USD'
                        }
                        }]
                    });
                    },
                    env: 'sandbox',
                    client: {
                        sandbox: 'AcUFPxzxeFMHsqW6gppXTU7lsLj0VCMt10mRywnhRe2kpjkGMB--JkpPMpzex7XSyPPB7_uljIsdLEZl'
                    },
                    style: {
                        color: 'black'
                    },
                    onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Success. Thank you!' + details.payer.name.given_name);
                        window.location.href = "invoiceclient.php";
                        // Call your server to save the transaction
                        return fetch('/paypal-transaction-complete', {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID
                        })
                        });
                    });
                    }
                }).render('#paypal-button-container');
                </script>

            <?php
                }
            ?>
            </div>
        </div>
    </body>
    <script src="signx.js"></script>
 </body>
</html>