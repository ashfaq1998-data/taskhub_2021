<?php
session_start();
$page = $data['pagination']['page'];
$total_pages = $data['pagination']['total_pages'];
$num_results_on_page = $data['pagination']['results_count'];

$search = $data['filters']['search'];
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/admin/admin_dashboard.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo fullURLfront; ?>/assets/cs/admin/admin_managehelp.css" rel="stylesheet" type="text/css"/>
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
                <form action="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry" method="POST" id="filter">
                    <input type="text" placeholder="Search inquiry by username" name="search" id="search" value="<?php echo (!empty($data['filters'])) ? $search : ''; ?>">
                    <button type="submit"><i class="fa fa-search"></i></button>
            </div>

            
                    
                
                </form>
            
            <br><br>
            
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
                <table class="help">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach($data['contact'] as $record) { ?>
                        <tr>
                            <td><?php echo $record->Date; ?></td>
                            <td><?php echo $record->name; ?></td>
                            <td><?php echo $record->email; ?></td>
                            <td><?php echo $record->description; ?></td>
                            <td><a href="<?php echo fullURLfront; ?>/Admin/admin_deleteinquiry?iid=<?php echo base64_encode($record->IID); ?>" class="view-profile-btn" style="margin-left: 2%;">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php } ?>
                    
                </table>

                <div>
                    <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                    <ul class="pagination">
                            <?php if ($page > 1){ ?>
                            <li class="prev"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo $page-1 ?>&search=<?php echo $search; ?>">Prev</a></li>
                            <?php } ?>

                            <?php if ($page > 3){ ?>
                            <li class="start"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=1&search=<?php echo $search; ?>">1</a></li>
                            <li class="dots">...</li>
                            <?php } ?>

                            <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo $page-2 ?>&search=<?php echo $search; ?>"><?php echo $page-2 ?></a></li><?php } ?>
                            <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo $page-1 ?>&search=<?php echo $search; ?>"><?php echo $page-1 ?></a></li><?php } ?>

                            <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo $page ?>&search=<?php echo $search; ?>"><?php echo $page ?></a></li>

                            <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo $page+1 ?>&search=<?php echo $search; ?>"><?php echo $page+1 ?></a></li><?php } ?>
                            <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo $page+2 ?>&search=<?php echo $search; ?>"><?php echo $page+2 ?></a></li><?php } ?>

                            <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                            <li class="dots">...</li>
                            <li class="end"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo ceil($total_pages / $num_results_on_page) ?>&search=<?php echo $search; ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                            <?php } ?>

                            <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                            <li class="next"><a href="<?php echo fullURLfront; ?>/Admin/admin_manageinquiry?page=<?php echo $page+1 ?>&search=<?php echo $search; ?>">Next</a></li>
                            <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
            <?php } ?>
            
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</div>
</body>
<script>
  var data = '<?php echo $data['response']; ?>';
  if(data){
    setTimeout(function(){
      window.location.href = "<?php echo fullURLfront; ?>/Admin/admin_manageinquiry";
    }, 2000);
  }
</script>
</html>

