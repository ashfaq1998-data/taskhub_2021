<?php

session_start();
$profileDetails = $data['profile_details'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_view_profile.css" rel="stylesheet" type="text/css"/>
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
                <span>Profile Info</span>
                <div class="personal-info-section-content">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($profileDetails->image); ?>" alt="Avatar" class="avatar">
                    <div class="details">
                        <table>
                            <tr>
                                <td>Name</td>
                                <td class="info-right-column"><?php echo $profileDetails->ProfileFullName; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td class="info-right-column"><?php echo $profileDetails->Address; ?></td>
                            </tr>
                            <?php if(!empty($profileDetails->years_of_experience)) {?>
                                <tr>
                                    <td>Years of Experience</td>
                                    <td class="info-right-column"><?php echo $profileDetails->years_of_experience; ?></td>
                                </tr>
                            <?php } ?>
                            <?php if(!empty($profileDetails->Payment_for_2hours)) {?>
                                <tr>
                                    <td>Visiting Charge</td>
                                    <td class="info-right-column"><?php echo $profileDetails->Payment_for_2hours; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Rating</td>
                                <td class="info-right-column">
                                    <?php for($i = 1; $i <= $profileDetails->rating; $i++) {?>
                                        <span class="fa fa-star checked"></span>
                                    <?php }?>
                                    <?php for($i = 1; $i <= (5-$profileDetails->rating); $i++) {?>
                                        <span class="fa fa-star"></span>
                                    <?php }?>
                                    <!-- <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span> -->
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="info-right-column"><a href="<?php echo fullURLfront; ?>/Customer/customer_bookingform?iid=<?php echo base64_encode($profileDetails->IID); ?>&tp=<?php echo $data['type']; ?>">Book <i class="fa fa-book" aria-hidden="true"></i></a></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>