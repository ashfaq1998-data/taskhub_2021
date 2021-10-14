<!DOCTYPE html>
<html lang="en">
<head>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="<?php echo fullURLfront; ?> /assets/cs/contractor/contractor_paymentgateway.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div id="wrapper">

        <?php include_once('header.php'); ?>

        <div id ="chatbox">
            <form action="<?php echo fullURLfront; ?>/Contractor/contractor_paymentform">
                <div id ="subdiv1">Payment Gateway</div>
                <div id ="subdiv2">
                    <input type="text" id="username" class="input1" placeholder="Enter Username" >
                </div>
                <div id ="subdiv3">   
                    <input type="password" id="password" class="input2" placeholder="Enter password" >
                </div>
                <div id ="subdiv4">
                    <button class="confirmbutton" type="Submit">confirm</button>
                    <button class="confirmbutton">cancel</button>
                </div>
            </form>
            
        </div>
        <div id="bottom">
            <?php include_once('footer.php'); ?>
        </div>
    </div>
    

</body>
</html>