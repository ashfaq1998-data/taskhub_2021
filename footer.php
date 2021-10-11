<?php ?>
<div class="footer-section">
    <div class="footer-section-summary">
        <h3><i class="fa fa-wrench fa-flip-horizontal" aria-hidden="true"></i> Task Hub</h3>
        <p>TaskHub is an online platform which is definitely a marketplace that we expect to build up to reduce the difficulties, the most of the people are having with their domestic repairing stuffs, these days specially</p>
        <br>
        <p>
            <i class="fa fa-google-plus" aria-hidden="true" style="margin-right: 10px;"></i>
            <i class="fa fa-facebook-official" aria-hidden="true" style="margin-right: 10px;"></i>
            <i class="fa fa-twitter" aria-hidden="true" style="margin-right: 10px;"></i>
            <i class="fa fa-instagram" aria-hidden="true"></i>
        </p>
    </div>
    <div class="footer-section-links">
        <h3>Task Hub Links</h3>
        <ul>
            <li><a href="<?php echo fullURLfront; ?>/main/index">Home</a></li>
            <li><a href="<?php echo fullURLfront; ?>/Customer/customer_dashboard" class="<?php echo (empty($_SESSION['loggedin'])) ? 'disabled-link' : ''; ?>">Dashboard</a></li>
            <li><a href="<?php echo fullURLfront; ?>/auth/login" class="<?php echo (!empty($_SESSION['loggedin'])) ? 'disabled-link' : ''; ?>">Login</a></li>
            <li><a href="<?php echo fullURLfront; ?>/main/index#about-us">About Us</a></li>
            <li><a href="<?php echo fullURLfront; ?>/main/index#contact-us">Contact Us</a></li>
        </ul>
    </div>
    <div class="footer-section-contact">
        <h3>Contact Us</h3>
        <p>
            +94 766553358<br>
            taskhub21@gmail.com
        </p>
    </div>
</div>