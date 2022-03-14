<?php
session_start();
$manpowerDetails = $data['profile_details'];
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
                        <form action="<?php echo fullURLfront; ?>/Admin/admin_editmanpower"  method="POST" enctype="multipart/form-data"> 
                            <input type="hidden" id="iid" name="iid" value="<?php echo base64_encode($manpowerDetails->Manpower_Agency_ID); ?>">
                            <label for="cname" style="float: left;">Company Name</label>
                            <input type="text" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo $manpowerDetails->Company_Name; ?>">
                            <label for="regno" style="float: left;">Company Registration No</label>
                            <input type="text" id="regno" name="regno" placeholder="Registration No" value="<?php echo $manpowerDetails->Company_Registration_No; ?>">
                            <label for="phone" style="float: left;">Contact Number</label>
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="<?php echo $manpowerDetails->Contact_No; ?>">
                            
                            <label for="workers" style="float: left;">Number of Workers</label>
                            <input type="text" id="workers" name="workers" placeholder="No of workers" value="<?php echo $manpowerDetails->No_of_workers; ?>">
                            <label for="ratehrs" style="float: left;">Rate for 2 hours</label>
                            <input type="text" id="ratehrs" name="ratehrs" placeholder="Rate for 2 hours" value="<?php echo $manpowerDetails->Payment_for_2hours; ?>">
                            <label for="owner" style="float: left;">Name of the Owner</label>
                            <input type="text" id="owner" name="owner" placeholder="Name of owner" value="<?php echo $manpowerDetails->owner; ?>">
                            <label for="address" style="float: left;">Address</label>
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo $manpowerDetails->Address; ?>">
                            <label for="district" style="float: left;">District</label>
                            <input type="text" id="district" name="district" placeholder="District" value="<?php echo $manpowerDetails->District; ?>">
                            <label for="experience" style="float: left;">Years of experience</label>
                            <input type="text" id="experience" name="experience" placeholder="Years of experience" value="<?php echo $manpowerDetails->years_of_experience; ?>">
                            <label for="bank" style="float: left;">Name of the Bank</label>
                            <input type="text" id="bank" name="bank" placeholder="Name of the bank" value="<?php echo $manpowerDetails->bank; ?>">
                            <label for="accn" style="float: left;">Account Number</label>
                            <input type="text" id="accnum" name="accnum" placeholder="Account Number" value="<?php echo $manpowerDetails->Account_No; ?>">
                            <label for="bio" style="float: left;">Description</label>
                            <textarea rows="4" cols="50" placeholder="Enter yor bio"><?php echo $manpowerDetails->bio; ?></textarea>
                            <br>
                            <button type="submit" name="manpower_edit" value="submitted" class="btn-submit">Update</button>
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