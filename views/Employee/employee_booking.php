<?php
session_start();

$JsonData = json_encode($data['bookingEvents']);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_booking.css" rel="stylesheet" type="text/css"/>
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
            <?php include_once('views/Employee/employee_sidebar.php'); ?>
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
                        <label for="lname">Address:</label><br>
                        <input type="text" id="address" name="address" value="" readonly>
                        <label for="lname">Description:</label><br>
                        <input type="text" id="description" name="description" value="" readonly>
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
<script src="<?php echo fullURLfront; ?>/assets/js/employee/employee_booking.js" type="text/javascript"></script>
</html>