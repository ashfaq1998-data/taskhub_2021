<?php
// ini_set('session.gc_maxlifetime', 60 * 480);
/*date_default_timezone_set('Australia/Melbourne');*/
// session_start(); 
?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Hub</title>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/auth/customer_register.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="register-section">
                    <!-- <form action = "<?php echo fullURLfront; ?>/main/index">     go to the homepage when clicks close button
                        <button class="button close">X</button>
                    </form> -->
                    <div class="register-section-form">
                        <h2>Sign Up</h2><br>
                        <a id="close" href="<?php echo fullURLfront; ?>/main/index"> x </a>
                        <form action="<?php echo fullURLfront; ?>/auth/customer_register" method="POST">
                            <input type="text" id="fname" name="fname" placeholder="First name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" required>
                            <input type="text" id="lname" name="lname" placeholder="Last name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" required>
                            <input type="text" id="address" name="address" placeholder="Permanent Address" maxlength="75" required>
                            <select name="gender" id="gender" required>
                                <option value="none" selected>(Gender)</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <input type="text" id="nic" name="nic" placeholder="NIC/Passport ID" pattern="(^[0-9]{9}[vVxX])" title="eg: 980000000v/V/x/X" required>
                            <input type="text" id="phone_num" name="phone_num" placeholder="Contact No" pattern="(^[0-9]{10})" title="eg: 0710001111" required>
                            <input type="text" id="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg: john98@gmail.com" required>
                            <input type="password" id="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required><br> <!-- onkeyup='check();'-->
                            <script>
                                var check = function() {
                                if (document.getElementById('password').value ==
                                    document.getElementById('confirm_password').value) {
                                    document.getElementById('message').style.color = 'green';
                                    document.getElementById('message').innerHTML = 'matching';
                                } else {
                                    document.getElementById('message').style.color = 'red';
                                    document.getElementById('message').innerHTML = 'not matching';
                                }
                                }
                            </script>
                            <button type="submit" class="btn-submit">Register</button>
                        </form>
                        <p>Already a member? <a href="<?php echo fullURLfront; ?>/auth/login">Sign In</a></p>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/reg_image.png" alt="image" height="50%" width="40%" style="margin-top: 30px; transform:translateX(25vh)">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>