<?php
session_start();
$page = $data['pagination']['page'];
$total_pages = $data['pagination']['total_pages'];

?>
<!DOCTYPE html>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

    

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_viewadmyads.css" rel="stylesheet" type="text/css"/>
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
            
                    <div class="column2-top-row">
                        See Your Past Advertisemnts Here
                    </div>
                    <?php if(empty($data['response'])){?>
                        <?php foreach($data['advertisements'] as $record) { ?>
                            <div class="subrow">
                                <div class="subcolumn1" style="background-color: #B4E1E7;">
                                    <div class ="adimage">
                                        <img src="<?php echo fullURLfront; ?>/assets/images/pipe.jpg" alt="image1" width="180px" height="180px">
                                    </div> 
                                </div>
                                <div class="subcolumn2" style="background-color: #B4E1E7;">
                                    <div class="postedby">
                                        <p class="special-field">Posted By:</p>
                                        <p class="field">Name : <?php echo $record->name; ?></p>
                                        <p class="field">Email : <?php echo $record->email; ?> </p>
                                        <p class="field">Location : <?php echo $record->address; ?></p>
                                        <p class="field">Date : <?php echo $record->date; ?></p>
                            
                                    </div>
                                </div>
                                <div class="subcolumn3" style="background-color: #B4E1E7;">
                                    <div class="details">
                                        <p class="special-field">Task Description</p>
                                        <p class="description"><?php echo $record->description; ?></p><br>
                        
                                    </div>
                                </div>

                                <div class="poster-options-menu">
                                    <a href="<?php echo fullURLfront; ?>/Contractor/contractor_myadedit">
                                        <button id="editbtn">EDIT</button>
                                    </a>
                                    <button id="delbtn">DELETE</button>
                        
                    
                                </div>
                            </div>
            
                        <?php } ?>
                    <?php } ?>
      
                </div>
            </div>
            <?php include_once('footer.php'); ?>   
            <!-- <div>
                <?php if (ceil($total_pages / $num_results_on_page) > 0 && $total_pages > $num_results_on_page){ ?>
                <ul class="pagination">
                        <?php if ($page > 1){ ?>
                        <li class="prev"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewadmyadmyad?page=<?php echo $page-1 ?>">Prev</a></li>
                        <?php } ?>

                        <?php if ($page > 3){ ?>
                        <li class="start"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewadmyadmyad?page=1">1</a></li>
                        <li class="dots">...</li>
                        <?php } ?>

                        <?php if ($page-2 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewadmyad?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php } ?>
                        <?php if ($page-1 > 0){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewadmyad?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php } ?>

                        <li class="currentpage"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewadmyad?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                        <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/Contractor_viewadmyad?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php } ?>
                        <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1){ ?><li class="page"><a href="<?php echo fullURLfront; ?>/Contractor/Contractor_viewadmyad?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)-2){ ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewadmyad?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                        <?php } ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)){ ?>
                        <li class="next"><a href="<?php echo fullURLfront; ?>/Contractor/contractor_viewadmyad?page=<?php echo $page+1 ?>">Next</a></li>
                        <?php } ?>
                </ul>
                <?php } ?>
            </div> -->
        
        </div>
        
    </body>
</html>