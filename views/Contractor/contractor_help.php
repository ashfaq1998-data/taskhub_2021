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
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_help.css" rel="stylesheet" type="text/css"/>
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
            <div class = "faq">
                <h2>Frequently Asked Questions</h2>
            
                <button class="accordion">Help 1</button>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                <button class="accordion">Help 2</button>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                <button class="accordion">Help 3</button>
                    <div class="panel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
            </div>
            <div class="contact-section">
                <img src="<?php echo fullURLfront; ?>/assets/images/callback_image.png" alt="image">
                <div class="contact-section-form">
                    <form action="<?php echo fullURLfront; ?>/Contractor/contractor_help" method="POST">
                        

                        <input type="text" id="subject" name="subject" placeholder="Subject">

                        <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

                        <div class = "Button-section">
                            <button type="reset" class="clearbutton">Clear</button>
                            <button type="submit" name="contractor_help" value="submitted" class="btn-submit">Request Help <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
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