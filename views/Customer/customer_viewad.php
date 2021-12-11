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
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_viewad.css" rel="stylesheet" type="text/css"/>
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
            <form action="/action_page.php">
                <input type="search" placeholder="Search advertisement by title" name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
       
        <div class="sortinglist">

            <div class="view" style="float: left; padding: 14px;">
                <button style="position: relative; float: left;" type="submit" class="proceed"> <a style="color: black;"
                href="<?php echo fullURLfront; ?>/Customer/customer_viewmyad">My Ads</a></button>
            </div>

            <form action="/action_page.php" style="float: right;">
                <label for="area">Living area:</label>
                <select name="area" id="area">
                    <option value="none" selected>Select area</option>
                    <option value="colombo">Colombo</option>
                    <option value="gampaha">Matara</option>
                    <option value="kaluthara">Kaluthara</option>
                    <option value="galle">Galle</option>
                </select>

                <label for="type">Service type:</label>
                <select name="type" id="type">
                    <option value="none" selected>Select type</option>
                    <option value="plumb">Plumbing</option>
                    <option value="carpen">Carpentry</option>
                    <option value="elec">Electrical help</option>
                    <option value="mason">Mason</option>
                    <option value="paint">Painting</option>
                    <option value="gard">Gardening</option>
                </select>

                <label for="type">Employee type:</label>
                <select name="type" id="type">
                    <option value="none" selected>Select type</option>
                    <option value="manpower">Manpower Agency</option>
                    <option value="customer">Employee</option>
                    <option value="contractor">Contractor</option>
                </select>
            </form>

        </div>
        <br><br>
        
        <div class="subrow" >
            <div class="subcolumn1">
                <div class ="adimage">
                    <img src="<?php echo fullURLfront; ?>/assets/images/pipe.jpg" alt="image1" width="180px" height="180px">
                </div> 
            </div>
            <div class="subcolumn2">
                <div class="postedby">
                    <p style="font-family: Poppins; font-style: normal; font-weight: 500; font-size: 18px; line-height: 27px; color:#108882;">Posted By:</p>
                    <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Name : James</p>
                    <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Email : abc@gmail.com</p>
                    <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Start from : LKR 5000</p>
                    <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Location : 36, Reid avenue, Colombo 3</p>
                </div>
            </div>
            <div class="subcolumn3">
                <div class="details">
                    <p style="font-family: Poppins; font-style: normal; font-weight: 500; font-size: 18px; line-height: 27px; color:#108882;">Task Description</p>
                    <p style="color:#61687F; font-family: Roboto; font-style: normal; font-size: 18px; line-height: 21px; ">
                    I have experience in plumbing for nearly 10 years.
                    Replacing washing machine and dryer machine Hoses, and pipe lines minimum charge 2 hours
                    Willing to give the best service. Best regards!!</p>
                </div>
            </div>
            <div class="view">
                <button style="float: right;" type="submit" class="proceed"> <a style="color: black;"
                href="<?php echo fullURLfront; ?>/Customer/customer_viewad">Request</a></button>
            </div>
        </div>
   </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
