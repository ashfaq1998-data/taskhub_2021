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

<link href="<?php echo fullURLfront; ?> /assets/cs/contractor/contractor_paymentform.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
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
    <div class="logoarea"><img src="<?php echo fullURLfront ; ?>/assets/images/taskhubpaypal.png"></div>
    <div id="formarea">
        <form action="<?php echo fullURLfront; ?>/Contractor/contractor_paymentgateway" method="post" >
            <div id="cardnumberdiv" class="inform">
                <label for="cardnumberl">Card Number</label>  
                <input type="text" id="cardnumberid" name="cardnumber" required>
            </div>

            <div id="expirymonthdiv" class="inform">
                <label for="expirymonthl">Expiry month</label>  
                <input type="text" id="expirymonthid" name="expirymonth" required>
            </div>

            <div id="expiryyeardiv" class="inform">
                <label for="expiryyearl">Expiry year</label>  
                <input type="text" id="expiryyearid" name="expiryyear" required>
            </div>

            <div id="holdernamediv" class="inform">
                <label for="holdernamel">Cardholder name</label>  
                <input type="text" id="holdernameid" name="holdername" required>
            </div>

            <div id="cvvdiv" class="inform">
                <label for="cvvl">Cvv</label>  
                <input type="text" id="cvvid" name="cvv" required>
            </div>
            <br><br>
            <div id="pricestiker"><img src="<?php echo fullURLfront ; ?>/assets/images/priceofad.jpg"></div>

            <div id="buttons">
                <button class="buttons" id="confirm" type="submit">Pay now</button>
                <button class="buttons" id ="cancel" type="reset">Cancel</button>
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
