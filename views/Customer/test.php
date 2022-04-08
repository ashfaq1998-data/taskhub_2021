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
        <div style="position: relative;">
        <!-- <form action="<?php echo fullURLfront; ?>/Customer/customer_test" method="POST">
            <h1>Test</h1>
            <input type="text" name="name" placeholder="Search" style="width: 20%; padding: 20px;"><br>
            <select name="select" id="select" style="width: 20%; padding: 0px; text-align:center;">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select><br><br>

            <button type="submit" value="submitted" name="search">Search</button>
        </form>
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
        </table> -->
        
        <form action="<?php echo fullURLfront; ?>/Customer/customer_test" method="POST">
            <h1>Test</h1>
            <input type="text" name="name" placeholder="Name" style="width: 20%; padding: 20px;"><br>
            <select name="select" id="select" style="width: 20%; padding: 0px; text-align:center;">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select><br><br>

            <button type="submit" value="submitted" name="search">Search</button>
        </form>

             
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>    
</body>
</html>