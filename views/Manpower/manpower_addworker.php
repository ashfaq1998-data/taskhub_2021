<?php
// session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_dashboard.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_addworker.css" rel="stylesheet" type="text/css" />
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
                <h1>Add New Worker</h1>

                <div class="register-section">
                    <div class="register-section-form">
                        <h3>Worker Details</h3><br>
                        <form action="<?php echo fullURLfront; ?>/Manpower/manpower_workerprofile" method="POST">
                            <input type="text" id="worker_firstname" name="worker_firstname" placeholder="Worker First Name" value="">
                            <input type="text" id="worker_lastname" name="worker_lastname" placeholder="Worker Last Name" value="">
                            <input type="text" id="nic" name="nic" placeholder="NIC No" value="">
                            <input type="text" id="district" name="district" placeholder="District" value="">
                            <input type="text" id="phone_num" name="phone_num" placeholder="Phone No" value="">
                            <input type="text" id="address" name="address" placeholder="Address" value="">
                            <input type="text" id="email" name="email" placeholder="Email" value="">
                            <select name="jobtype" id="jobtype" placeholder="Job Type">
                                <option value="Electrician">Electrician</option>
                                <option value="Plumber">Plumber</option>
                                <option value="Carpenter">Carpenter</option>
                                <option value="Cleaner">Cleaner</option>
                            </select>
                            <input type="text" id="payment" name="payment" placeholder="Payment per Hour" value=""><br>
                            <button type="submit" name="add_worker" value="submitted" class="btn-submit">Add Worker</button>
                        </form>
                        <br>
                        <p class="error"><?php echo $data['registerError']; ?></p>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <?php include_once('footer.php'); ?>
    </div>

</body>

</html>