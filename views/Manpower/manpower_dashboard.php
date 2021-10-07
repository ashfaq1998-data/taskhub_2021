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
    <?php include_once('views/Employee/employee_sidebar.php'); ?>
  </div>
  <div class="column2">
    <h2>Column 2</h2>
    <p>Some text..</p>
  </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
