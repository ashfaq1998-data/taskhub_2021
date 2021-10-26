<?php
session_start();

$JsonData = json_encode($data['bookingEvents']);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

<link href="<?php echo fullURLfront; ?> /assets/cs/contractor/contractor_paymentgateway.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_booking.css" rel="stylesheet" type="text/css"/>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js' type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>


</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
        </div>
        <div class="column2">
        
            <div id='calendar' class="calender-section"></div>
            <div class="booking-details-section">
                <h3><i class="fa fa-book" aria-hidden="true"></i> Booking Details</h3>
                <div class="booking-details-section-content">
                    <form>
                        <label for="fname">Customer:</label><br>
                        <input type="text" id="customerName" name="customerName" value="" readonly><br>
                        <label for="lname">Time:</label><br>
                        <input type="text" id="time" name="time" value="" readonly><br>
                        <label for="lname">Payment:</label><br>
                        <input type="text" id="payment" name="payment" value="" readonly>
                        <label for="lname">Address:</label><br>
                        <input type="text" id="address" name="address" value="" readonly>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
<script>
    var data = <?php echo $JsonData; ?>;
</script>
<script src="<?php echo fullURLfront; ?>/assets/js/contractor/contractor_bookings.js" type="text/javascript"></script>
</html>