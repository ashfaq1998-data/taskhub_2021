<?php

session_start();
$contractorDetails = $data['contractor_details'];
// Create a datetime object using date of birth
$dob = new DateTime($contractorDetails->Date_of_birth);
 
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
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_profile.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
<link href="<?php echo fullURLfront; ?> /assets/cs/contractor/contractorprofile.css" rel="stylesheet">
</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class="personal-info-section">
                <span>Personal Info</span>
                <a href="<?php echo fullURLfront; ?>/Contractor/contractor_editprofile">Edit Info <i class="fa fa-pencil" aria-hidden="true"></i></a>
                <div class="personal-info-section-content">
                    <img src="<?php echo fullURLfront; ?>/assets/images/thisara.jpg" alt="Avatar" class="avatar">
                    <div class="details">
                        <table>
                            <tr>
                                <td class="info-left-column">First Name</td>
                                <td class="info-right-column"><?php echo $contractorDetails->FirstName; ?></td>
                            </tr>
                            <tr>
                                <td class="info-left-column">Last Name</td>
                                <td class="info-right-column"><?php echo $contractorDetails->LastName; ?></td>
                            </tr>
                            <tr>
                                <td class="info-left-column">E-mail</td>
                                <td class="info-right-column"><?php echo $_SESSION['loggedin']['email']; ?></td>
                            </tr>
                            <tr>
                                <td class="info-left-column">Contact Number</td>
                                <td class="info-right-column"><?php echo $contractorDetails->phone; ?></td>
                            </tr>
                            <tr>
                                <td class="info-left-column">Rating</td>
                                <td class="info-right-column">
                                    <?php for($i = 1; $i <= $contractorDetails->rating; $i++) {?>
                                        <span class="fa fa-star checked"></span>
                                    <?php }?>
                                    <?php for($i = 1; $i <= (5-$contractorDetails->rating); $i++) {?>
                                        <span class="fa fa-star"></span>
                                    <?php }?>
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

            <div class="bio-info">
                <h3 class="subtopics">Bio Information</h3>
                <div class="bio-info-content">
                    <p id=biodetails><?php echo $contractorDetails->bio; ?></p>
                </div>
            </div>
            <div class="additional-info">
                <h3 class="subtopics">Additional Information</h3>
                <div class="additional-info-content">
                    <table style="width: 40%;">
                        <tr>
                            <td class = "info-left-column-color ">Address</td>
                            <td class="info-right-column-color"><?php echo $contractorDetails->Address; ?></td>
                        </tr>
                        <tr>
                            <td class= "info-left-column-color ">DOB</td>
                            <td class="info-right-column-color"><?php echo $contractorDetails->Date_of_Birth; ?></td>
                        </tr>
                        <tr>
                            <td class= "info-left-column-color "> Age</td>
                            <td class="info-right-column-color"><?php echo $age ?></td>
                        </tr>
                        <tr>
                            <td  class= "info-left-column-color ">NIC</td>
                            <td class="info-right-column-color"><?php echo $contractorDetails->NIC; ?></td>
                        </tr>
                        
                        <tr>
                            <td  class= "info-left-column-color ">Years of experience</td>
                            <td class="info-right-column-color"><?php echo $contractorDetails->Year_of_experience; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="billing-info">
                <h3 class="subtopics">Billing Information</h3>
                <div class="billing-info-content">
                    <table style="width: 40%;">
                        <tr>
                            <td  class= "info-left-column-color ">Name of the Bank</td>
                            <td class="info-right-column-color"> <?php echo $contractorDetails->Name_of_Bank; ?></td>
                        </tr>

                        <tr>
                            <td  class= "info-left-column-color ">Account owner</td>
                            <td class="info-right-column-color"> <?php echo $contractorDetails->Account_owner; ?></td>
                        </tr>

                        <tr>
                            <td  class= "info-left-column-color ">Account Number</td>
                            <td class="info-right-column-color"><?php echo $contractorDetails->Account_Number; ?></td>
                        </tr>

                        <tr>
                            <td  class= "info-left-column-color ">Branch</td>
                            <td class="info-right-column-color"> <?php echo $contractorDetails->Branch; ?></td>
                        </tr>

                    </table>
                </div>
            </div>
           
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>