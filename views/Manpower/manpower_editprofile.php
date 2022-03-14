<?php
session_start();
$manpowerDetails = $data['manpower_details'];
?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Hub</title>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_editprofile.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="register-section">
                    <div class="register-section-form">
                        <h2>Edit your Profile</h2><br>
                        <form action="<?php echo fullURLfront; ?>/Manpower/manpower_editprofile" method="POST" enctype="multipart/form-data"> 
                            <label for="cname" style="float: left;">Company Name</label>
                            <input type="text" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo $manpowerDetails->Company_Name; ?>">
                            <label for="regno" style="float: left;">Company Registration Number</label>
                            <input type="text" id="regno" name="regno" placeholder="Registration No" value="<?php echo $manpowerDetails->Company_Registration_No; ?>">
                            <label for="contact" style="float: left;">Contact Number</label>
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="<?php echo $manpowerDetails->Contact_No; ?>">
                            

                            <input type="file" id="image" name="image" value="">
                            <label for="workers" style="float: left;">Total Number of workers</label>
                            <input type="text" id="workers" name="workers" placeholder="No of workers" value="<?php echo $manpowerDetails->No_of_workers; ?>">
                            <label for="payment" style="float: left;">Visiting Charge</label>
                            <input type="text" id="payment" name="payment" placeholder="Visiting Charge" value="<?php echo $manpowerDetails->Payment_for_2hours; ?>">
                            <label for="owner" style="float: left;">Name of Owner</label>
                            <input type="text" id="owner" name="owner" placeholder="Name of owner" value="<?php echo $manpowerDetails->owner; ?>">
                            <label for="address" style="float: left;">Address</label>
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo $manpowerDetails->Address; ?>">
                            <label for="district" style="float: left;">District</label>
                            <input type="text" id="district" name="district" placeholder="District" value="<?php echo $manpowerDetails->District; ?>">
                            <label for="experience" style="float: left;">Years of experience</label>
                            <input type="text" id="experience" name="experience" placeholder="Years of experience" value="<?php echo $manpowerDetails->years_of_experience; ?>">
                            <label for="bank" style="float: left;">Name of the Bank</label>
                            <input type="text" id="bank" name="bank" placeholder="Name of the bank" value="<?php echo $manpowerDetails->bank; ?>">
                            <label for="accno" style="float: left;">Account Number</label>
                            <input type="text" id="accnum" name="accnum" placeholder="Account Number" value="<?php echo $manpowerDetails->Account_No; ?>">
                            <label for="bio" style="float: left;">Description</label>
                            <textarea rows="4" cols="50" placeholder="Enter yor bio" id="bio" name="bio"><?php echo $manpowerDetails->bio; ?></textarea>
                            <label for="email" style="float: left;">Email</label>
                            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $_SESSION['loggedin']['email']; ?>"  readonly>
                            <label for="password" style="float: left;">Enter new Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" value="">
                            <label for="confirm" style="float: left;">Confirm new password</label>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value=""><br>
                            <button type="submit" name="manpower_edit" value="submitted" class="btn-submit">Update</button>
                            <p class="warning">Email cannot be edited or updated</p>
                        </form>
                        <br>
                        <p class="error"><?php echo $data['editError']; ?></p>
                        
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/copyright.jpg" alt="image" height="50%" width="50%" style="margin-top: 50px;">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>