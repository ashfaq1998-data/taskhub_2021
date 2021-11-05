<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_search.css" rel="stylesheet" type="text/css"/>
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
            <div class ="nameone" >
                <p>Worker List</p>
            </div>
            <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            

            <div class="subrow">
                <div class="subcolumn1">
                    <div class ="nameone">
                        <p>John Smith<p>
                    </div>
                    <!-- <div class ="imageone">
                        <img src="<?php echo fullURLfront; ?>/assets/images/plumber.png" alt="image1" width="100" height="100">
                    </div>  -->
                </div>
                <div class="subcolumn2">
                    <div class="Description">
                        <p>Number Of Jobs - </p>
                        <p>Job Type - </p>
                    </div>
                    <div class="Description">
                        
                    </div>
                </div>
                <div class="subcolumn3">
                     <a href="" class="view-profile-btn">View Profile</a>
                </div>

                <div class="subcolumn1">
                    <div class ="nameone">
                        <p>John Smith<p>
                    </div>
                    <!-- <div class ="imageone">
                        <img src="<?php echo fullURLfront; ?>/assets/images/plumber.png" alt="image1" width="100" height="100">
                    </div>  -->
                </div>
                <div class="subcolumn2">
                    <div class="Description">
                        <p>Number Of Jobs - </p>
                        <p>Job Type - </p>
                    </div>
                    <div class="Description">
                        
                    </div>
                </div>
                <div class="subcolumn3">
                     <a href="" class="view-profile-btn">View Profile</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>