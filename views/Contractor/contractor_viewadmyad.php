<?php
session_start();
?>
<!DOCTYPE html>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

    

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_viewadmyads.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="page-wrapper">
            <?php include_once('header.php'); ?>

        <div class="row">
        <div class="column1">
            <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
        </div>
        <div class="column2">
            
            <div class="column2-top-row">
                See Your Past Advertisemnts Here
            </div>

            <div class="subrow">

            <div class="subcolumn1" style="background-color: #B4E1E7;">
                <div class ="adimage">
                    <img src="<?php echo fullURLfront; ?>/assets/images/pipe.jpg" alt="image1" width="180px" height="180px">
                </div> 
            </div>
            <div class="subcolumn2" style="background-color: #B4E1E7;">
                <div class="postedby">
                    <p class="special-field">Posted By:</p>
                    <p class="field">Name : James</p>
                    <p class="field">Email : abc@gmail.com</p>
                
                    <p class="field">Location : 36, Reid avenue, Colombo 3</p>
                </div>
            </div>
            <div class="subcolumn3" style="background-color: #B4E1E7;">
                <div class="details">
                    <p class="special-field">Task Description</p>
                    <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla bibendum justo condimentum, ullamcorper sapien sed, condimentum augue. Nullam non turpis vitae urna vestibulum dapibus. Duis scelerisque quis purus nec cursus.</p>
                </div>
            </div>

                <!-- <div class="scroll-btn">
                        <img class="arrows" src="<?php echo fullURLfront; ?>/assets/images/up-arrow.png">
                    </a>
                </div>
                <div class="topof-poster">
                    <div class="subrow-sub1-advertiser">
                        <p class="advertisername">Thisara Dilshan</p>
                        <p class="advertiseremail">thisarad582@gmail.com@gmail.com</p>
                    </div>
                    <div class="post-area">
                        <p class="description">I am looking for workers to work with me at "Thisarad Contractors". You should have a 
                    minimum 3 years experience in Masonary and Knowledge of working with machines. 
                        Should be close to matara area and knowledge on good Bathroom works is an additional qualification.</p>
                    </div>
                </div>
                <div class="Poster"><img class="posterimage" src="<?php echo fullURLfront; ?>/assets/images/viewad-photo.jpg"></div> -->

                <div class="poster-options-menu">
                    <a href="<?php echo fullURLfront; ?>/Contractor/contractor_myadedit">
                    <button id="editbtn">EDIT</button>
                    </a>
                    <button id="delbtn">DELETE</button>
                        
                    
                </div>

                <!-- <div class="scroll-btn">
                    <a href="#">
                        <img class="arrows" src="<?php echo fullURLfront; ?>/assets/images/down-arrow.jpg">
                    </a>
                </div> -->
            </div>
        </div>
    </body>
</html>