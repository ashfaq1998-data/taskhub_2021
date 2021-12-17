<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_payment.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="page-wrapper">
        <?php include_once('header.php'); ?>
        
        <div class="row">
            <div class="column1">
                <?php include_once('views/Customer/customer_sidebar.php'); ?>
            </div>
            <div class="column2">
                <form action="<?php echo fullURLfront; ?>/Customer/customer_payment" method="post">
                    <a class="close" href="<?php echo fullURLfront; ?>/Customer/customer_booking">x</a>
                    <center><h1>Payment details</h1></center>
                    <center><div class="details">
                        <input type="text" name="name" id="name" placeholder="Name on the card" class="name" required><br>
                        <input type="text" name="cardno" id="cardno" placeholder="Card Number" class="cardno" required><br>
                        <input type="text" name="cvv" id="cvv" placeholder="CVV" class="cvv" required><br>
                        <input type="text" name="expire" id="expire" placeholder="Exipry date" class="expire" required><br>
                        <br>
                        <button type="reset" class="cancel">Cancel</button>
                        <button type="submit" class="proceed">Proceed</button>
                    </div></center><br>
                </form>
            </div>
        </div>
        <br><?php include_once('footer.php'); ?>
    </div>    
</body>
</html>