<?php
    session_start();
    $customerDetails = $data['customer_details'];
    $err = $data['registerError'];
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
                    <a class="close" href="<?php echo fullURLfront; ?>/Customer/customer_profile">x</a>
                    <!-- <form action = "<?php echo fullURLfront; ?>/Customer/customer_profileEdUp" method="post">
                        <button class="button close">x</button>
                    </form> -->
                    <form action="<?php echo fullURLfront; ?>/Customer/customer_profileEdUp" method="POST" enctype="multipart/form-data">
                        <h1>Edit Profile</h1>
                        <div class="elem-group">
                            <div class="image">
                                <label for="image">Profile Picture</label>
                                <input type="file" id="image" name="image" value="">
                            </div><br>
                            <div class="firstname">
                                <label for="f_name">First Name</label>
                                <input type="text" id="f_name" name="f_name" 
                                title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" 
                                value="<?php echo $customerDetails->FirstName; ?>" >
                            </div>
                            <div class="lastname">
                                <label for="l_name">Last Name</label>
                                <input type="text" id="l_name" name="l_name" 
                                title="Name must contain only A-Z & a-z characters, and shouldn't exceed no more than 32 characters" 
                                value="<?php echo $customerDetails->LastName; ?>" >
                            </div>
                        </div>
                        <div class="elem-group">
                            <label for="address">Permenant Address</label>
                            <input type="text" id="address" name="address" maxlength="75" 
                            value="<?php echo $customerDetails->Address; ?>" >
                        </div>
                        <div class="elem-group">
                            <label for="nic">NIC</label>
                            <input type="text" id="nic" name="nic" title="eg: 199800111222 or 980011222v/V/x/X" 
                            value="<?php echo $customerDetails->NIC; ?>" >
                        </div>
                        <div class="elem-group">
                            <label for="phone_num">Contact Number</label>
                            <input type="text" id="phone_num" name="phone_num" title="eg: 0710001111" 
                            value="<?php echo $customerDetails->Contact_No; ?>" >
                        </div>
                        <div class="elem-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                            title="eg: john98@gmail.com" value ="<?php echo $_SESSION['loggedin']['email']; ?>" value disabled >
                        </div>
                        <div class="elem-group">
                            <label for="email">Date of Birth</label>
                            <input type="date" id="dob" name="dob" 
                            title="eg: john98@gmail.com" value="<?php echo $customerDetails->Date_of_Birth; ?>" >
                        </div>
                        <hr>
                        <div class="card-details">
                            <div class="elem-group">
                                <label for="card_num" style="width: 90%;" >Card Number</label>
                                <input type="text" id="card_num" name="card_num" style="width: 90%;" pattern="(^[0-9]{16})" 
                                title="eg: 4216000011112222" value="<?php echo $customerDetails->Card_Number; ?>" >
                            </div>
                            <div class="elem-group">
                                <label for="cvv" style="width: 40%; position: relative; left: 50px;">CVV</label>
                                <input type="text" id="cvv" name="cvv" style="width: 40%; position: relative; left: 50px;" 
                                pattern="(^[0-9]{3})" title="eg: 555" maxlength="3" value="<?php echo $customerDetails->CVN; ?>" >
                            </div>
                            <div class="elem-group">
                                <label for="expiry" style="width: 40%; position: relative; left: 68px;">Expiry Date</label>
                                <input type="text" id="expiry" name="expiry" style="width: 40%; position: relative; left: 68px;" 
                                pattern="(^[0-9]{2}[/]{1}[0-9]{2})" title="eg: 01/21(MM/YY)" 
                                value="<?php echo $customerDetails->Expiry_Date; ?>" >
                            </div>
                        </div>
                        <hr>
                        <div class="elem-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" 
                           style="height: 80px;" placeholder="Tell us about you..."> <?php echo $customerDetails->bio; ?> </textarea>
                        </div>
                        <hr>
                        <div class="elem-group">
                            <label for="password">Password</label>
                            <input type="password" id="current_password" name="current_password" placeholder="Current password"
                            value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['current_password'] : ''; ?>"><br><br>
                            <input type="password" id="password" name="password" placeholder="Password"
                            value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['password'] : ''; ?>"><br><br>                      
                            <input type="password" id="confirm_password" name="confirm_password" onkeyup='check();' placeholder="Confirm Password" 
                            value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['confirm_password'] : ''; ?>" >
                            <br><br><span id='message'></span>

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
                            <p style="color: red;" class="error"><?php echo $err; ?></p>
                        </div>
                        <div class="submit">
                            <button type="submit" name="customer_edit" value="submitted" class="sub">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>
    <?php include_once('footer.php'); ?>
</div>    
</body>
</html>