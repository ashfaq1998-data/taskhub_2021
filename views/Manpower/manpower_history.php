<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_dashboard.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_history.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

    </style>


</head>



<body>
    <div class="page-wrapper">
        <?php include_once('header.php'); ?>

        <div class="row">
            <div class="column1">
                <?php include_once('views/Manpower/manpower_sidebar.php'); ?>
            </div>
            <div class="column2">
                <h1>Company Job History</h1>
                <br>
                <div class="subrow">
                    <table id="customers">
                        <tr>
                            <th>Date</th>
                            <th>Worker Name</th>
                            <th>Location</th>
                            <th>Payment</th>
                            <th>Job Status</th>
                        <th> </th>
                        </tr>
                        <tr>
                            <td>2021.10.30</td>
                            <td>Ruwan</td>
                            <td>Colombo</td>
                            <td>Online Transfer</td>
                            <td>In Progress</td>
                            <td><button class="ProfileButton">View Details</button></td>

                        </tr>
                        <tr>
                            <td>2021.10.28</td>
                            <td>Saman</td>
                            <td>Gampaha</td>
                            <td>card</td>
                            <td>Completed</td>
                            <td><button class="ProfileButton">View Details</button></td>

                        </tr>
                        <tr>
                            <td>2021.10.22</td>
                            <td>Nuwan</td>
                            <td>Colombo</td>
                            <td>Cash</td>
                            <td>Completed</td>
                            <td><button class="ProfileButton">View Details</button></td>

                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
        <br>
        <?php include_once('footer.php'); ?>
    </div>

</body>

</html>