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
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_service.css" rel="stylesheet" type="text/css"/>
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
            <div class="search-container">
                <form action="<?php echo fullURLfront; ?>/Customer/customer_serviceList" method="GET">
                    <input type="search" placeholder="Search for services, workers, contractors or manpower agencies" name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        
            <center><div class="sortinglist">
                <form action="<?php echo fullURLfront; ?>/Customer/customer_serviceList" method="POST">
                    <select name="service_type" id="service_type">
                        <option value="none" value disabled selected>Select the service type</option>
                        <option value="plumb">Plumbing</option>
                        <option value="carpen">Carpentry</option>
                        <option value="elec">Electrical help</option>
                        <option value="mason">Mason</option>
                        <option value="paint">Painting</option>
                        <option value="gard">Gardening</option>
                    </select><br><br>

                    <select name="employee_type" id="employee_type">
                        <option value="none" value disabled selected>Select the employee type</option>
                        <option value="manpower">Manpower Agency</option>
                        <option value="customer">Employee</option>
                        <option value="contractor">Contractor</option>
                    </select><br><br><br><br>

                    <select name="location" id="location">
                        <option value="none" value disabled selected>Location</option>
                        <option value="manpower">Matara</option>
                        <option value="customer">Colombo</option>
                        <option value="contractor">Galle</option>
                        <option value="contractor">Kandy</option>
                    </select><br><br><br><br>

                <!-- <button type="submit" class="proceed">Proceed</button> -->
                <button type="submit" class="proceed"> <a style="color: black;" href="<?php echo fullURLfront; ?>/Customer/customer_serviceList">Proceed</a></button>
                <!-- <button class="btn"><a id="close" href="<?php echo fullURLfront; ?>/Customer/customer_serviceLocation"> -->

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
