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
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_confirmpayment.css" rel="stylesheet" type="text/css"/>  
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<title>Document</title>

</head>
<body>
<div class="page-wrapper">
<?php include_once('header.php'); ?>

<div class="row">
  <div class="column1">
    <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
  </div>
  <div class="column2">
    <p id = "topic">We are almost finished Transaction</p>
    <div id ="chatbox">
        <form action="<?php echo fullURLfront; ?>/Contractor/contractor_paymentdone">
            <div id ="subdiv1">confirm payment?</div>
            <div id ="subdiv2"><button class="confirmbutton" type="submit">Yes</button>
                <button class="confirmbutton">No</button>
            </div>
        </form>
            
    </div>
  </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
