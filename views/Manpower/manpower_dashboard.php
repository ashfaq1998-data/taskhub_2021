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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        h1 {
            color: black;
            font-size: 20px;
        }

        /* Style the body */
        body {
            font-family: Arial;
            margin: 0;
        }

        /* Header/Logo Title */
        .header {
            padding: 10px;
            text-align: center;
            background: #FFFFFF;
            color: black;
            font-size: 20px;
        }

        /* Page Content */
        .content {
            padding: 20px;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 35%;
            padding: 10px;
            height: 600px;

            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        #Requests_Customer {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border-radius: 25px;
        }

        #Requests_Customer td,
        #Requests_Customer th {
            border: 1px solid #aaa;
            padding: 8px;
        }

        #Requests_Customer tr:nth-child(even) {
            background-color: #ddd;
        }

        #Requests_Customer tr:nth-child(odd) {
            background-color: #ccc;
        }

        #Requests_Customer tr:hover {
            background-color: #bbb;
        }

        #Requests_Customer th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #rcorners1 {
            border-radius: 25px;
            
        }
    </style>

</head>

<body>
    <div class="page-wrapper">
        <?php include_once('header.php'); ?>

        <div class="row">
            <div class="column1">
                <?php include_once('views/Manpower/manpower_sidebar.php'); ?>
            </div>
            <div class="h1">
                <h1>Manpower Agency Dashboard</h1>
                <!-- <h1>Manpower Agency Dashboard</h1> -->
                <div style="flex:initial ;">
                    <div id="rcorners1" class="column" style="background-color:#B4E1E7; margin-right: 40px; ">
                        <h2>Requests</h2>

                        <table id="Requests_Customer">
                            <tr>
                                <th>Customer Name</th>
                                <th>Job Type</th>
                                <th>Area</th>
                            </tr>
                            <tr>
                                <td>Ruwan</td>
                                <td>carpenter</td>
                                <td>Colombo</td>
                            </tr>
                            <tr>
                                <td>Saman</td>
                                <td>Plumber</td>
                                <td>Galle</td>
                            </tr>
                            <tr>
                                <td>Nuwan</td>
                                <td>Electician</td>
                                <td>Gampaha</td>
                            </tr>


                        </table>
                    </div>
                    <div id="rcorners1" class="column" style="background-color:#B4E1E7; ">
                        <h2>Current Jobs</h2>

                        <table id="Requests_Customer">
                            <tr>
                                <th>Worker Name</th>
                                <th>Job Type</th>
                                <th>Area</th>
                                <th>Ending Time</th>
                            </tr>
                            <tr>
                                <td>Ruwan</td>
                                <td>carpenter</td>
                                <td>Colombo</td>
                                <td>13:00</td>
                            </tr>
                            <tr>
                                <td>Saman</td>
                                <td>Plumber</td>
                                <td>Galle</td>
                                <td>10:00</td>
                            </tr>
                            <tr>
                                <td>Nuwan</td>
                                <td>Electician</td>
                                <td>Gampaha</td>
                                <td>15:00</td>
                            </tr>


                        </table>
                    </div>
                </div>


            </div>

            <!-- <div class="subrow">
                <div class="subcolumn1" style="background-color: #FFFFFF;">
                    <div class="adimage">
                        <img src="<?php echo fullURLfront; ?>/assets/images/pipe.jpg" alt="image1" width="180px" height="180px">
                    </div>
                </div>
                <div class="subcolumn2" style="background-color: #B4E1E7;">
                    <div class="postedby">
                        <p class="special-field"></p>
                        <p class="field"> </p>
                        <p class="field"> </p>
                        <p class="field"> </p>
                        <p class="field"> </p>
                    </div>
                </div>
                <div class="subcolumn3" style="background-color: #B4E1E7;">
                    <div class="details">
                        <p class="special-field">Task Description</p>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla bibendum justo condimentum, ullamcorper sapien sed, condimentum augue. Nullam non turpis vitae urna vestibulum dapibus. Duis scelerisque quis purus nec cursus.</p>
                    </div>
                </div>
            </div> -->

        </div>
        <br>
        <?php include_once('footer.php'); ?>

    </div>

</body>

</html>