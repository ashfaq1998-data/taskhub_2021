<?php
session_start();
?>
    <!DOCTYPE html> 
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task Hub</title>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/homepage.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <!-- END HEAD -->
        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>
                <div class="intro-section">
                    <div class="intro-section-content">
                        <p class="intro-section-header">Online platform connecting customers with local freelancers, manpower agencies and contractors</p>
                        <p class="intro-section-hint">Find help with day to day tasks with just few clicks</p> 
                        <a href="#">GET STARTED</a>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/intro.png" alt="image">
                </div>
                <div class="services-section" id="about-us">
                    <div class="wave">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                        </svg>
                    </div>
                    <div class="services-section-upper">
                        <h2>Welcome to Task Hub</h2><hr>
                        <img src="<?php echo fullURLfront; ?>/assets/images/services.png" alt="image">
                        <ul>
                            <li>Matching freelance labors, manpower agencies and contractors with inland customers.</li><br>
                            <li>Customers can find immediate help with day to day tasks.</li><br>
                            <li>Choose your tasker by reviews, skills and price.</li><br>
                            <li>Chat, pay, tip and review all through one platform.</li>
                        </ul>
                    </div>
                </div>
                <div class="services-section-lower">
                    <div class="services-section-lower-header">
                        <h1>Our Services</h1><hr>
                    </div>
                    <div class="services-section-lower-cards">
                        <div class="services-card">
                            <img src="<?php echo fullURLfront; ?>/assets/images/electrician.png" alt="John" style="width:50%">
                            <h1>Electrician</h1>
                        </div>
                        <div class="services-card">
                            <img src="<?php echo fullURLfront; ?>/assets/images/plumber.png" alt="John" style="width:50%">
                            <h1>Plumber</h1>
                        </div>
                        <div class="services-card">
                            <img src="<?php echo fullURLfront; ?>/assets/images/carpenter.png" alt="John" style="width:50%">
                            <h1>Carpenter</h1>
                        </div>
                        <div class="services-card">
                            <img src="<?php echo fullURLfront; ?>/assets/images/gardener.png" alt="John" style="width:50%">
                            <h1>Gardener</h1>
                        </div>
                        <div class="services-card">
                            <img src="<?php echo fullURLfront; ?>/assets/images/cleaner.png" alt="John" style="width:50%">
                            <h1>Cleaner</h1>
                        </div>
                    </div>
                </div>
                <div class="clients-section">
                    <div class="wave">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                        </svg>
                    </div>
                    <div class="clients-section-header">
                        <h1><i class="fa fa-quote-left fa-3x" aria-hidden="true"></i>&emsp; Our Awesome Clients</h1><hr>
                    </div>
                    <div class="clients-section-slideshow">
                        <div class="slideshow-container">
                            <div class="mySlides fade">
                                <img src="<?php echo fullURLfront; ?>/assets/images/feedback1.png" style="width:100%">
                            </div>
                            <div class="mySlides fade">
                                <img src="<?php echo fullURLfront; ?>/assets/images/feedback2.JPG" style="width:100%">
                            </div>
                            <div class="mySlides fade">
                                <img src="<?php echo fullURLfront; ?>/assets/images/feeback3.JPG" style="width:100%">
                            </div>
                        </div>
                        <br>
                        <div style="text-align:center">
                            <span class="dot"></span> 
                            <span class="dot"></span> 
                            <span class="dot"></span> 
                        </div>
                    </div>
                </div>
                <div class="signup-section">
                    <div class="white-inverted-wave">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                        </svg>
                    </div>
                    <h1>Sign up based on your role!</h1>
                    <div class="signup-section-options">
                        <div class="signup-box border-right">
                            <p>I need a help with a service</p>
                            <img src="<?php echo fullURLfront; ?>/assets/images/Frame-2.png" style="width:60%; height:55%;">
                            <br><br><a href="<?php echo fullURLfront; ?>/auth/customer_register" class="signup-button">Sign Up</a>
                        </div>
                        <div class="signup-box border-right">
                            <p>I am a tasker who<br>provides services</p>
                            <img src="<?php echo fullURLfront; ?>/assets/images/Frame.png" alt="John" style="width:70%; height:50%;">
                            <br><br><a href="<?php echo fullURLfront; ?>/auth/employee_register" class="signup-button">Sign Up</a>
                        </div>
                        <div class="signup-box border-right">
                            <p>I am a Contractor</p>
                            <img src="<?php echo fullURLfront; ?>/assets/images/Frame-2.png" alt="John" style="width:60%; height:55%;">
                            <br><br><a href="#" class="signup-button">Sign Up</a>
                        </div>
                        <div class="signup-box">
                            <p>I am a Man Power Agency</p>
                            <img src="<?php echo fullURLfront; ?>/assets/images/Frame.png" alt="John" style="width:60%; height:55%;">
                            <br><br><a href="#" class="signup-button">Sign Up</a>
                        </div>
                    </div>
                </div>
                <div class="contact-section" id="contact-us">
                    <div class="wave">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                        </svg>
                    </div>
                    <img src="<?php echo fullURLfront; ?>/assets/images/callback_image.png" alt="image">
                    <div class="contact-section-form">
                        <form action="action_page.php">
                            <input type="text" id="name" name="name" placeholder="Name">

                            <input type="text" id="email" name="email" placeholder="Email">

                            <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

                            <button type="submit">Send Message <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
                <?php include_once('footer.php'); ?>
            </div>
            <script>
                var slideIndex = 0;
                showSlides();

                function showSlides() {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";  
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}    
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";  
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 5000); // Change image every 2 seconds
                }
            </script>
        </body>
    </html>