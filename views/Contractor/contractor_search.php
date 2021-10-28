<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_search.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
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
                        <form action="/action_page.php">
                            <input type="text" placeholder="search by keyword....." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    <div class="subrow">
                        <div class="filters-row">
                            <form action="/action_page.php" id="formdesign">
                                <label for="area" id="label-of-list">Area</label>
                                <select name="area" id="area" >
                                    <option value="All">All</option>
                                    <option value="colombo">Colombo</option>
                                    <option value="gampaha">Gampaha</option>
                                    <option value="kaluthara">Kaluthara</option>
                                    <option value="galle">Galle</option>
                                </select>

                                <label for="type" id="label-of-list">Type</label>
                                <select name="type" id="type">
                                    <option value="All">All</option>
                                    <option value="manpower">Manpower Agency</option>
                                    <option value="customer">Customer</option>
                                    <option value="contractor">Employee</option>
                                </select>
                            </form>
                        </div>
                    </div> 

                
            
                        <table id="myTable">
                            <tr class="header">
                                <th class="header-topics">profile</th>
                                <th class="header-topics">Name</th>
                                <th class="header-topics">Email</th>
                                <th class="header-topics">District</th>
                                <th class="header-topics">Type</th>
                            </tr>

                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/freeman-search-customer.jfif"></td>
                                <td>Morgan Freeman</td>
                                <td>freeman@gmail.com</td>
                                <td>Colombo</td>
                                <td>Electrician</td>
                            </tr>
                            
                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/chamararanawaka.jpg"></td>
                                <td>Chamara Ranawaka</td>
                                <td>chamararanawaka@gmail.com</td>
                                <td>Colombo</td>
                                <td>Electrician</td>
                            </tr>

                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/charlieaugust.jfif"></td>
                                <td>Charlie August</td>
                                <td>charlieaugust69@gmail.com</td>
                                <td>Matara</td>
                                <td>Masonary</td>
                            </tr>

                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/ramchaterji.jpg"></td>
                                <td>Ramnaresh Chaterji</td>
                                <td>ramnareshchaterji@gmail.com</td>
                                <td>Galle</td>
                                <td>Carpenter</td>
                            </tr>

                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/sarathhewapathirana.jfif"></td>
                                <td>Sarath Hewapathirana</td>
                                <td>hewapathiranasarath@gmail.com</td>
                                <td>Gampaha</td>
                                <td>Carpenter</td>
                            </tr>

                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/dasun.jpg"></td>
                                <td>Dasun shanaka</td>
                                <td>dasunshanaka@gmail.com</td>
                                <td>Matara</td>
                                <td>Electrician</td>
                            </tr>

                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/dhananjaya-de-silva.jpg"></td>
                                <td>Dananjaya desilva</td>
                                <td>dananjayadesilva77@gmail.com</td>
                                <td>Hmabanthota</td>
                                <td>Plumber</td>
                            </tr>

                            <tr class="mytable-rows">
                                <td><img  id ="profilephoto" src="<?php echo fullURLfront; ?>/assets/images/JYesudas.jpg"></td>
                                <td>JYesudasan </td>
                                <td>realmejesudas@gmail.com</td>
                                <td>Hmabanthota</td>
                                <td>Masonary</td>
                            </tr>
                    
                                <!-- <?php
                                    $x=count($data);
                                    for($i=0;$i<$x;$i++){
                                        echo '<tr id="tea" data-href-tea="Contractor/contractor_search">
                                            <td>'.$data[$i]['name'].'</td>
                                            <td>'.$data[$i]['Email'].'</td>
                                            <td>'.$data[$i]['district'].'</td>
                                            <td>'.$data[$i]['userType'].'</td>
                                        </tr>';                
                                    }       
                                ?>          -->
                            
                        </table> 

            
                    <!-- <script>
                        function myFunction() {
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[0];
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }       
                            }
                        }
                    </script>

                    <script>

                    //roneki gen gatta ewa//
                        document.addEventListener("DOMContentLoaded",() => {
                        const rows = document.querySelectorAll("tr[data-href-tea]");
                        rows.forEach(row =>{
                        row.addEventListener("click", ()=>{
                        openteaform();

                                });
                            });
                        });

                    </script> --> 

                    <div class= "bottom-row">
                    
                        <!--  <p style="margin-top:50px;font-weight:bold;color:blueviolet "> <<<< Go to my favourites list >>></p> -->
                        <button type="button" class="favorite-btn" >my favourites</button>
                    </div>
        
                </div>

            </div>
            <?php include_once('footer.php'); ?>
        </div>
    </body>
</html>