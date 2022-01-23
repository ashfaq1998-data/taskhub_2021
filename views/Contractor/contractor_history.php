<?php
session_start();
$history=$data['HistoryEvents'];
$len=sizeof($history);

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_history.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
        </div>
        <div class="column2">
            <table>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Payment</th>
                    <th>Is_Job_Done</th>
                    <th>Description</th>
                </tr>
            
                <?php for($i=0;$i<$len;$i++) { ?>
                    <tr>
                        <td name="Date"><?php echo $history[$i]->Date; ?></td>
                        <td name="Name"><?php echo $history[$i]->CusFullName; ?></td>
                        <td name="Location"><?php echo $history[$i]->Address; ?></td>
                        <td name="payment"><?php echo $history[$i]->payment; ?></td>
                        <td name="Is_job_done"><?php echo $history[$i]->Is_work_done; ?></td>
                        <td name="Description"> <?php echo $history[$i]->title; ?></td>
                    </tr>
                <?php } ?>
            </table>
            
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>