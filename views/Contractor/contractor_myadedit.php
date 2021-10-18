<!DOCTYPE html>
<html>
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
<div class="page-wrapper">
<?php include_once('header.php'); ?>

<div class="row">
    <div class="column1">
    <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
    </div>
    <div class="column2">
    <div id="topdiv">Post Advertisement</div>
        <div id ="advertisearea">
            <form action="<?php echo fullURLfront; ?>/Contractor/contractor_paymentform" method="post" required>
                <input type="text" id="subjectid" name="subject" placeholder="Type subject" >
                <input type="text" id="typeareaid" name="typearea" placeholder="Type your Advertisement Description here" required>

                <label for="file" class="label-input-file">
                    click here to upload photo
                    <input type="file" accept="image/*" class="custom-file-input" name="upload" >
                </label>
                    

                <button id ="save" name="savebtn" class="confirm" type="submit"   >Save</button>
                <button id ="discard" name="discardbtn" class="confirm" type="reset">Discard</button>
            </form>
        </div>
    </div>
    </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
