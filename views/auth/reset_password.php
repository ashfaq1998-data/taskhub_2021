<?php
session_start();
$code = $data['details']['code'];
$email = $data['details']['email'];
?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Hub</title>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/auth/reset_password.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="resetpassword-section">
                    <div class="resetpassword-section-form">
                        <h2>Reset Password</h2><br>  
                            <p>Please enter your new password below</p>
                            <form action="<?php echo fullURLfront; ?>/auth/reset_password?code=<?php echo $code; ?>&email=<?php echo $email; ?>" method="POST"> 
                                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['password'] : ''; ?>">
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['confirm_password'] : ''; ?>"><br>
                                <button type="submit" class="btn-submit" name="reset_password" value="submitted">Submit</button>
                            </form>
                            <br>
                            <p class="error"><?php echo $data['error']; ?></p>
                       
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/reg page image.png" alt="image" height="50%" width="60%" style="margin-top: 50px;">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>