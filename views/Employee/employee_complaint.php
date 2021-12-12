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
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/customer_complaint.css" rel="stylesheet" type="text/css"/>
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
            <div class="subrow">
                <div class="subcolumn1">
                    <img src="<?php echo fullURLfront; ?>/assets/images/complaintimage.JPG" alt="image">
                </div>
                <div class="subcolumn2">
                    <form action="<?php echo fullURLfront; ?>/Employee/employee_complaint">
                        <fieldset>
                            <legend>Rate level of complains</legend>
                            <div class="rating">
                                <input type="radio" name="rating" value="1" aria-label="1 star" required>
                                <input type="radio" name="rating" value="2" aria-label="2 star">
                                <input type="radio" name="rating" value="3" aria-label="3 star">
                                <input type="radio" name="rating" value="4" aria-label="4 star">
                                <input type="radio" name="rating" value="5" aria-label="5 star">
                            </div>
                        </fieldset> 
                        <br>
                        <p style="font-family: Raleway; font-style: normal; font-weight: bold; font-size: 16px;">Provide the complain (if necessary)</p>
                        
                        <input type="text" id="subject" name="subject" placeholder="Subject" size="80%">
                        <textarea id="complaintmessage" name="complaintmessage" placeholder="Write your complaint message here.." style="height:200px" rows="4" cols="82"></textarea>
                        
                        <p><b>Note: </b> Unworthy complaints may reduce your personal rating so <b> think before you send</b></p>
                        
                        <div class ="ratebutton">
                            <button type="reset"><i class="fa fa-ban"></i> Cancel</button>
                            <button type="submit"><i class="fa fa-frown-o"></i> Complain</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>