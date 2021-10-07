<!DOCTYPE html>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_postad.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>postadvertisement</title>
</head>
<body>
    <div class="pagewrapper">
        <?php include_once('header.php'); ?>

        <div class="row">
        <!--    <div class="column01">
                <?php include_once('views/contractor/contractor_sidebar.php'); ?>
            </div>-->
            <div class="column02">
                <div id="topdiv">post advertisement</div>
                    <div id ="advertisearea">
                        <form action="<?php echo fullURLfront; ?>/contractor/contractor_paymentgateway">
                        <input type="text" id="subjectid" name="subject" placeholder="Type subject">
                        <input type="text" id="typeareaid" name="typearea" placeholder="Type ypur Advertisement here">

                        <button id="uploadid" name="upload" >click here to upload image</button>

                        <button id ="save" name="savebtn" class="confirm" type="submit"   >Save</button>
                        <button id ="discard" name="discardbtn" class="confirm" type="submit">Discard</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="column03"> <?php include_once('footer.php');?> </div>
        </div>
      
    </div>

   
</body>
</html>