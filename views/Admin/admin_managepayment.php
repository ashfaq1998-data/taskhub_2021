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
<link href="<?php echo fullURLfront; ?>/assets/cs/admin/admin_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/admin/admin_managepayment.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Admin/admin_sidebar.php'); ?>
        </div>
        <div class="column2">
            <div class="search-container">
                <form action="<?php echo fullURLfront; ?>/Admin/admin_managepayment" method="POST">
                    <input type="text" placeholder="Search advertisement by Subject" name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
            </div>

            <div class="sortinglist">
                <div style="float: right;">
                    <label for="type">Choose the type:</label>
                    <select name="type" id="type">
                        <option value="1">Customer</option>
                        <option value="2">Manpower Agency</option>
                        <option value="3">Contractor</option>
                    </select>
                </div>
                </form>
            </div>
        <br><br>
            



            <table class="payment">
                <tr>
                    <th>Date</th>
                    <th>Name of Payer</th>
                    <th>Name of Payee</th>
                    <th>Reason of payment</th>
                    <th>Amount paid</th>
                    <th>Action</th>

                </tr>
                
                <tr>
                    <td>29/9/2020</td>
                    <td>Umar</td>
                    <td>Ammar</td>
                    <td>Posted advertisement</td>
                    <td>Rs 1000</td>
                    <td><a href="#">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>

                </tr>
                
            </table>
            
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>

