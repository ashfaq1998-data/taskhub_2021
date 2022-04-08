<?php
    session_start();

    $ad = $data['ad_details'];
    $arrLength = count($ad);
    $err = $ad['error'];

    $num_per_page = 03;
    $num_rows = $ad['num_rows'];
    $total_pages = ceil($num_rows/$num_per_page);

    if(isset($_GET["page"])){
        $page = $_GET["page"];
        $i = $page*$num_per_page - $num_per_page;
    }
    else{
        $page = 1;
        $i = $page*$num_per_page - $num_per_page;
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
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_viewmyad.css" rel="stylesheet" type="text/css"/>
<!-- <link href="<?php echo fullURLfront; ?>/assets/cs/employee/additional_viewad.css" rel="stylesheet" type="text/css"/> -->
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
        <div class="search-container">
            <!-- <form action="/action_page.php">
                <input type="search" placeholder="Search advertisement by title" name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form> -->
        </div>
       
        <br><br>      
        <?php
            if($err){ ?>
                <center><div style="position: relative; right: 80px; top: 140px;"><h1><?php echo($err); ?></h1>
                <img src="<?php echo fullURLfront; ?>/assets/images/sad.jpg" alt="image" style="position: relative; right: 10px;"></div></center>
            <?php }
            else {
            //echo($page);
            $arrLength = $page*$num_per_page;
            while ($i<$arrLength && $i<$num_rows) { ?>
                <div class="subrow" id="loop">
                    <div class="subcolumn1">
                        <div class ="adimage">
                            <img src="data:image/jpg;base64,<?php echo base64_encode($ad[$i]->images); ?>" alt="image1" width="180px" height="180px" object-fit: fill;>
                        </div> 
                    </div>
                    <div class="subcolumn2">
                        <div class="postedby">
                            <p style="font-family: Poppins; font-style: normal; font-weight: 500; font-size: 18px; line-height: 27px; color:#108882;">Posted By:</p>
                            <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Title : <?php echo $ad[$i]->Title; ?></p>
                            <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Email : <?php echo $_SESSION['loggedin']['email']; ?></p>
                            <!-- <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Start from : LKR 5000</p> -->
                            <p style="font-family: Roboto; font-style: normal; font-weight: 500; font-size: 18px; line-height: 21px; color:#61687F;">Location : <?php echo $ad[$i]->City; ?></p>
                        </div>
                    </div>
                    <div class="subcolumn3">
                        <div class="details">
                            <p style="font-family: Poppins; font-style: normal; font-weight: 500; font-size: 18px; line-height: 27px; color:#108882;">Service Description</p>
                            <p style="color:#61687F; font-family: Roboto; font-style: normal; font-size: 18px; line-height: 21px; ">
                            <?php echo $ad[$i]->Description; ?></p>
                        </div>
                    </div>
                    <!-- <div class="view">
                        <button style="float: right;" type="submit" class="proceed"> <a style="color: black;"
                        href="<?php echo fullURLfront; ?>/Customer/customer_viewmyad">Delete Ad</a></button>
                    </div> -->


                    <!-- newly added... -->
                    <div class="view">
                        <form action="<?php echo fullURLfront; ?>/Customer/customer_viewmyadDeleted"style="float: right;" method="POST"> 
                        <button type="submit" class="proceed" name="submit" value="<?php echo $ad[$i]->AdvertisementID; ?>" style="color: black;">Delete Ad</button></form>
                    </div>
                </div>

                <?php $i++;
            }

            for($i=1; $i<=$total_pages; $i++){ ?>
                <a href="<?php echo fullURLfront; ?>/Customer/customer_viewmyad?page= <?php echo $i ?>"> <?php echo $i ?> </a>
            <?php } } ?>

   </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
