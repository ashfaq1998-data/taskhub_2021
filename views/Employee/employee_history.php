<?php
session_start();
$page = $data['pagination']['page'];
$total_pages = $data['pagination']['total_pages'];
$num_results_on_page = $data['pagination']['results_count'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/employee/employee_history.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Employee/employee_sidebar.php'); ?>
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
                <?php foreach($data['work_history'] as $record) { ?>
                    <tr>
                        <td><?php echo date("Y-m-d",strtotime($record->Date)); ?></td>
                        <td><?php echo $record->CusFullName; ?></td>
                        <td><?php echo $record->Address; ?></td>
                        <td><?php echo $record->payment; ?></td>
                        <td><?php echo $record->Is_work_done; ?></td>
                        <td><?php echo $record->Description; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <div>
                <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                <ul class="pagination">
                    <?php if ($page > 1){ ?>
                    <li class="prev"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo $page-1 ?>">Prev</a></li>
                    <?php } ?>

                    <?php if ($page > 3){ ?>
                    <li class="start"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=1">1</a></li>
                    <li class="dots">...</li>
                    <?php } ?>

                    <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php } ?>
                    <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php } ?>

                    <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                    <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php } ?>
                    <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                    <li class="dots">...</li>
                    <li class="end"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                    <?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                    <li class="next"><a href="<?php echo fullURLfront; ?>/Employee/employee_history?page=<?php echo $page+1 ?>">Next</a></li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
</html>

