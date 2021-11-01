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
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_complaint.css" rel="stylesheet" type="text/css"/>
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
            <div class="subrow">
                <div class="subcolumn1">
                    <img src="<?php echo fullURLfront; ?>/assets/images/complaintimage.JPG" alt="image">
                </div>
                <div class="subcolumn2"></div>
                <div class="subcolumn3">
                    <form action="<?php echo fullURLfront; ?>/Customer/customer_complaint" method="POST">
                        <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-style: normal; font-weight: bold; font-size: 17px;">Rate level of complains (Higher the stars, worse the case)</p>
                        <!-- <fieldset> -->
                            <!-- <legend>Rate level of complains (Higher the stars, worse the case)</legend> -->
                            <div class="rating">
                                <input type="radio" name="rating" value="1" aria-label="1 star" required>
                                <input type="radio" name="rating" value="2" aria-label="2 star">
                                <input type="radio" name="rating" value="3" aria-label="3 star">
                                <input type="radio" name="rating" value="4" aria-label="4 star">
                                <input type="radio" name="rating" value="5" aria-label="5 star">
                            </div>
                        <!-- </fieldset>  -->
                        <br>
                        <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-style: normal; font-weight: bold; font-size: 17px;">Do you have any complaint?</p>
                        
                        <input type="text" id="subject" name="subject" placeholder="Subject" size="80%">
                        <textarea id="complaintmessage" name="complaintmessage" placeholder="Complaint" style="height:200px" rows="4" cols="82"></textarea>
                        
                        <p><b>Note: </b> Unworthy complaints may reduce your personal rating so think before you send...</p>
                        
                        <div class ="ratebutton">
                            <button type="reset" class="button cancel"> Cancel</button>
                            &nbsp &nbsp
                            <button type="submit" name="customer_complaint" value="submitted" class="button submit"> Complain</button>
                            <br>
                            <?php if(!empty($data['ComplaintError']) && $data['ComplaintError'] != "none") {?>
                                <p class="error"><?php echo $data['ComplaintError']; ?></p>
                            <?php }else if($data['ComplaintError'] == "none"){?>
                                <p class="success">Your Complaint Submitted Successfully <i style="color: green;" style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;"
                                style="font-weight: bold;" class="fa fa-check" aria-hidden="true"></i></p>
                            <?php }?>
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