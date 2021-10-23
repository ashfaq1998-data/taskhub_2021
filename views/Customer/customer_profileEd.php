<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

    <!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_profileEd.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Customer/customer_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class="subrow">
                <div class="subcolumn1">
                    <img src="<?php echo fullURLfront; ?>/assets/images/booking.JPG" alt="image">
                </div>
                <div class="subcolumn">
                    <!-- <a href="<?php echo fullURLfront; ?>/Employee/employee_help"><i class="fa fa-info-circle"></i> x</a> -->
                    <form action = "<?php echo fullURLfront; ?>/Customer/customer_profile" method="POST">     <!-- go to the help page when clicks close button -->
                        <button class="button close">x</button>
                    </form>
                    <form action="<?php echo fullURLfront; ?>/Customer/customer_profileEd" method="POST">      <!-- go to the emp_booking page when clicks submit button -->
                        <h1>Edit Profile</h1>
                        <div class="elem-group">
                            <div class="firstname">
                                <label for="f_name">First Name</label>
                                <input type="text" id="f_name" name="f_name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['f_name'] : ''; ?>" >
                            </div>
                            <div class="lastname">
                                <label for="l_name">Last Name</label>
                                <input type="text" id="l_name" name="l_name" pattern="[A-Za-z]{1,32}" title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['l_name'] : ''; ?>" >  
                            </div>
                        </div>
                        <div class="elem-group">
                            <label for="address">Permenant Address</label>
                            <input type="text" id="address" name="address" maxlength="75" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['address'] : ''; ?>" >
                        </div>
                        <div class="elem-group">
                            <label for="nic">NIC</label>
                            <input type="text" id="nic" name="nic" pattern="(^[0-9]{9}[vVxX])" title="eg: 980000000v/V/x/X" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['nic'] : ''; ?>" >
                        </div>
                        <div class="elem-group">
                            <label for="phone_num">Contact Number</label>
                            <input type="text" id="phone_num" name="phone_num" pattern="(^[0-9]{10})" title="eg: 0710001111" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['phone_num'] : ''; ?>" >
                        </div>
                        <div class="elem-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="eg: john98@gmail.com" value="<?php echo $_SESSION['loggedin']['email']; ?>" >
                        </div>
                        <hr>
                        <div class="card-details">
                            <div class="elem-group">
                                <label for="card_num">Card Number</label>
                                <input type="text" id="card_num" name="card_num" pattern="(^[0-9]{16})" title="eg: 4216000011112222" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['card_num'] : ''; ?>" >
                            </div>
                            <div class="elem-group">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" pattern="(^[0-9]{3})" title="eg: 555" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['cvv'] : ''; ?>" >
                            </div>
                            <div class="elem-group">
                                <label for="expiry">Expiry Date</label>
                                <input type="text" id="expiry" name="expiry" pattern="(^[0-9]{2}[/]{1}[0-9]{2})" title="eg: 01/21(MM/YY)" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['expiry'] : ''; ?>" >
                            </div>
                            <div class="elem-group">
                                <label for="bio">Bio</label>
                                <textarea id="bio" name="bio" placeholder="Tell us about you..."></textarea>
                            </div>
                        </div>
                        <button type="submit" class="sub">Submit</button>
                    </form>
                </div>
            </div>
        </div>        
    </div>
    <?php include_once('footer.php'); ?>
</div>    
</body>
</html>