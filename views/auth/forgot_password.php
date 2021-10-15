<?php
ini_set('session.gc_maxlifetime', 60 * 480);
/*date_default_timezone_set('Australia/Melbourne');*/
session_start();
?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Hub</title>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/auth/forgotpassword.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="forgotpassword-section">
                    <div class="forgotpassword-section-form">
                        <h2>Forgot Password</h2><br>
                        <p>Please enter your mail address below</p>
                        <form action="<?php echo fullURLfront; ?>/auth/forgot_password" method="POST"> 
                            <input type="text" id="email" name="email" placeholder="Email">
                            <button type="submit" class="btn-submit">Submit</button>
                        </form>
                        <br>
                       
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/reg page image.png" alt="image" height="50%" width="60%" style="margin-top: 50px;">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>