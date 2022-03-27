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
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_viewad.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>

</head>
<body>
<div class="page-wrapper">
<?php include_once('header.php'); ?>

<div class="row">
   <div class="column1">
    <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
  </div>
  <div class="column2">
        <div class="search-container">
            <form action="<?php echo fullURLfront; ?>/Contractor/contractor_viewad" method="POST" id="filter">
                <input type="text" placeholder="Search advertisement by title" name="search" id="search" value="<?php echo (!empty($data['filters'])) ? $search : ''; ?>">
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
                    <option value="2" <?php echo ($type == 2) ? 'selected' : ''; ?>>Manpower</option>
                </select>
            </div>
            </form>
        </div>
        <br><br><br>
        <div class="viewmyad">
            <a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad">View My Ads <i class="fa fa-eye" aria-hidden="true"></i></a>
        </div>

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
            <?php foreach($data['advertisements'] as $record) { ?>
            <div class="subrow">
                <div class="subcolumn1" style="background-color: #B4E1E7;">
                    <span class="ad-title"><?php echo $record->Title; ?></span>
                    <div class ="adimage">
                        <img src="data:image/jpg;base64,<?php echo base64_encode($record->images); ?>" alt="image" width="190px" height="190px">
                    </div> 
                </div>
                <div class="subcolumn2" style="background-color: #B4E1E7;">
                    <div class="postedby">
                        <p class="special-field">Posted By:</p>
                        <p class="field">Name : <?php echo $record->CusFullName; ?></p>
                        <p class="field">Email : <?php echo $record->Email; ?></p>
                        <p class="field">Location : <?php echo $record->Address; ?></p>
                        <p class="field">Date : <?php echo $record->Date; ?></p>
                    </div>
                </div>
                <div class="subcolumn3" style="background-color: #B4E1E7;">
                    <div class="details">
                        <p class="special-field">Task Description</p>
                        <p class="description"><?php echo $record->Description; ?></p><br>
                        <a href="<?php echo fullURLfront; ?>/Contractor/contractor_job_apply?ad=<?php echo base64_encode($record->AdvertisementID); ?>&tp=<?php echo $type; ?>" class="request-btn" >Request Job</a>
                    </div>
                </div>        
            </div><br><br>
            <?php } ?>

        

            <div>
                <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                <ul class="pagination">
                        <?php if ($page > 1){ ?>
                        <li class="prev"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo $page-1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>">Prev</a></li>
                        <?php } ?>

                        <?php if ($page > 3){ ?>
                        <li class="start"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=1&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>">1</a></li>
                        <li class="dots">...</li>
                        <?php } ?>

                        <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo $page-2 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>"><?php echo $page-2 ?></a></li><?php } ?>
                        <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo $page-1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>"><?php echo $page-1 ?></a></li><?php } ?>

                        <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo $page ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>"><?php echo $page ?></a></li>

                        <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo $page+1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>"><?php echo $page+1 ?></a></li><?php } ?>
                        <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo $page+2 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>"><?php echo $page+2 ?></a></li><?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo ceil($total_pages / $num_results_on_page) ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                        <?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                        <li class="next"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewad?page=<?php echo $page+1 ?>&type=<?php echo $type; ?>&search=<?php echo $search; ?>&area=<?php echo $area; ?>">Next</a></li>
                        <?php } ?>
                </ul>
                <?php } ?>
            </div>
            
        <?php } ?>
        
    </div>
</div>
<br>
<?php include_once('footer.php'); ?>
</div>
</body>
<script>
    var data = '<?php echo $data['response']; ?>';
    if(data){
        setTimeout(function(){
            window.location.href = "<?php echo fullURLfront; ?>/Contractor/contractor_viewad";
        }, 2000);
    }
</script>
</html>
