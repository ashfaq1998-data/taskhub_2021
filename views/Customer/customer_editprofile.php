<?php
session_start();
$customerDetails = $data['customer_details'];
?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Hub</title>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_editprofile.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="register-section">
                    <div class="register-section-form">
                        <h2>Edit your Profile</h2><br>
                        <form action="<?php echo fullURLfront; ?>/Customer/customer_editprofile" method="POST" enctype="multipart/form-data"> 
                            <label for="fname" style="float: left;">First Name</label>
                            <input type="text" id="f_name" name="f_name" placeholder="First name" value="<?php echo $customerDetails->FirstName; ?>">
                            <label for="lname" style="float: left;">Last Name</label>
                            <input type="text" id="l_name" name="l_name" placeholder="Last name" value="<?php echo $customerDetails->LastName; ?>">
                            <label for="nic" style="float: left;">NIC</label>
                            <input type="text" id="nic" name="nic" placeholder="NIC" value="<?php echo $customerDetails->NIC; ?>">
                            <label for="phone" style="float: left;">Phone</label>
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="<?php echo $customerDetails->Contact_No; ?>">
                            
                            <div class="gender" style="float: left;">
                                <p>Please select your Gender:</p>
                                <input type="radio" id="male" name="gender" value="Male" 
                                    <?php echo ($customerDetails->Gender == "Male") ? 'checked' : ''; ?>>
                                <label for="male">Male</label><br>
                                <input type="radio" id="female" name="gender" value="Female" style="margin-left: 13px;"
                                    <?php echo ($customerDetails->Gender == "Female") ? 'checked' : ''; ?>>
                                <label for="css">Female</label><br><br>
                            </div>

                            <input type="file" id="image" name="image" value="">
                            <label for="dob" style="float: left;">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $customerDetails->Date_of_Birth; ?>">
                            <label for="address" style="float: left;">Address</label>
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo $customerDetails->Address; ?>">
                            <label for="district" style="float: left;">District</label>
                            <input type="text" id="district" name="district" placeholder="District" value="<?php echo $customerDetails->District; ?>">
                            <label for="district" style="float: left;">Card Number</label>
                            <input type="text" id="accnum" name="accnum" placeholder="Card Number" value="<?php echo $customerDetails->Card_Number; ?>">
                            <label for="exp" style="float: left;">Expiry Date</label>
                            <input type="date" id="exp" name="exp" value="<?php echo $customerDetails->Expiry_Date; ?>">
                            <label for="cvn" style="float: left;">CVN number</label>
                            <input type="text" id="cvn" name="cvn" placeholder="CVN Number" value="<?php echo $customerDetails->CVN; ?>">
                            <label for="bio" style="float: left;">Description</label>
                            <textarea rows="4" cols="50" placeholder="Enter yor bio"  id="bio" name="bio"><?php echo $customerDetails->bio; ?></textarea>
                            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $_SESSION['loggedin']['email']; ?>" readonly>
                            <label for="password" style="float: left;">Enter new Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" value="">
                            <label for="confirm" style="float: left;">Confirm new password</label>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value=""><br>
                            <button type="submit" name="customer_edit" value="submitted" class="btn-submit">Update</button>
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