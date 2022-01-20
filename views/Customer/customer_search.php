<?php
    session_start();
    $details = $data['results'];
    $arrLength = count($details);
    ?>

<?php
    for ($i=0; $i<$arrLength; $i++) { ?>
    <h1><?php echo $details[$i]->FirstName; ?> <?php echo $details[$i]->LastName; ?> <?php echo $details[$i]->Specialized_area; ?></h1>  
    
    <?php } ?>
