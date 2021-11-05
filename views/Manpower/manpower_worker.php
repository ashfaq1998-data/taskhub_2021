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
    <link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_worker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo fullURLfront; ?>/assets/cs/manpower/manpower_search.css" rel="stylesheet" type="text/css" />
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
                <h1>Manpower Agency Worker List</h1>
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search Worker by Name" name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="sortinglist">
                    <form action="/action_page.php" style="float: left; font-weight: bold;">
                        <label for="area">Area:</label>
                        <select name="area" id="area">
                            <option value="colombo">Colombo</option>
                            <option value="gampaha">Gampaha</option>
                            <option value="kaluthara">Kaluthara</option>
                            <option value="galle">Galle</option>
                        </select>

                        <label for="type">Type:</label>
                        <select name="type" id="type">
                            <option value="manpower">Electrician</option>
                            <option value="contractor">Plumber</option>
                            <option value="manpower">Carpenter</option>
                            <option value="contractor">Cleaner</option>
                        </select>
                    </form>
                </div>
                <div style="float: right; ">
                    <button class="AddNewButton">
                        <a href="<?php echo fullURLfront; ?>/Manpower/manpower_addworker"><i class="fa fa-worker"></i>Add New Worker</a>
                    </button>
                </div>
                
                <br><br>
                <div class="subrow">
                    <table id="customers">
                        <tr>
                            <th>Worker Name</th>
                            <th>Job Type</th>
                            <th>Area</th>
                            <th>Rating</th>
                            <th> </th>
                        </tr>
                        <tr>
                            <td>Ruwan</td>
                            <td>carpenter</td>
                            <td>Colombo</td>
                            <td><?php for ($i = 1; $i <= (5 - $manpowerDetails->rating); $i++) { ?>
                                    <span class="fa fa-star"></span>
                                <?php } ?>
                            </td>
                            <td><button class="ProfileButton">View Profile</button></td>

                        </tr>
                        <tr>
                            <td>Saman</td>
                            <td>Plumber</td>
                            <td>Galle</td>
                            <td><?php for ($i = 1; $i <= (5 - $manpowerDetails->rating); $i++) { ?>
                                    <span class="fa fa-star"></span>
                                <?php } ?>
                            </td>
                            <td><button class="ProfileButton">View Profile</button></td>
                        </tr>
                        <tr>
                            <td>Nuwan</td>
                            <td>Electician</td>
                            <td>Gampaha</td>
                            <td><?php for ($i = 1; $i <= (5 - $manpowerDetails->rating); $i++) { ?>
                                    <span class="fa fa-star"></span>
                                <?php } ?>
                            </td>
                            <td><button class="ProfileButton">View Profile</button></td>
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