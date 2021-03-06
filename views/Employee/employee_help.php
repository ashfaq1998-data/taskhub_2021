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
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_help.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Employee/employee_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class = "faq">
                <h2>Frequently Asked Questions</h2>
            
                <button class="accordion">Will I recieve my payment on time <i class="fa fa-exclamation" aria-hidden="true"></i></button>
                    <div class="panel">
                        <p>Yes, Ofcourse. While you are registering, we request you the Bank name and Account Number. So within 2 hours we shall deposit your amount. If further you didn't recieve in our promise time, you can contact us</p>
                    </div>

                <button class="accordion">Can we apply for the job if we are specialized in many section<i class="fa fa-exclamation" aria-hidden="true"></i></button>
                    <div class="panel">
                        <p>Yes, but we prefer you to register with the skill that you are more specialized. But under your bio section, you need to put all necessary skills additonally you have so the customers and other parties for you to hire</p>
                    </div>

                <button class="accordion">How do i know whether customers hired me? <i class="fa fa-exclamation" aria-hidden="true"></i></button>
                    <div class="panel">
                        <p>In your sidebar, you can see the booking tab.In that calender, you can see details of customers you need to visit. And also you can request for the job under view advertisement tab in sidebar</p>
                    </div>
            </div>
            <div class="contact-section">
                <img src="<?php echo fullURLfront; ?>/assets/images/callback_image.png" alt="image">
                <div class="contact-section-form">
                    <form action="<?php echo fullURLfront; ?>/Employee/employee_help" method="POST">
                        

                        <input type="text" id="subject" name="subject" placeholder="Subject">

                        <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

                        <div class = "Button-section">
                            <button type="reset" class="clearbutton">Clear</button>
                            <button type="submit" name="employee_help" value="submitted" class="btn-submit">Request Help <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </form>
                    <br><br>
                    <?php if(!empty($data['HelpError']) && $data['HelpError'] != "none") {?>
                        <p class="error"><?php echo $data['HelpError']; ?></p>
                    <?php }else if($data['HelpError'] == "none"){?>
                        <p class="success">Your Help Request Submitted <i class="fa fa-check" aria-hidden="true"></i></p>
                    <?php }?>
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