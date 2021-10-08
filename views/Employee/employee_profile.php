<?php

session_start();
$employeeDetails = $data['employee_details'];
// Create a datetime object using date of birth
$dob = new DateTime($employeeDetails->Date_of_Birth);
 
// Get today's date
$now = new DateTime();
 
// Calculate the time difference between the two dates
$diff = $now->diff($dob);
$age = $diff->y;
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_profile.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Employee/employee_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class="personal-info-section">
                <span>Personal Info</span>
                <a href="">Edit Info <i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="personal-info-section-content">
                    <img src="<?php echo fullURLfront; ?>/assets/images/profile.jpeg" alt="Avatar" class="avatar">
                    <div class="details">
                        <table>
                            <tr>
                                <td>First Name</td>
                                <td class="info-right-column"><?php echo $employeeDetails->FirstName; ?></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td class="info-right-column"><?php echo $employeeDetails->LastName; ?></td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td class="info-right-column"><?php echo $_SESSION['loggedin']['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td class="info-right-column"><?php echo $employeeDetails->Contact_No; ?></td>
                            </tr>
                            <tr>
                                <td>Rating</td>
                                <td class="info-right-column">
                                    <?php for($i = 1; $i <= $employeeDetails->rating; $i++) {?>
                                        <span class="fa fa-star checked"></span>
                                    <?php }?>
                                    <?php for($i = 1; $i <= (5-$employeeDetails->rating); $i++) {?>
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
                            <td class="info-right-column-color"><?php echo $employeeDetails->Address; ?></td>
                        </tr>
                        <tr>
                            <td>DOB</td>
                            <td class="info-right-column-color"><?php echo $employeeDetails->Date_of_Birth; ?></td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td class="info-right-column-color"><?php echo $age ?></td>
                        </tr>
                        <tr>
                            <td>NIC</td>
                            <td class="info-right-column-color"><?php echo $employeeDetails->NIC; ?></td>
                        </tr>
                        <tr>
                            <td>Rate for 2 hours</td>
                            <td class="info-right-column-color"><?php echo $employeeDetails->Payment_for_2hours; ?></td>
                        </tr>
                        <tr>
                            <td>Years of experience</td>
                            <td class="info-right-column-color"><?php echo $employeeDetails->Year_of_experience; ?></td>
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
                            <td class="info-right-column-color"> <?php echo $employeeDetails->Name_of_Bank; ?></td>
                        </tr>
                        <tr>
                            <td>Account Number</td>
                            <td class="info-right-column-color"><?php echo $employeeDetails->Account_Number; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bio-info">
                <h3>Bio Information</h3>
                <div class="bio-info-content">
                    <p><?php echo $employeeDetails->bio; ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>