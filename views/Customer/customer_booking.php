<?php
session_start();
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
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_booking.css" rel="stylesheet" type="text/css"/>
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
            <div class="subrow">
                <div class="subcolumn1">
                    <img src="<?php echo fullURLfront; ?>/assets/images/booking.JPG" alt="image">
                </div>
                <div class="subcolumn">
                    <!-- <a href="<?php echo fullURLfront; ?>/Employee/employee_help"><i class="fa fa-info-circle"></i> x</a> -->
                    <form action = "<?php echo fullURLfront; ?>/Customer/customer_serviceList" method="POST">     <!-- go to the help page when clicks close button -->
                        <button class="button close">x</button>
                    </form>
                    <form action="<?php echo fullURLfront; ?>/Customer/customer_booking" method="POST">      <!-- go to the emp_booking page when clicks submit button -->
                        <h1>Booking Form</h1>
                        <div class="elem-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" pattern="[A-Za-z]{1,32}[ ]{1,1}[A-Za-z]{1,32}" title="Name should contains only alphabets (eg: John Player)" placeholder="Jensen Ackles" required>
                        </div>
                        <div class="elem-group">
                            <label for="name">Permenant Address</label>
                            <input type="text" id="address" name="address" maxlength="75" placeholder="No 36, Reid Avenue, Colombo 10" required>
                        </div>
                        <div class="elem-group">
                            <label for="email">Your E-mail</label>
                            <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg: john98@gmail.com" value="<?php echo $_SESSION['loggedin']['email']; ?>"  placeholder="john.doe@email.com" required>
                        </div>
                        <div class="elem-group">
                            <label for="phone">Your Contact Number</label>
                            <input type="tel" id="phone" name="phone" pattern="(^[0-9]{10})" title="eg: 0710001111" placeholder="0710001111" pattern=(\d{3})-?\s?(\d{3})-?\s?(\d{4}) required>
                        </div>
                        <hr>
                        <div class="elem-group">
                            <label for="message">Anything Else?</label>
                            <textarea id="message" name="message" placeholder="Tell us anything else that might be important."></textarea>
                        </div>
                    <button id="submit" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>        
    </div>
    <?php include_once('footer.php'); ?>
</div>    
</body>
</html>