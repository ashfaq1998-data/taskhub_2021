<?php
// ini_set('session.gc_maxlifetime', 60 * 480);
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
                            <input type="text" id="f_name" name="f_name" placeholder="First name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['f_name'] : ''; ?>"required>
                            <input type="text" id="l_name" name="l_name" placeholder="Last name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['l_name'] : ''; ?>" required>
                            <input type="text" id="address" name="address" placeholder="Permanent Address" maxlength="75" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['address'] : ''; ?>" required>                         
                            
                            <!-- <select name="gender" id="gender" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['gender'] : ''; ?>"required>
                                <option value="none" selected>(Gender)</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select> -->

                            <select name="gender" id="gender" required>
                                <?php foreach ($data['gender'] as $gender) {?>
                                    <option value="<?php echo $gender ?>" <?php echo ($gender == $data['inputted_data']['gender']) ? 'selected' : ''; ?> ><?php echo $gender ?></option>
                                <?php }?>
                            </select>

                            <input type="text" id="nic" name="nic" placeholder="NIC/Passport ID" pattern="(^[0-9]{9}[vVxX])" title="eg: 980000000v/V/x/X" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['nic'] : ''; ?>" required>
                            <input type="text" id="phone_num" name="phone_num" placeholder="Contact Number" pattern="(^[0-9]{10})" title="eg: 0710001111" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['phone_num'] : ''; ?>" required>
                            <input type="text" id="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg: john98@gmail.com" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['email'] : ''; ?>" required>
                            <input type="password" id="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                            value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['password'] : ''; ?>" required>
<<<<<<< HEAD
                            <input type="password" id="confirm_password" name="confirm_password" onkeyup='check();' placeholder="Confirm Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['confirm_password'] : ''; ?>" required> <!-- onkeyup='check();'-->
                            <br><span id='message'></span>          
=======
                            <input type="password" id="confirm_password" name="confirm_password" onkeyup='check();' placeholder="Confirm Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['confirm_password'] : ''; ?>" required><br> <!-- onkeyup='check();'-->
                            <span id='message'></span>          
>>>>>>> 7e0c3392b29cb0cfde460c2cc989df60e8c6279a
                            <script>
                                var check = function() {
                                if (document.getElementById('password').value ==
                                    document.getElementById('confirm_password').value) {
                                    document.getElementById('message').style.color = 'green';
                                    document.getElementById('message').innerHTML = 'Password Matching   ';
                                } else {
                                    document.getElementById('message').style.color = 'red';
                                    document.getElementById('message').innerHTML = 'Password not matching   ';
                                }
                                }
                            </script>

                            <!-- placeholder="First name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters"
                            placeholder="Last name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters"
                            placeholder="Permanent Address" maxlength="75"

                            placeholder="NIC/Passport ID" pattern="(^[0-9]{9}[vVxX])" title="eg: 980000000v/V/x/X"
                            placeholder="Contact No" pattern="(^[0-9]{10})" title="eg: 0710001111"
                            placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg: john98@gmail.com"
                            placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" 
                            placeholder="Confirm Password"  -->

                            <br><button type="submit" name="customer_register" value="submitted" class="btn-submit">Register</button>
                        </form>
                        <p>Already a member? <a href="<?php echo fullURLfront; ?>/auth/login">Sign In</a></p>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/reg_image.png" alt="image" height="50%" width="40%" style="margin-top: 30px; transform:translateX(25vh)">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>