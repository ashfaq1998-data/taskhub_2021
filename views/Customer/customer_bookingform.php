<?php
// session_start();
?>

<!DOCTYPE html>
<html>
<head>

    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_bookingform.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Customer/customer_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class="subrow">
                <div class="subcolumn1">
                    <img src="<?php echo fullURLfront; ?>/assets/images/booking.jpg" alt="image">
                </div>
                <div class="subcolumn">
                    <form action="https://sandbox.payhere.lk/pay/checkout" method="POST" id="bookingForm"> 
                        <h1>Booking Form</h1>
                        <input type="hidden" name="merchant_id" value="1219502">    <!-- Replace your Merchant ID -->
                        <input type="hidden" name="return_url" value="https://<?php echo $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]);?>/Booking/booking_success">
                        <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
                        <input type="hidden" name="notify_url" value="https://<?php echo $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]);?>/Booking/booking_handle">
                        <input type="hidden" name="currency" value="LKR">
                        <input type="hidden" name="country" value="Sri Lanka">
                        <input type="hidden" name="order_id" value="<?php echo base64_encode($data['bookingFormDetails']['customerUserId']); ?>"> 
                        <input type="hidden" name="items" value="Customer Booking">
                        <input type="hidden" name="person" value="Nimal">
                        <input type="hidden" name="custom_1" value="<?php echo $data['bookingFormDetails']['type']; ?>"> 
                        <input type="hidden" name="custom_2" value="<?php echo $data['bookingFormDetails']['actorId']; ?>">
                        <div class="elem-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="Jensen" required>
                        </div>
                        <div class="elem-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Ackles" required>
                        </div>
                        <div class="elem-group">
                            <label for="address">Permenant Address</label>
                            <input type="text" id="address" name="address" placeholder="No 36, Reid Avenue, Colombo 10" required>
                        </div>
                        <div class="elem-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Colombo" required>
                        </div>
                        <div class="elem-group">
                            <label for="email">Your E-mail</label>
                            <input type="email" id="email" name="email" placeholder="john.doe@email.com" required>
                        </div>
                        <div class="elem-group">
                            <label for="phone">Your Contact Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="0713483872" required>
                        </div>
                        <div class="elem-group">
                            <label for="amount">Amount</label>
                            <input type="number" id="amount" name="amount" placeholder="500" required>
                        </div>
                        <hr>
                        <button type="submit" id="submitButton">Submit</button>
                    </form>
                </div>
            </div>
        </div>        
    </div>
    <?php include_once('footer.php'); ?>
</div>    
</body>
</html>