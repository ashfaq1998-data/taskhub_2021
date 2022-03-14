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
      <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

      <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_postad.css" rel="stylesheet" type="text/css"/>
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
            <?php include_once('views/Customer/customer_sidebar.php'); ?>
          </div>
          <div class="row">
            <div class="sub-column01">
              <img class="image-left" src="<?php echo fullURLfront; ?>/assets/images/newpostad.jpg" alt="image">
             
            </div>

            <div class="sub-column02">
              <div id="topic-area">Enter your Advertisement details below:</div>

              <div class="form-area">
                <form action="<?php echo fullURLfront; ?>/Customer/customer_postad" method="POST" autocomplete="off" enctype="multipart/form-data">
                  <input type="text" placeholder="Title of Advertisement" name="title" class="title">
                  <input type="E-mail" placeholder="Email" name="email" class="Email">
                  <input type="Address" placeholder="Address" name="address" class="address">
                  <input type="file" placeholder="" id="image" name="image" class="image" value="">
                  <input type="text" placeholder="District" name="district" class="district">
                  <input type="text" placeholder="Add Description" name="description" class="description">

                  <button type="reset" class="postad-cancel"><i class="fa fa-ban"></i> Cancel</button>
                  <button type="submit" name="postad-confirm" value="submitted" class="postad-confirm"><i class="fa fa-frown-o"></i> Confirm</button>
                </form>
                <br><br><br><br><br>
                <?php if(!empty($data['editError']) && $data['editError'] != "none") {?>
                  <p class="error"><?php echo $data['editError']; ?></p>
                <?php }else if($data['editError'] == "none"){?>
                  <p class="success">Your Advertisment has been Posted SuccessFully <i class="fa fa-check" aria-hidden="true"></i></p>
                <?php }?>
              </div>

            </div>

            
          </div>
        </div>
        <br>
        <?php include_once('footer.php'); ?>

      </div>

    </body>
  </html>
