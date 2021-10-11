<?php
// session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_help.css" rel="stylesheet" type="text/css"/>
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
            <div class = "faq">
                <h2>Frequently Asked Questions (FAQ)</h2>
            
                <button class="accordion">Are these service providers trustworthy?</button>
                    <div class="panel">
                        <p>Yes, of course. This is a platform which is full of reliable and customer friendly service providers...</p>
                    </div>

                <button class="accordion">How can I book a service provider?</button>
                    <div class="panel">
                        <p>You can book a service provider by simply <a id="click" href="<?php echo fullURLfront; ?>/Customer/customer_booking">clicking here</a></p>
                    </div>

                <button class="accordion">Are these service providers well-experienced??</button>
                    <div class="panel">
                        <p>Yes, most of them can be probably well-experienced ones. But there might be a few of them that not having much experience in the field.. Anyway, you can check there services, considering their rating & reviews..</p>
                    </div>
            </div>
            <div class="contact-section">
                <img src="<?php echo fullURLfront; ?>/assets/images/callback_image.png" alt="image">
                <div class="contact-section-form">
                    <form action="<?php echo fullURLfront; ?>/Customer/customer_help" method="POST">
                        <input type="text" id="name" name="name" placeholder="Name" required>

                        <input type="text" id="email" name="email" placeholder="Email" required>

                        <textarea id="message" name="message" placeholder="Write something.." style="height:200px"
                        required></textarea>

                        <div class = "Button-section">
                            <button type="reset" class="clearbutton">Clear</button> &nbsp &nbsp
                            <button type="submit" class="submitbutton">Request Help <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            } 
        });
    }
</script>
</html>