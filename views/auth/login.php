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
        <link href="<?php echo fullURLfront; ?>/assets/cs/auth/login.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="login-section">
                    <div class="login-section-form">
                        <h2 style="color: white;">Sign In</h2><br>
                        <form action="<?php echo fullURLfront; ?>/auth/login" method="POST"> 
                            <input type="text" id="email" name="email" placeholder="Email"
                            value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['email'] : ''; ?>">

                            <input type="password" id="password" name="password" placeholder="Password"
                            value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['password'] : ''; ?>"><br>

                            <button type="submit" name="login" value="submitted" class="btn-submit">LOGIN</button>
                        </form>
                        <br>
                        <p class="error"><?php echo $data['loginError']; ?></p>
                        <p>Did you forgot your password? <a href="<?php echo fullURLfront; ?>/auth/forgot_password">Forgot Password</a></p>
                        <p>Not a member? <a href="<?php echo fullURLfront; ?>/main/index#signup">Sign Up</a></p>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/intro.png" alt="image" height="60%" width="50%">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>