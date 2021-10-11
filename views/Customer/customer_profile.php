<?php
// session_start();
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
                <a href="<?php echo fullURLfront; ?>/views/Customer/customer_profileEdit.php">Edit Info <i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="personal-info-section-content">
                    <img src="<?php echo fullURLfront; ?>/assets/images/david.jpg">
                    <div class="details">
                        <table>
                            <tr>
                                <td>First Name</td>
                                <td class="info-right-column">David</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td class="info-right-column">Beckahm</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="info-right-column">davidb@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td class="info-right-column">0775262544</td>
                            </tr>
                            <tr>
                                <td>Rating</td>
                                <td class="info-right-column">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
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
                                <td class="info-right-column-color">No 36, Kent rd, Colombo 07</td>
                            </tr>
                            <tr>
                                <td>DOB</td>
                                <td class="info-right-column-color">1979/05/27</td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td class="info-right-column-color">41</td>
                            </tr>
                            <tr>
                                <td>NIC</td>
                                <td class="info-right-column-color">985476587v</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="billing-info">
                    <h3>Billing Information</h3>
                    <div class="billing-info-content">
                        <table style="width: 40%;">
                            <tr>
                                <td>Name of the Bank</td>
                                <td class="info-right-column-color">BOC</td>
                            </tr>
                            <tr>
                                <td>Account Number</td>
                                <td class="info-right-column-color">892565768</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="bio-info">
                <h3>Bio Information</h3>
                <div class="bio-info-content">
                    <p>Hey!! I'm Dean from Colombo...</p>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>