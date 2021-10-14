<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_viewad.css" rel="stylesheet" type="text/css"/>
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
        <div class="search-container">
            <form action="/action_page.php">
                <input type="text" placeholder="Search advertisement by title" name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="sortinglist">
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
        <br><br>
        <div class="updownbutton"><button type="back" ><img id="uparrow" src="<?php echo fullURLfront; ?>/assets/images/up-arrow.png"></button>
        </div>
        <div class="subrow">
        
            <div class="subrow-sub1-advertiser">
                <p class="advertisername">Alan Border</p>
                <p class="advertiseremail">AllanBorder@gmail.com</p>
            </div>
            <div>
                <p class="description">Hii!! I am a doctor who is looking for contractors to build my new 2stored house in
                    Thalawathugoda. Ineed skilled contractors to complete my house. Call me after between 8.00 am and 5 am</p>
            </div>
            <div class="Poster"><img class="posterimage" src="<?php echo fullURLfront; ?>/assets/images/viewad-photo.jpg"></div>
        </div>
        <div class="updownbutton"><button type="back" ><img id="downarrow" src="<?php echo fullURLfront; ?>/assets/images/down-arrow.jpg"></button>
        </div>
   </div>
</div>
<br>
<?php include_once('footer.php'); ?>
</div>

</body>
</html>
