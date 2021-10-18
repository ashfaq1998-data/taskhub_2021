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
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_search.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="search by keyword....." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>

            </div>

            <div class="subrow">
                
            <div class="filters-row">
            <form action="/action_page.php" id="formdesign">
                <label for="area" id="label-of-list">Area</label>
                <select name="area" id="area" >
                    <option value="colombo">Colombo</option>
                    <option value="gampaha">Gampaha</option>
                    <option value="kaluthara">Kaluthara</option>
                    <option value="galle">Galle</option>
                </select>

                <label for="type" id="label-of-list">Type</label>
                <select name="type" id="type">
                    <option value="manpower">Manpower Agency</option>
                    <option value="customer">Customer</option>
                    <option value="contractor">Employee</option>
                </select>
            </form>
            </div>
                <div class="subcolumn1">
                    <div class ="nameone">
                    
                    </div>
                    <div class ="imageone">
                        <img src="<?php echo fullURLfront; ?>/assets/images/freeman-search-customer.jfif" height="100" width="100">
                    </div> 
                </div>
                <div class="subcolumn2">
                    <p id="person-name"> Morgan Freeman</p>
                    <p>freemanmorgan@gmail.com</p> 
                    <p>0705461789</P>
                    <p>Monaragala</p>
                    
                </div>
                <div class="subcolumn3">
                    <p>Rate</p>
                    
                    <a href="" class="view-profile-btn">View Profile</a>
                </div>
            </div>


            <div class="subrow">
                <div class="subcolumn1">
                    <div class ="nameone">
                    
                    </div>
                    <div class ="imageone">
                        <img src="<?php echo fullURLfront; ?>/assets/images/freeman-search-customer.jfif" height="100" width="100">
                    </div> 
                </div>
                <div class="subcolumn2">
                    <p id="person-name"> Morgan Freeman</p>
                    <p>freemanmorgan@gmail.com</p> 
                    <p>0705461789</P>
                    <p>Monaragala</p>
                    
                </div>
                <div class="subcolumn3">
                    <p>Rate</p>
                    
                    <a href="" class="view-profile-btn">View Profile</a>
                </div>
            </div>

            <div class="subrow">
                <div class="subcolumn1">
                    <div class ="nameone">
                    
                    </div>
                    <div class ="imageone">
                        <img src="<?php echo fullURLfront; ?>/assets/images/freeman-search-customer.jfif" height="100" width="100">
                    </div> 
                </div>
                <div class="subcolumn2">
                    <p id="person-name"> Morgan Freeman</p>
                    <p>freemanmorgan@gmail.com</p> 
                    <p>0705461789</P>
                    <p>Monaragala</p>
                    
                </div>
                <div class="subcolumn3">
                    <p>Rate</p>
                    
                    <a href="" class="view-profile-btn">View Profile</a>
                </div>
            </div>

            <div class= "bottom-row">
                <p style="margin-left:400px;font-weight:bold; color:red">see more >></p>
                <!--  <p style="margin-top:50px;font-weight:bold;color:blueviolet "> <<<< Go to my favourites list >>></p> -->
                <button type="button" class="favorite-btn" >my favourites</button>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>