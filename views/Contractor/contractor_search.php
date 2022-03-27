<?php
session_start();
$page = $data['pagination']['page'];
$total_pages = $data['pagination']['total_pages'];
$num_results_on_page = $data['pagination']['results_count'];

$type = $data['filters']['type'];
$search = $data['filters']['search'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_search.css" rel="stylesheet" type="text/css"/>
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
        <div class="column2">
            <div class="search-container">
                <form action="<?php echo fullURLfront; ?>/Contractor/contractor_search" method="POST" id="filter" name="filter">
                    <input type="text" placeholder="Search" name="search" value="<?php echo (!empty($data['filters'])) ? $search : ''; ?>">
                    <button type="submit"><i class="fa fa-search"></i></button>
            </div>
            <div class="sortinglist">
                <div style="float: right;">

                    <label for="area">Choose the area:</label>
                    <select name="area" id="area" >
                        <option value="" <?php echo ($area == "") ? 'selected' : ''; ?>>Any</option>
                        <option value="colombo" <?php echo ($area == "colombo") ? 'selected' : ''; ?>>Colombo</option>
                        <option value="gampaha" <?php echo ($area == "gampaha") ? 'selected' : ''; ?>>Gampaha</option>
                        <option value="kaluthara" <?php echo ($area == "kaluthara") ? 'selected' : ''; ?>>Kaluthara</option>
                        <option value="galle" <?php echo ($area == "galle") ? 'selected' : ''; ?>>Galle</option>
                    </select>
                
                    <label for="type">Choose the type:</label>
                    <select name="type" id="type">
                        <option value="1" <?php echo ($type == 1) ? 'selected' : ''; ?>>Customer</option>
                        <option value="2" <?php echo ($type == 2) ? 'selected' : ''; ?>>Employee</option>
                        <option value="3" <?php echo ($type == 3) ? 'selected' : ''; ?>>Manpower</option>
                    </select>
                </div>
                </form>
            </div>
            <br>

            <?php foreach($data['profiles'] as $record) { ?>
                <div class="subrow">
                    <div class="subcolumn1">
                        <div class ="nameone">
                            <p><?php echo $record->ProfileFullName; ?></p>
                        </div>
                        <div class ="imageone">
                            <img src="data:image/jpg;base64,<?php echo base64_encode($record->image); ?>" alt="image1" width="100" height="100">
                        </div> 
                    </div>
                    <div class="subcolumn2">
                        <div class="Description">
                            <p>"<?php echo $record->bio; ?>"</p>
                        </div>
                    </div>
                    <div class="subcolumn3">
                        <a href="<?php echo fullURLfront; ?>/Contractor/contractor_view_profile?iid=<?php echo base64_encode($record->IID); ?>&tp=<?php echo $type ?>" class="view-profile-btn">View Profile</a>
                    </div>
                </div>
            <?php } ?>

            <div>
                <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                <ul class="pagination">
                    <?php if ($page > 1){ ?>
                    <li class="prev"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo $page-1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>">Prev</a></li>
                    <?php } ?>

                    <?php if ($page > 3){ ?>
                    <li class="start"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=1&type=<?php echo $type ?>&search=<?php echo $search ?>">1</a></li>
                    <li class="dots">...</li>
                    <?php } ?>

                    <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo $page-2 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page-2 ?></a></li><?php } ?>
                    <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo $page-1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page-1 ?></a></li><?php } ?>

                    <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo $page ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page ?></a></li>

                    <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo $page+1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page+1 ?></a></li><?php } ?>
                    <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo $page+2 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo $page+2 ?></a></li><?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                    <li class="dots">...</li>
                    <li class="end"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo ceil($total_pages / $num_results_on_page) ?>&type=<?php echo $type ?>&search=<?php echo $search ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                    <?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                    <li class="next"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_search?page=<?php echo $page+1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>">Next</a></li>
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