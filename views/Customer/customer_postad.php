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
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_postad.css" rel="stylesheet" type="text/css"/>
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
                    <img src="<?php echo fullURLfront; ?>/assets/images/postad.jpg" alt="image">
                </div>
                <div class="subcolumn2"></div>
                <div class="subcolumn3">
                    <form action="<?php echo fullURLfront; ?>/Customer/customer_postad" method="POST">
                        <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-style: normal; font-weight: bold; font-size: 20px;">
                        Post advertisement details</p>
                        <input type="text" id="title" name="title" placeholder="Title of the advertisement" style="font-size: 15px;" required>
                        <input type="text" id="email" name="email" placeholder="Email" style="font-size: 15px;" required>
                        <input type="text" id="address" name="address" placeholder="Address" style="font-size: 15px;" required>
                        <div>
                            <input type="file" accept="image/*" class="custom-file-input" name="upload" placeholder="Upload photos" style="
                            width: 40%; padding: 8px; height: 41px; float: left;">
                            <select name="location" id="location" style="width: 40%; float: right;" required>
                                <option value="none" selected>Location</option>
                                <option value="manpower">Matara</option>
                                <option value="customer">Colombo</option>
                                <option value="contractor">Galle</option>
                                <option value="contractor">Kandy</option>
                            </select><br>
                        </div>
                        <textarea type="text" id="description" name="description" placeholder="Description" style="font-size: 15px; height: 200px" required></textarea><br>              
                        
                        <div class ="postbutton">
                            <button type="reset" class="button cancel"> Cancel</button>
                            &nbsp &nbsp
                            <button type="submit" name="customer_postad" value="submitted" class="button submit"> Post Advertisement</button>
                            <br>
                            <?php if(!empty($data['ComplaintError']) && $data['ComplaintError'] != "none") {?>
                                <p class="error"><?php echo $data['ComplaintError']; ?></p>
                            <?php }else if($data['ComplaintError'] == "none"){?>
                                <p class="success">Your advertisement posted successFully <i style="color: green;" class="fa fa-check" aria-hidden="true"></i></p>
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