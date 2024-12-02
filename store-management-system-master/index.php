<?php 
     session_start();
     $user_first_name = $_SESSION['user_first_name'];
     $user_last_name = $_SESSION['user_last_name'];

     if(!empty($user_first_name) && !empty($user_last_name)) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Management | Root</title>
    <?php include('template.php'); ?>
</head>
<body class="">
    <div class="container ">
        <div class="container-fluid"> <!-- topbar start   -->
            <?php include('topbar.php'); ?>
            
        </div> <!-- topbar end   -->


        <div class="container-fluid">
            <div class="row"> 
                <div class="col-sm-3 bg-info-subtle p-0 m-0"> <!-- leftbar start   -->
                   <?php include('leftbar.php'); ?>
                </div> <!-- leftbar end   -->
                <div class="col-sm-9"> <!-- rightbar start   -->
                    <div class="row m-4">
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3 rounded-lg">
                           <a class="text-decoration-none" href="add_category.php">
                              <i class="fa-solid fa-folder-plus fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Product Entry</p>
                           </a>
                           
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="list_of_category.php">
                              <i class="fa-solid fa-folder-open fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Product List</p>
                           </a>
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="add_product.php">
                              <i class="fa-solid fa-circle-plus fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Enventory Product Entry</p>
                           </a>
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="list_of_product.php">
                              <i class="fa-solid fa-list-ol fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Enventory Product List</p>
                           </a>
                        </div>

                        <hr>

                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="add_store_product.php">
                              <i class="fa-solid fa-box fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Add Store Product</p>
                           </a>
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="list_of_entry_product.php">
                              <i class="fa-solid fa-layer-group fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Store Product List</p>
                           </a>
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="add_spend_product.php">
                              <i class="fa-solid fa-square-minus fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Add Spend Product</p>
                           </a>
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="list_of_product.php">
                              <i class="fa-solid fa-building-circle-arrow-right fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Spend Product List</p>
                           </a>
                        </div>

                        <hr>


                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="add_user.php">
                            <i class="fa-solid fa-user-plus fa-5x text-info-emphasis"></i>
                            <p class="fw-semibold">Add User</p>
                        </a>
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="list_of_users.php">
                            <i class="fa-solid fa-users fa-5x text-info-emphasis"></i>
                            <p class="fw-semibold">Users List</p>
                        </a>
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        <a class="text-decoration-none" href="report.php">
                              <i class="fa-solid fa-chart-column fa-5x text-info-emphasis"></i>
                              <p class="fw-semibold">Report</p>
                           </a>
                        </div>
                        <!-- <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        </div> -->

                        <hr>

                        
                        <!-- <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        </div>
                        <div class="col-sm-3 border border-5 border-light bg-info-subtle text-center pt-3">
                        </div> -->

                        
                    </div>
                </div> <!-- rightbar end   -->
            </div>
        </div>


        <div class="container-fluid border-top border-success mt-2">
            <?php include('bottombar.php') ?>
        </div>
    </div>
    
</body>
</html>

<?php 
     } else {
        header('location: login.php');
     }  
?>