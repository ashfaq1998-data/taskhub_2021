<?php
    session_start();
    $keyword = $data['filters']['keyword'];
    $ser_type = $data['filters']['ser_type'];
    $area = $data['filters']['area'];
    $emp_type = $data['filters']['emp_type'];

    $details = $data['results'];
    // $arrLength = count($details)-1;
    $err = $details['error'];
    echo $emp_type;
?>

<!DOCTYPE html>
<html>
<head>
<!-- <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_serviceList.css" rel="stylesheet" type="text/css"/>
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

                <div>
                    <div class="search-container">
                        <form action="<?php echo fullURLfront; ?>/Customer/customer_serviceList" method="get">
                            <input type="search" placeholder="Search for services, workers, contractors or manpower agencies" name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        <!-- </form> -->
                    </div>
                
                    <div class="sortinglist">
                        <div class="boxes">
                            <label for="ser" id="ser">Service type:</label>
                            <select name="service_type" id="service_type">
                                <option value="" value disabled selected>Service type</option>
                                <option value="plumb">Plumbing</option>
                                <option value="carpen">Carpentry</option>
                                <option value="elec">Electrical help</option>
                                <option value="mason">Mason</option>
                                <option value="paint">Painting</option>
                                <option value="gard">Gardening</option>
                            </select><br><br>

                            <label for="emp" id="emp">Employee type:</label>        
                            <select name="employee_type" id="employee_type" onchange="getSelectValue(this.value);" required>
                                <option value="" value disabled selected <?php echo ($emp_type=='') ? 'selected' : ''?> >Employee type</option>
                                <option value="manpower" <?php echo ($emp_type=='manpower') ? 'selected' : ''?> >Manpower Agency</option>
                                <option value="employee" <?php echo ($emp_type=='employee') ? 'selected' : ''?> >Employee</option>
                                <option value="contractor" <?php echo ($emp_type=='contractor') ? 'selected' : ''?> >Contractor</option>
                            </select><br><br>

                            <label for="area" id="area">Living area:</label>
                            <select name="location" id="location">
                                <option value="" value disabled selected>Location</option>
                                <option value="matara">Matara</option>
                                <option value="colombo">Colombo</option>
                                <option value="galle">Galle</option>
                                <option value="kandy">Kandy</option>
                            </select><br><br><br><br>
                        </div>
                        </form>
                    </div>
                </div>

            <?php
            if($err){ ?>
                <center><div style="position: relative; right: 80px; top: 140px;"><h1><?php echo($err); ?></h1>
                <img src="<?php echo fullURLfront; ?>/assets/images/sad.jpg" alt="image" style="position: relative; right: 10px;"></div></center>
            <?php }
            else{
                $count = 0;
                foreach($details as $i) { $count++; }
                $arrLength = $count-1;
            // foreach($details as $record) {   
            for ($i=0; $i<$arrLength; $i++) { ?>
            <div id="container">
  
                <!-- Start  Product details -->
                <div class="product-details">
                
                    <!--  Product Name -->
                    <h1><?php echo $details[$i]->FirstName; ?> <?php echo $details[$i]->LastName; ?></h1>
                    <!--    <span class="hint new">New</span> -->
                    <!--    <span class="hint free-shipping">Free Shipping</span> -->
                    <!--    the Product rating -->
                    <!-- <span class="hint-star star">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    </span> -->
                    <div class="rating">
                        <input type="radio" name="rating" value="1" aria-label="1 star" required>
                        <input type="radio" name="rating" value="2" aria-label="2 star">
                        <input type="radio" name="rating" value="3" aria-label="3 star">
                        <input type="radio" name="rating" value="4" aria-label="4 star">
                        <input type="radio" name="rating" value="5" aria-label="5 star">
                    </div>                
                
                    <!-- The most important information about the product -->
                    <p class="information"><?php echo $details[$i]->bio; ?> <br>
                    </p>
            
                
                
                    <!--    Control -->
                    <div class="control">
                        
                    <!-- Start Button buying -->
                        <button class="btn"><a id="close" href="<?php echo fullURLfront; ?>/Customer/customer_booking">
                    <!--    the Price -->
                        <span class="price"><?php echo $details[$i]->Payment_for_2hours; ?></span>
                    <!--    shopping cart icon-->
                        <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    <!--    Buy Now / ADD to Cart-->
                        <span class="book">Book Now</span></a>
                        </button>
                        <!-- End Button buying -->
                        
                    </div>
                    
                </div>
                
                <!--  End Product details   -->
                
                
                
                <!--  Start product image & Information -->
                
                <div class="product-image">
                    
                    <!-- <img src="<?php echo fullURLfront; ?>/assets/images/avril.jpeg" alt="image"> -->
                    <img src="data:image/jpg;base64,<?php echo base64_encode($details[$i]->image); ?>" alt="image" style="object-fit: contain;">
                    
                    <!--  product Information-->
                    <div class="info">
                        <h2>The Description</h2>
                        <ul>
                        <li><strong>From </strong>&nbsp&nbsp&nbsp&nbsp<?php echo $details[$i]->District; ?></li>
                        <li><strong>Service type </strong>&nbsp&nbsp&nbsp&nbsp<?php echo $details[$i]->Specialized_area; ?></li>
                        <li><strong>Employer type </stron>&nbsp&nbsp&nbsp&nbsp<?php echo ($emp_type=='manpower') ? 'Man-power' : ''?>
                        <?php echo ($emp_type=='employee') ? 'Employee' : ''?> <?php echo ($emp_type=='contractor') ? 'Contractor' : ''?></li>
                        <li><strong>Experience </strong>&nbsp&nbsp&nbsp&nbsp<?php echo $details[$i]->years_of_experience; ?> Years</li>
                        <li><strong>Contact Me </strong>&nbsp&nbsp&nbsp&nbsp<?php echo $details[$i]->Contact_No; ?></li>
                        </ul>
                    </div>
                </div>
                <!--  End product image  -->
            
            
            </div>

            <?php } } ?>
            </div>
        </div>
        <?php include_once('footer.php'); ?>
    </div>
    
    <!-- <script type="text/javascript">
        var actorType = <?php echo $emp_type; ?>;
        if(actorType == 'manpower'){
            $("#ser").hide();
            $("#service_type").hide();
        }else{
            $("#ser").show();
            $("#service_type").show();
        }

        function getSelectValue(type){
        if(type == 'manpower'){
            $("#ser").hide();
            $("#service_type").hide();
        }else{
            $("#ser").show();
            $("#service_type").show();
        }
    }
    </script> -->
</body>
</html>