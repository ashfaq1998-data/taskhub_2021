<?php

    session_start();
    $customerDetails = $data['customer_details'];
    // Create a datetime object using date of birth
    $dob = new DateTime($customerDetails->Date_of_Birth);
    
    // Get today's date
    $now = new DateTime();
    
    // Calculate the time difference between the two dates
    $diff = $now->diff($dob);
    $age = $diff->y;
    if($age == 0){
        $age = "-";
    }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_profile.css" rel="stylesheet" type="text/css"/>
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
            <div class="personal-info-section">
                <span>Personal Info</span>
                <a href="<?php echo fullURLfront; ?>/Customer/customer_profileEd">Edit Info <i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="personal-info-section-content">
                    <img src="<?php echo fullURLfront; ?>/assets/images/david.jpg">
                    <div class="details">
                        <table>
                            <tr>
                                <td>First Name</td>
                                <td class="info-right-column"><?php echo $customerDetails->FirstName; ?></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td class="info-right-column"><?php echo $customerDetails->LastName; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="info-right-column"><?php echo $_SESSION['loggedin']['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td class="info-right-column"><?php echo $customerDetails->Contact_No; ?></td>
                            </tr>
                            <tr>
                                <td>Rating</td>
                                <td class="info-right-column">
                                    <?php for($i = 1; $i <= $customerDetails->rating; $i++) {?>
                                        <span class="fa fa-star checked"></span>
                                    <?php }?>
                                    <?php for($i = 1; $i <= (5-$customerDetails->rating); $i++) {?>
                                        <span class="fa fa-star"></span>
                                    <?php }?>
                                    <!-- <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span> -->
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col1" style="display: flex; margin-right: 21.5vh; position:relative; top: -18px">
                <div class="additional-info">
                    <h3>Additional Information</h3>
                    <div class="additional-info-content">
                        <table>
                            <tr>
                                <td>Address</td>
                                <td class="info-right-column-color"><?php echo $customerDetails->Address; ?></td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td class="info-right-column-color"><?php echo $customerDetails->Date_of_Birth; ?></td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td class="info-right-column-color"><?php echo $age ?></td>
                            </tr>
                            <tr>
                                <td>NIC</td>
                                <td class="info-right-column-color"><?php echo $customerDetails->NIC; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="billing-info">
                    <h3>Billing Information</h3>
                    <div class="billing-info-content">
                        <table style="width: 40%;">
                            <tr>
                                <td>Card Number</td>
                                <td class="info-right-column-color"> <?php echo $customerDetails->Card_Number; ?></td>
                            </tr>
                            <tr>
                                <td>Expiry Date</td>
                                <td class="info-right-column-color"><?php echo $customerDetails->Expiry_Date; ?></td>
                            </tr>
                            <tr>
                                <td>CVV</td>
                                <td class="info-right-column-color"><?php echo $customerDetails->CVN; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="bio-info">
                <h3>Bio Information</h3>
                <div class="bio-info-content">
                    <p><?php echo $customerDetails->bio; ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>