<?php
session_start();
$totalcount = $data['totalcount'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/admin/admin_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/admin/admin_stat.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="page-wrapper">
<?php include_once('header.php'); ?>

<div class="row">
  <div class="column1">
    <?php include_once('views/Admin/admin_sidebar.php'); ?>
  </div>
  <div class="column2">
    
    <div class="main-part">
      <div class="cpanel">
        <div class="icon-part">
          <i class="fa fa-users" aria-hidden="true"></i><br>
          <small>Users</small>
          <p><?php echo $totalcount['totalusers']; ?></p>
        </div>
      </div><br>

      <div class="cpanel">
        <div class="icon-part">
          <i class="fa fa-users" aria-hidden="true"></i><br>
          <small>Customers</small>
          <p><?php echo $totalcount['totalcustomers']; ?></p>
        </div>
      </div>

      <div class="cpanel">
        <div class="icon-part">
          <i class="fa fa-users" aria-hidden="true"></i><br>
          <small>Employees</small>
          <p><?php echo $totalcount['totalemployees']; ?></p>
        </div>
      </div>

      <div class="cpanel">
        <div class="icon-part">
          <i class="fa fa-users" aria-hidden="true"></i><br>
          <small>Contractors</small>
          <p><?php echo $totalcount['totalcontractors']; ?></p>
        </div>
      </div>

      <div class="cpanel">
        <div class="icon-part">
          <i class="fa fa-users" aria-hidden="true"></i><br>
          <small>Manpower Agencies</small>
          <p><?php echo $totalcount['totalmanpowers']; ?></p>
        </div>
      </div><br>

      <div class="cpanel cpanel-green">
        <div class="icon-part">
          <i class="fa fa-money" aria-hidden="true"></i><br>
          <small>Total Income</small>
          <p><?php echo 'LKR '. $totalcount['totalprofit']; ?></p>
        </div>
      </div><br>


      <div class="cpanel cpanel-orange">
        <div class="icon-part">
          <i class="fa fa-frown-o" aria-hidden="true"></i><br>
          <small>Total Number of Complaints</small>
          <p><?php echo $totalcount['totalcomplaints']; ?></p>
        </div>
      </div>

      <div class="cpanel cpanel-orange">
        <div class="icon-part">
          <i class="fa fa-info" aria-hidden="true"></i><br>
          <small>Total Number of Help Requests</small>
          <p><?php echo $totalcount['totalhelprequest']; ?></p>
        </div>
      </div><br>

      <div class="cpanel cpanel-blue">
        <div class="icon-part">
          <i class="fa fa-book" aria-hidden="true"></i><br>
          <small>Total Number of Bookings</small>
          <p><?php echo $totalcount['totalbooking']; ?></p>
        </div>
      </div>
      <div class="cpanel cpanel-red">
        <div class="icon-part">
          <i class="fa fa-envelope-o" aria-hidden="true"></i><br>
          <small>Total Advertisement Posted</small>
          <p><?php echo $totalcount['totaladvertisement']; ?></p>
        </div>
      </div>
      
    </div>


    
  </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
