<?php
session_start();
$page = $data['pagination']['page'];
$total_pages = $data['pagination']['total_pages'];
$num_results_on_page = $data['pagination']['results_count'];

$type = $data['filters']['type'];
$search = $data['filters']['search'];
$area = $data['filters']['area'];
$role = $data['filters']['role'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/customer/customer_service.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
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
                <form action="<?php echo fullURLfront; ?>/Customer/customer_services" method="POST" id="filter" name="filter">
                    <input type="text" placeholder="Search" name="search" value="<?php echo (!empty($data['filters'])) ? $search : ''; ?>">
                    <button type="submit"><i class="fa fa-search"></i></button>
            </div>
            <div class="sortinglist">
                <div style="float: right;">
                    <label for="type">Choose the type:</label>
                    <select name="type" id="type" onchange="getSelectValue(this.value);">
                        <option value="1" <?php echo ($type == 1) ? 'selected' : ''; ?>>Employee</option>
                        <option value="2" <?php echo ($type == 2) ? 'selected' : ''; ?>>Manpower Agency</option>
                        <option value="3" <?php echo ($type == 3) ? 'selected' : ''; ?>>Contractor</option>
                    </select>

                    <label for="area">Choose the area:</label>
                    <select name="area" id="area" >
                        <option value="" <?php echo ($area == "") ? 'selected' : ''; ?>>Any</option>
                        <option value="colombo" <?php echo ($area == "colombo") ? 'selected' : ''; ?>>Colombo</option>
                        <option value="gampaha" <?php echo ($area == "gampaha") ? 'selected' : ''; ?>>Gampaha</option>
                        <option value="kaluthara" <?php echo ($area == "kaluthara") ? 'selected' : ''; ?>>Kaluthara</option>
                        <option value="galle" <?php echo ($area == "galle") ? 'selected' : ''; ?>>Galle</option>
                    </select>

                    <label for="role" id="role1">Choose the job role:</label>
                    <select name="role" id="role" >
                        <option value="" <?php echo ($role == "") ? 'selected' : ''; ?>>Any</option>
                        <option value="plumbing" <?php echo ($role == "plumbing") ? 'selected' : ''; ?>>Plumbing</option>
                        <option value="carpentry" <?php echo ($role == "carpentry") ? 'selected' : ''; ?>>Carpentry</option>
                        <option value="electrical" <?php echo ($role == "electrical") ? 'selected' : ''; ?>>Electrical</option>
                        <option value="mason" <?php echo ($role == "mason") ? 'selected' : ''; ?>>Mason</option>
                        <option value="painting" <?php echo ($role == "painting") ? 'selected' : ''; ?>>Painting</option>
                        <option value="gardening" <?php echo ($role == "gardening") ? 'selected' : ''; ?>>Gardening</option>
                    </select>

                </div>
                </form>
            </div>
            <br>

            <?php if(!empty($data['response'])) {?>
                <!-- The Modal -->
                <div class="modal">
                <!-- Modal content -->
                    <div class="modal-content">
                        <p><?php echo $data['response']; ?> <i class="fa fa-check" aria-hidden="true"></i></p>
                    </div>
                </div>
            <?php } ?>

            <?php if(empty($data['response'])) {?>
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
                            <a href="<?php echo fullURLfront; ?>/Customer/customer_view_profile?iid=<?php echo base64_encode($record->IID); ?>&tp=<?php echo $type ?>" class="view-profile-btn">View Profile</a>
                        </div>
                    </div>
                <?php } ?>

                <div>
                    <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                    <ul class="pagination">
                        <?php if ($page > 1){ ?>
                        <li class="prev"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo $page-1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>">Prev</a></li>
                        <?php } ?>

                        <?php if ($page > 3){ ?>
                        <li class="start"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=1&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>">1</a></li>
                        <li class="dots">...</li>
                        <?php } ?>

                        <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo $page-2 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>"><?php echo $page-2 ?></a></li><?php } ?>
                        <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo $page-1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>"><?php echo $page-1 ?></a></li><?php } ?>

                        <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo $page ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>"><?php echo $page ?></a></li>

                        <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo $page+1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>"><?php echo $page+1 ?></a></li><?php } ?>
                        <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo $page+2 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>"><?php echo $page+2 ?></a></li><?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo ceil($total_pages / $num_results_on_page) ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                        <?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                        <li class="next"><a href="<?php echo fullURLfront; ?>/Customer/customer_services?page=<?php echo $page+1 ?>&type=<?php echo $type ?>&search=<?php echo $search ?>&area=<?php echo $area; ?>&role=<?php echo $role; ?>">Next</a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
<script type="text/javascript">
    var data = '<?php echo $data['response']; ?>';
    if(data != ''){
        setTimeout(function(){
            window.location.href = "<?php echo fullURLfront; ?>/Customer/customer_services";
         }, 2000);
    }
    
    var actorType = <?php echo $type; ?>;
    if(actorType == 2){
        $("#role1").hide();
        $("#role").hide();
    }else{
        $("#role1").show();
        $("#role").show();
    }
    
    function getSelectValue(type){
        if(type == 2){
            $("#role1").hide();
            $("#role").hide();
        }else{
            $("#role1").show();
            $("#role").show();
        }
    }
</script>
</body>
</html>