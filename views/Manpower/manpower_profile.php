<?php

session_start();
$manpowerDetails = $data['manpower_details'];


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_profile.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Manpower/manpower_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class="personal-info-section">
                <span>Personal Info</span>
                <a href="<?php echo fullURLfront; ?>/Manpower/manpower_editprofile">Edit Info <i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="personal-info-section-content">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($manpowerDetails->image); ?>" alt="Avatar" class="avatar">
                    <div class="details">
                        <table>
                            <tr>
                                <td>Company Name</td>
                                <td class="info-right-column"><?php echo $manpowerDetails->Company_Name; ?></td>
                            </tr>
                            <tr>
                                <td>Registration No</td>
                                <td class="info-right-column"><?php echo $manpowerDetails->Company_Registration_No; ?></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td class="info-right-column"><?php echo $_SESSION['loggedin']['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Owner</td>
                                <td class="info-right-column"><?php echo $manpowerDetails->owner; ?></td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td class="info-right-column"><?php echo $manpowerDetails->Contact_No; ?></td>
                            </tr>
                            <tr>
                                <td>Rating</td>
                                <td class="info-right-column">
                                    <?php for($i = 1; $i <= $manpowerDetails->rating; $i++) {?>
                                        <span class="fa fa-star checked"></span>
                                    <?php }?>
                                    <?php for($i = 1; $i <= (5-$manpowerDetails->rating); $i++) {?>
                                        <span class="fa fa-star"></span>
                                    <?php }?>
                                    <!-- <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span> -->
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="additional-info">
                <h3>Additional Information</h3>
                <div class="additional-info-content">
                    <table style="width: 40%;">
                        <tr>
                            <td>Address</td>
                            <td class="info-right-column-color"><?php echo $manpowerDetails->Address; ?></td>
                        </tr>
                        <tr>
                            <td>District</td>
                            <td class="info-right-column-color"><?php echo $manpowerDetails->District; ?></td>
                        </tr>
                        <tr>
                            <td>No of Workers</td>
                            <td class="info-right-column-color"><?php echo $manpowerDetails->No_of_workers; ?></td>
                        </tr>
                        <tr>
                            <td>Visiting Charge</td>
                            <td class="info-right-column-color"><?php echo $manpowerDetails->Payment_for_2hours; ?></td>
                        </tr>
                        <tr>
                            <td>Years of experience</td>
                            <td class="info-right-column-color"><?php echo $manpowerDetails->years_of_experience; ?></td>
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
                            <td class="info-right-column-color"> <?php echo $manpowerDetails->bank; ?></td>
                        </tr>
                        <tr>
                            <td>Account Number</td>
                            <td class="info-right-column-color"><?php echo $manpowerDetails->Account_No; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bio-info">
                <h3>Bio Information</h3>
                <div class="bio-info-content">
                    <p><?php echo $manpowerDetails->bio; ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>