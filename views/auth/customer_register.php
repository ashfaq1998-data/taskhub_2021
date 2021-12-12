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
                            
                            <input type="text" id="f_name" name="f_name" maxlength="20" placeholder="First name" title="Names should contain only alphabets (eg: John)" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['f_name'] : ''; ?>">
                            <input type="text" id="l_name" name="l_name" maxlength="20" placeholder="Last name" title="Names should contain only alphabets (eg: Player)" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['l_name'] : ''; ?>" >
                            <input type="text" id="address" name="address" maxlength="50" placeholder="Permanent Address" title="eg: No 35, Reid avenur, Colombo 07" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['address'] : ''; ?>">

                            <select name="gender" id="gender" required>
                                <?php foreach ($data['gender'] as $gender) {?>
                                    <option value="<?php echo $gender ?>" <?php echo ($gender == $data['inputted_data']['gender']) ? 'selected' : ''; ?> ><?php echo $gender ?></option>
                                <?php }?>
                            </select>

                            <input type="text" id="nic" name="nic" placeholder="NIC/Passport ID" title="eg: 199800111222 or 980011222v/V/x/X" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['nic'] : ''; ?>" >
                            <input type="text" id="phone_num" name="phone_num" placeholder="Contact Number" title="eg: 0712233444" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['phone_num'] : ''; ?>" >
                            <input type="text" id="email" name="email" placeholder="Email" title="eg: john99@gmail.com" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['email'] : ''; ?>" >
                            <input type="password" id="password" name="password" placeholder="Password"
                            value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['password'] : ''; ?>" >                           
                            <input type="password" id="confirm_password" name="confirm_password" onkeyup='check();' placeholder="Confirm Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['confirm_password'] : ''; ?>" >
                            <br><span id='message'></span>

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

                            <p style="color: red;" class="error"><?php echo $data['registerError']; ?></p>

                            <button type="submit" name="customer_register" value="submitted" class="btn-submit">Register</button>
                        </form>
                        
                        <p>Already a member? <a href="<?php echo fullURLfront; ?>/auth/login">Sign In</a></p>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/reg_image.png" alt="image" height="50%" width="40%" style="margin-top: 30px; transform:translateX(25vh)">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>