<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_confirmeditad.css" rel="stylesheet" type="text/css"/>  
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_complaint.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <div class="page-wrapper">
            
            <?php include_once('header.php'); ?>
            <div class="row">
                <div class="column1">
                    <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
                </div>
                <div class="column2">
                    <div class="top-image-column2">
                        <img class="image-top" src="<?php echo fullURLfront; ?>/assets/images/wall-builder.png">
                    </div>
                    <div class="confirm-box">
                        Advertisement edit successful.
                        <div>
                            <button></button>
                            <button></button>
                        </div>
                    </div>
                </div>
            
            </div>
            <?php include_once('footer.php'); ?>
        </div>
    </body>
</html>