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
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_ownad.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500;700&family=Lobster&display=swap" rel="stylesheet">

</head>
<body>
<div class="page-wrapper">
<?php include_once('header.php'); ?>

<div class="row">
  <div class="column1">
    <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
  </div>
  <div class="column2">
    <center><h1 class="viewad">My Ads</h1></center>
    <?php foreach($data['contractor_ownad'] as $record) { ?>
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
                        <p class="field">Email : <?php echo $record->Email; ?></p>
                        <p class="field">Location : <?php echo $record->Address; ?></p>
                        <p class="field">District : <?php echo $record->District; ?></p>
                        <p class="field">Posted Date and Time : <?php echo $record->Date; ?></p>
                    </div>
                </div>
                <div class="subcolumn3" style="background-color: #B4E1E7;">
                    <div class="details">
                        <p class="special-field">Task Description</p>
                        <p class="description"><?php echo $record->Description; ?></p><br>
                    </div>
                </div>        
            </div><br><br>
    <?php } ?>

    <div>
        <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
        <ul class="pagination">
            <?php if ($page > 1){ ?>
            <li class="prev"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo $page-1 ?>">Prev</a></li>
            <?php } ?>

            <?php if ($page > 3){ ?>
            <li class="start"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=1">1</a></li>
            <li class="dots">...</li>
            <?php } ?>

            <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php } ?>
            <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php } ?>

            <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo $page ?>"><?php echo $page ?></a></li>

            <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php } ?>
            <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php } ?>

            <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
            <li class="dots">...</li>
            <li class="end"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
            <?php } ?>

            <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
            <li class="next"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_ownad?page=<?php echo $page+1 ?>">Next</a></li>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>
  </div>
</div>
<br>
<?php include_once('footer.php'); ?>

</div>

</body>
</html>
