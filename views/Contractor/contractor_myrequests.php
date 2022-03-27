<?php
session_start();
$page = $data['pagination']['page'];
$total_pages = $data['pagination']['total_pages'];
$num_results_on_page = $data['pagination']['results_count'];
$type = $data['filters']['type'];

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_myrequests.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
</head>
<body onload="onLoadSubmit()">
<div class="page-wrapper">
    <?php include_once('header.php'); ?>
    <div class="row">
        <div class="column1">
            <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
        </div>
        <div class="search-container">
            <form action="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests" method="POST" id="filter" name="filter">
                <br>
                <button type="submit" style="float:right"><i class="fa fa-search"></i></button>
        </div>
        <div class="sortinglist">
            <div style="float: right;">
                <label for="type" style="font-family: Poppins;font-style: normal;font-size: 18px;color: #108882;">Choose the type:</label>
                    <select name="type" id="type" style="background: #108882; color: white;width: 187px;height: 38px;border-radius: 5px;">
                        <option value="1" <?php echo ($type == 1) ? 'selected' : ''; ?>>Customer</option>
                        <option value="2" <?php echo ($type == 2) ? 'selected' : ''; ?>>Manpower</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="column2">
            <table>
                <tr>
                    <th>Request ID</th>
                    <th>Advertisement ID</th>
                    <th>Request date</th>
                </tr>

                <?php foreach($data['my_requests'] as $record) { ?>
                    <tr>
                        
                        <td><?php echo $record->requestID; ?></td>
                        <td><?php echo $record->AdvertisementID; ?></td>
                        <td><?php echo $record->RequestDate; ?></td>
                    
                    </tr>
                <?php } ?>
            </table>
        

        </div>    
        <div>
                <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                <ul class="pagination">
                    <?php if ($page > 1){ ?>
                    <li class="prev"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=<?php echo $page-1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>">Prev</a></li>
                    <?php } ?>

                    <?php if ($page > 3){ ?>
                    <li class="start"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=1&type=<?php echo $type ?>&search=<?php echo $search ?>">1</a></li>
                    <li class="dots">...</li>
                    <?php } ?>

                    <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=<?php echo $page-2 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page-2 ?></a></li><?php } ?>
                    <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=<?php echo $page-1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page-1 ?></a></li><?php } ?>

                    <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=<?php echo $page ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page ?></a></li>

                    <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=<?php echo $page+1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page+1 ?></a></li><?php } ?>
                    <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=<?php echo $page+2 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page+2 ?></a></li><?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                    <li class="dots">...</li>
                    <li class="end"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_myrequests?page=<?php echo ceil($total_pages / $num_results_on_page) ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                    <?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                    <li class="next"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_requests?page=<?php echo $page+1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>">Next</a></li>
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