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
<link href="<?php echo fullURLfront; ?>/assets/cs/common/rate.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/ratestyle.css" rel="stylesheet" type="text/css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500;700&family=Lobster&family=Mochiy+Pop+P+One&family=Poppins:wght@200&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="page-wrapper">
<?php include_once('header.php'); ?>

<div class="row">
    <div class="column1">
        <img src="<?php echo fullURLfront; ?>/assets/images/col3imagerate.JPG" alt="image" width="100%" height="100%">
 
    </div>
    <div class="column2">
        
        <div class="rating">
            <form action="<?php echo fullURLfront; ?>/Rate/rate_submit" method="POST"> 
                <h2>Rate For <?php echo $data['ratingFormDetails']['rateFor']; ?></h2>
                <input type="hidden" name="type" value="<?php echo $data['ratingFormDetails']['type']; ?>">
                <input type="hidden" name="actorUserId" value="<?php echo $data['ratingFormDetails']['actorUserId']; ?>">
                <input type="hidden" name="bookingId" value="<?php echo $data['ratingFormDetails']['bookingId']; ?>">

                <input type="radio" name="rating" value="1" aria-label="1 star">
                <input type="radio" name="rating" value="2" aria-label="2 star">
                <input type="radio" name="rating" value="3" aria-label="3 star">
                <input type="radio" name="rating" value="4" aria-label="4 star">
                <input type="radio" name="rating" value="5" aria-label="5 star">
                <br><br>
                <button type="submit" name="confirm_rating" value="submitted" class="submitButton">Submit</button>
            </form>
        </div>

        <div class="bottomimage" style="margin-top: 40px;">
            <img src="<?php echo fullURLfront; ?>/assets/images/footerrate.JPG" alt="image" width="100%" height="30%" >
        </div>


    </div>

    
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
