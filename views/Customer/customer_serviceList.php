<?php
// session_start();
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
            <div id="container">  
  
                <!-- Start  Product details -->
                <div class="product-details">
                
                    <!--  Product Name -->
                    <h1>Avril Lavigne</h1>
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
                    <p class="information">" I have experience in plumbing for nearly 10 years.
                    Replacing washing machine and dryer machine Hoses, and pipe lines minimum charge 2 hours
                    Willing to give the best service. Best regards!! " <br>
                    </p>
            
                
                
                    <!--    Control -->
                    <div class="control">
                        
                    <!-- Start Button buying -->
                        <button class="btn"><a id="close" href="<?php echo fullURLfront; ?>/Customer/customer_booking">
                    <!--    the Price -->
                        <span class="price">60 $</span>
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
                    
                    <img src="<?php echo fullURLfront; ?>/assets/images/avril.jpeg" alt="image">
                    
                    <!--  product Information-->
                    <div class="info">
                        <h2>The Description</h2>
                        <ul>
                        <li><strong>From </strong>&nbsp&nbsp&nbsp&nbspColombo</li>
                        <li><strong>Service type </strong>&nbsp&nbsp&nbsp&nbspPlumbing</li>
                        <li><strong>Employer type </stron>&nbsp&nbsp&nbsp&nbspEmployee</li>
                        <li><strong>Experience </strong>&nbsp&nbsp&nbsp&nbsp2 Years</li>
                        <li><strong>Contact Me </strong>&nbsp&nbsp&nbsp&nbsp0717773445</li>
                        <li><strong>Reliability </strong>&nbsp&nbsp&nbsp&nbsp100%</li>
                        </ul>
                    </div>
                </div>
                <!--  End product image  -->
            
            
            </div>
        </div>
        <?php include_once('footer.php'); ?>
    </div>
</body>
</html>