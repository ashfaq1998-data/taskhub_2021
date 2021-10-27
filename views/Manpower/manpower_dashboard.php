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
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_dashboard.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="page-wrapper">
<?php include_once('header.php'); ?>

<div class="row">
  <div class="column1">
    <?php include_once('views/Manpower/manpower_sidebar.php'); ?>
  </div>
  <div class="column2">
    <h2>Manpower Agency Dashboard</h2>
    
  </div>

  <div class="subrow">
            <div class="subcolumn1" style="background-color: #B4E1E7;">
                <div class ="adimage">
                    <img src="<?php echo fullURLfront; ?>/assets/images/pipe.jpg" alt="image1" width="180px" height="180px">
                </div> 
            </div>
            <div class="subcolumn2" style="background-color: #B4E1E7;">
                <div class="postedby">
                    <p class="special-field"></p>
                    <p class="field"> </p>
                    <p class="field"> </p>
                    <p class="field"> </p>
                    <p class="field"> </p>
                </div>
            </div>
            <div class="subcolumn3" style="background-color: #B4E1E7;">
                <div class="details">
                    <p class="special-field">Task Description</p>
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla bibendum justo condimentum, ullamcorper sapien sed, condimentum augue. Nullam non turpis vitae urna vestibulum dapibus. Duis scelerisque quis purus nec cursus.</p>
                </div>
            </div>
        </div>

</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>