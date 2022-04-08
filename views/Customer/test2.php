<?php
    session_start();
    $dat = $data['results'];
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
    <link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_profileEd.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Customer/customer_sidebar.php'); ?>
        </div>
        <div>
            <form action="<?php echo fullURLfront; ?>/Customer/customer_test" method="POST">
            <button type="submit" name="search" value="submitted">Search</button></form>
        </div>

        <div style="position: relative;">
        <table style="border-spacing: 30px;">
        <tr>
            <th>Name</th>
            <th>Gradee</th>
        </tr>
        <?php foreach($dat as $i) {?>
        <tr>
            <td><?php echo $i->Name?></td>
            <td><?php echo $i->Grade?></td>
        </tr><?php }?>
        </table>
             
        </div>

        <!-- <div style="position: relative;">
        <table style="border-spacing: 30px;">
        <tr>
            <th>Payment ID</th>
            <th>Expire</th>
            <th>Payment</th>
        </tr>
        <?php foreach($dat as $i) {?>
        <tr>
            <td><?php echo $i->paymentID?></td>
            <td><?php echo $i->expirydate?></td>
            <td><?php echo $i->payment?></td>
        </tr><?php }?> 
        </table>
             
        </div> -->
    </div>
    <?php include_once('footer.php'); ?>
</div>    
</body>
</html>