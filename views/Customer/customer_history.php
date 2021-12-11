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
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_history.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Customer/customer_sidebar.php'); ?>
        </div>
        <div class="column2">
            <table>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Payment</th>
                    <th>Is_Job_Done</th>
                    <th>Job type</th>
                    <th>Service type</th>
                </tr>
                <tr>
                    <td>22/08/2020</td>
                    <td>Griffin</td>
                    <td>Colombo 05</td>
                    <td>$100</td>
                    <td>Yes</td>
                    <td>Plumbing</td>
                    <td>Employee</td>
                </tr>
                <tr>
                    <td>01/05/2019</td>
                    <td>Dean</td>
                    <td>Chilaw</td>
                    <td>$95</td>
                    <td>No</td>
                    <td>Electrical help</td>
                    <td>Employee</td>
                </tr>
                <tr>
                    <td>16/07/2020</td>
                    <td>David</td>
                    <td>Colombo 07</td>
                    <td>$250</td>
                    <td>Yes</td>
                    <td>Carpentry</td>
                    <td>Contractor</td>
                </tr>
                <tr>
                    <td>12/05/2020</td>
                    <td>Hailey</td>
                    <td>Galle</td>
                    <td>$400</td>
                    <td>No</td>
                    <td>Mason</td>
                    <td>Manpower agency</td>
                </tr>
            </table>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>

