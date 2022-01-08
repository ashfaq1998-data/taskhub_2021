<?php
session_start();
$contractorDetails = $data['contractor_details'];
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
                        <form action="<?php echo fullURLfront; ?>/Contractor/contractor_editprofile" method="POST"> 
                            <input type="text" id="f_name" name="f_name" placeholder="First name" value="<?php echo $contractorDetails->FirstName; ?>">
                            <input type="text" id="l_name" name="l_name" placeholder="Last name" value="<?php echo $contractorDetails->LastName; ?>">
                            <input type="text" id="nic" name="nic" placeholder="NIC" value="<?php echo $contractorDetails->NIC; ?>">
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="<?php echo $contractorDetails->Contact_No; ?>">
                            <select name="specialization" id="specialization">
                                <?php foreach ($data['specialization_list'] as $specialization) {?>
                                    <option value="<?php echo $specialization ?>" <?php echo ($specialization == $data['inputted_data']['specialization']) ? 'selected' : ''; ?> ><?php echo $specialization ?></option>
                                <?php }?>
                            </select>
                            <div class="gender">
                                <p>Please select your Gender:</p>
                                <input type="radio" id="male" name="gender" value="male">
                                <label for="male">Male</label><br>
                                <input type="radio" id="female" name="gender" value="female">
                                <label for="css">Female</label><br><br>
                            </div>

                            <input type="file" id="image" name="Image" placeholder="Upload the image" value="">
                            <input type="date" id="dob" name="dob">
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo $contractorDetails->Address; ?>">
                            <input type="text" id="ratehrs" name="ratehrs" placeholder="Rate for 2 hours" value="<?php echo $contractorDetails->Payment_for_2hours; ?>">

                            <input type="text" id="experience" name="experience" placeholder="Years of experience" value="<?php echo $contractorDetails->Year_of_experience; ?>">
                            <input type="text" id="bank" name="bank" placeholder="Name of the bank" value="<?php echo $contractorDetails->Name_of_Bank; ?>">
                            <input type="text" id="accnum" name="accnum" placeholder="Account Number" value="<?php echo $contractorDetails->Account_Number; ?>">
                            <textarea rows="4" cols="50" placeholder="Enter yor bio"><?php echo $contractorDetails->bio; ?></textarea>
                            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $_SESSION['loggedin']['email']; ?>">
                            <input type="password" id="password" name="password" placeholder="Password" value="">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value=""><br>
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