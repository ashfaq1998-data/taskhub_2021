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
        <link href="<?php echo fullURLfront; ?>/assets/cs/admin/admin_editcustomer.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="register-section">
                    <div class="register-section-form">
                        <h2>Add New Customer</h2><br>
                        <form action="<?php echo fullURLfront; ?>/Admin/admin_addcustomer" method="POST"> 
                            <input type="text" id="f_name" name="f_name" placeholder="First name" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['f_name'] : ''; ?>">
                            <input type="text" id="l_name" name="l_name" placeholder="Last name" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['l_name'] : ''; ?>">
                            <input type="text" id="nic" name="nic" placeholder="NIC" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['nic'] : ''; ?>">
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['phone_num'] : ''; ?>">
                            <input type="text" id="address" name="address" placeholder="Address" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['address'] : ''; ?>">
                            <select name="gender" id="gender">
                                <?php foreach ($data['gender'] as $gender) {?>
                                    <option value="<?php echo $gender ?>" <?php echo ($gender == $data['inputted_data']['gender']) ? 'selected' : ''; ?> ><?php echo $gender ?></option>
                                <?php }?>
                            </select>

                            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['email'] : ''; ?>">
                            <input type="password" id="password" name="password" placeholder="Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['password'] : ''; ?>">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['confirm_password'] : ''; ?>"><br>
                            <button type="submit" name="add_customer" value="submitted" class="btn-submit">Register</button>
                        </form>
                        <br>
                        <p class="error"><?php echo $data['registerError']; ?></p>
                        
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/cusedit.png" alt="image" height="50%" width="60%" style="margin-top: 50px;">
                </div>
                <?php include_once('footer.php'); ?>
            </div>
        </body>
    </html>