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
        <link href="<?php echo fullURLfront; ?>/assets/cs/auth/employee_register.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="register-section">
                    <div class="register-section-form">
                        <h2>Sign Up</h2><br>
                        <form action="<?php echo fullURLfront; ?>/auth/employee_register" method="POST"> 
                            <input type="text" id="f_name" name="f_name" placeholder="First name">
                            <input type="text" id="l_name" name="l_name" placeholder="Last name">
                            <input type="text" id="nic" name="nic" placeholder="NIC">
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No">
                            <select name="specialization" id="specialization">
                                <option value="volvo" selected>Specialized For</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>


                            <input type="text" id="email" name="email" placeholder="Email">
                            <input type="password" id="password" name="password" placeholder="Password">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"><br>
                            <button type="submit" class="btn-submit">Register</button>
                        </form>
                        <br>
                        <p>Already a member? <a href="<?php echo fullURLfront; ?>/auth/login">Sign In</a></p>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/reg page image.png" alt="image" height="50%" width="60%" style="margin-top: 50px;">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>