<?php
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
        <link href="<?php echo fullURLfront; ?>/assets/cs/auth/manpower_register.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="register-section">
                    <div class="register-section-form">
                        <h2>Sign Up</h2><br>
                        <form action="<?php echo fullURLfront; ?>/auth/manpower_register" method="POST"> 
                            <input type="text" id="company_name" name="company_name" placeholder="Company name" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['company_name'] : ''; ?>">
                            <input type="text" id="company_register" name="company_register" placeholder="Company Registration Number" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['company_register'] : ''; ?>">
                            <input type="text" id="district" name="district" placeholder="District" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['district'] : ''; ?>">
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['phone_num'] : ''; ?>">
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['address'] : ''; ?>">
                            

                            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['email'] : ''; ?>">
                            <input type="password" id="password" name="password" placeholder="Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['password'] : ''; ?>">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['confirm_password'] : ''; ?>"><br>
                            <button type="submit" name="manpower_register" value="submitted" class="btn-submit">Register</button>
                        </form>
                        <br>
                        <p class="error"><?php echo $data['registerError']; ?></p>
                        <p>Already a member? <a href="<?php echo fullURLfront; ?>/auth/login">Sign In</a></p>
                        <div class="youtube">
                            <p>Don't know how to create a email account? <a href="https://www.youtube.com/watch?v=Ft7gbSV2lsE&t=8s">Click here</a></p>
                        </div>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/reg page image.png" alt="image" height="50%" width="60%" style="margin-top: 50px;">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>