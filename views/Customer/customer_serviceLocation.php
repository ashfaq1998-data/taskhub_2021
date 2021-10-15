<?php
// session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_serviceLocation.css" rel="stylesheet" type="text/css"/>
<!-- <link href="<?php echo fullURLfront; ?>/assets/cs/employee/additional_viewad.css" rel="stylesheet" type="text/css"/> -->
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
            <center><div class="sortinglist">
                <form action="<?php echo fullURLfront; ?>/Customer/customer_serviceLocation" method="POST">
                    <label for="service_type">Electrical help</label><br><br><br>
                    <label for="employee_type">Employer</label><br><br><br>
                    <select name="location" id="location">
                        <option value="none" selected>Location</option>
                        <option value="colombo">Colombo</option>
                        <option value="matara">Matara</option>
                        <option value="galle">Galle</option>
                        <option value="kandy">Kandy</option>
                    </select><br><br><br><br><br>
                <button type="submit" class="search"> <a href="<?php echo fullURLfront; ?>/Customer/customer_serviceList">Search</a> </button>
                <div class="image">
                    <center><img src="<?php echo fullURLfront; ?>/assets/images/service_cus.png" alt="image"></center>
                </div>
                </form>

            </div></center>
    </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
