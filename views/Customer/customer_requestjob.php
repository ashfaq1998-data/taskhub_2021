<?php
session_start();
$page = $data['pagination']['page'];
$total_pages = $data['pagination']['total_pages'];
$num_results_on_page = $data['pagination']['results_count'];

$type = $data['filters']['type'];
$search = $data['filters']['search'];
$area = $data['filters']['area'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_requestjob.css" rel="stylesheet" type="text/css"/>
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
            <div class="search-container">
                <form action="<?php echo fullURLfront; ?>/Customer/customer_requestjob" method="POST">
                    <input type="text" placeholder="Search by subject" name="search" value="<?php echo (!empty($data['filters'])) ? $search : ''; ?>">
                    <button type="submit"><i class="fa fa-search"></i></button>
            </div>

            <div class="sortinglist">
                <div style="float: right;">
                    <label for="type">Choose the type:</label>
                    <select name="type" id="type">
                        <option value="3" <?php echo ($type == 3) ? 'selected' : ''; ?>>Employee</option>
                        <option value="4" <?php echo ($type == 4) ? 'selected' : ''; ?>>Manpower Agency</option>
                        <option value="5" <?php echo ($type == 5) ? 'selected' : ''; ?>>Contractor</option>
                    </select>
                </div>
                </form>
            </div>
        <br><br>
            
            <table class="request">
                <tr>
                    <th>Requested Date</th>
                    <th>Name</th>
                    <th>Rating</th>
                    <th>Subject of Advertisement</th>
                    <th>Published Date</th>
                    <th>Visiting Charge</th>
                    <th>District</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                
                <?php foreach($data['job_requests'] as $record) { 
                    $result = array();
                    if($type == 3){
                        $result = $data['employeeModel']->getEmployeeByUserID($record->RequestedBy);
                    }else if($type == 4){
                        $result = $data['ManpowerModel']->getManpowerByUserID($record->RequestedBy);
                    }else if($type == 5){
                        $result = $data['contractorModel']->getContractorByUserID($record->RequestedBy);
                    }
                    ?>
                    <tr>
                        <td><?php echo $record->RequestDate; ?></td>
                        <td>
                            <?php if(!empty($result->Company_Name)){
                                echo $result->Company_Name;
                            }else{
                                echo $result->FirstName . ' ' . $result->LastName;
                            } ?>
                        </td>
                        <td style="width: 150px;">
                            <?php for($i = 1; $i <= $result->rating; $i++) {?>
                                <span class="fa fa-star checked"></span>
                            <?php }?>
                            <?php for($i = 1; $i <= (5-$result->rating); $i++) {?>
                                <span class="fa fa-star un-checked"></span>
                            <?php }?>
                        </td>
                        <td><?php echo $record->Title; ?></td>
                        <td><?php echo $record->Date; ?></td>
                        <td><?php echo 'Rs. ' . $result->Payment_for_2hours; ?></td>
                        <td><?php echo $result->District; ?></td>
                        <td><?php echo $result->bio; ?></td>
                        <td><a href="<?php echo fullURLfront; ?>/Customer/customer_bookingform">Book <i class="fa fa-book" aria-hidden="true"></i></a></td>
                    </tr>
                <?php } ?>
                
            </table>

            <div>
                <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                    <ul class="pagination">
                        <?php if ($page > 1){ ?>
                        <li class="prev"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo $page-1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>">Prev</a></li>
                        <?php } ?>

                        <?php if ($page > 3){ ?>
                        <li class="start"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=1&type=<?php echo $type; ?>&search=<?php echo $search; ?>">1</a></li>
                        <li class="dots">...</li>
                        <?php } ?>

                        <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo $page-2 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>"><?php echo $page-2 ?></a></li><?php } ?>
                        <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo $page-1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>"><?php echo $page-1 ?></a></li><?php } ?>

                        <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo $page ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>"><?php echo $page ?></a></li>

                        <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo $page+1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>"><?php echo $page+1 ?></a></li><?php } ?>
                        <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo $page+2 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>"><?php echo $page+2 ?></a></li><?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo ceil($total_pages / $num_results_on_page) ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                        <?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                        <li class="next"><a href="<?php echo fullURLfront; ?>/Customer/customer_requestjob?page=<?php echo $page+1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>">Next</a></li>
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

