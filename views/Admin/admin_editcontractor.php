<?php
session_start();
$contractorDetails = $data['profile_details'];
?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Hub</title>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_editprofile.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="register-section">
                    <div class="register-section-form">
                        <h2>Edit your Profile</h2><br>
                        <form action="<?php echo fullURLfront; ?>/Admin/admin_editcontractor"  method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="iid" name="iid" value="<?php echo base64_encode($contractorDetails->Contractor_ID); ?>">

                            <label for="fname" style="float: left;">First Name</label>
                            <input type="text" id="f_name" name="f_name" placeholder="First name" value="<?php echo $contractorDetails->FirstName; ?>">
                            <label for="lname" style="float: left;">Last Name</label>
                            <input type="text" id="l_name" name="l_name" placeholder="Last name" value="<?php echo $contractorDetails->LastName; ?>">
                            <label for="nic" style="float: left;">NIC</label>
                            <input type="text" id="nic" name="nic" placeholder="NIC" value="<?php echo $contractorDetails->NIC; ?>">
                            <label for="phone" style="float: left;">Phone</label>
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="<?php echo $contractorDetails->phone; ?>">

                            <label for="specialization" style="float: left;">Specialized For :</label>
                            <select name="specialization" id="specialization">
                                <?php foreach ($data['specialization_list'] as $specialization) {?>
                                    <option value="<?php echo $specialization ?>" <?php echo ($specialization == $contractorDetails->Specialized_area) ? 'selected' : ''; ?> ><?php echo $specialization ?></option>
                                <?php }?>
                            </select>
                            
                            <div class="gender" style="float: left;">
                                <p>Please select your Gender:</p>
                                <input type="radio" id="male" name="gender" value="Male" 
                                    <?php echo ($contractorDetails->Gender == "Male") ? 'checked' : ''; ?>>
                                <label for="male">Male</label><br>
                               <input type="radio" id="female" name="gender" value="Female"
                                    <?php echo ($contractorDetails->Gender == "Female") ? 'checked' : ''; ?>>
                                <label for="female">Female</label>
                            </div>
                            <br><br><br><br><br><br><br>
                            <label for="dob" style="float: left;">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $contractorDetails->Date_of_birth; ?>">

                            <label for="address" style="float: left;">Address</label>
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo $contractorDetails->Address; ?>">
                            <label for="district" style="float: left;">District</label>
                            <input type="text" id="district" name="district" placeholder="District" value="<?php echo $contractorDetails->District; ?>">
                            <label for="experience" style="float: left;">Years of experience</label>
                            <input type="text" id="experience" name="experience" placeholder="Years of experience" value="<?php echo $contractorDetails->years_of_experience; ?>">
                            <label for="bank" style="float: left;">Name of the Bank</label>
                            <input type="text" id="bank" name="bank" placeholder="Name of the bank" value="<?php echo $contractorDetails->BankName; ?>">
                            <label for="account" style="float: left;">Account Number</label>
                            <input type="text" id="accnum" name="accnum" placeholder="Account Number" value="<?php echo $contractorDetails->Account_No; ?>">
                            <label for="bio" style="float: left;">Description</label>
                            <textarea rows="4" cols="50" placeholder="Enter yor bio"><?php echo $contractorDetails->bio; ?></textarea>
                            <br>
                            <button type="submit" name="contractor_edit" value="submitted" class="btn-submit">Update</button>
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