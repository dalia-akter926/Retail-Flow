<?php
  require('db_connection.php');
  include('template.php');
  require('my_function.php');
  session_start();
  $user_first_name = $_SESSION['user_first_name'];
  $user_last_name = $_SESSION['user_last_name'];

  if(!empty($user_first_name) && !empty($user_last_name)) { 
    ob_start(); // Start output buffering
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Product</title>
    <?php include('template.php'); ?>
</head>
<body> 

<div class="container">
        <div class="container-fluid"> <!-- topbar start   -->
            <?php include('topbar.php'); ?>
            
        </div> <!-- topbar end   -->


        <div class="container-fluid">
            <div class="row"> 
                <div class="col-sm-3 bg-info-subtle p-0 m-0"> <!-- leftbar start   -->
                   <?php include('leftbar.php'); ?>
                </div> <!-- leftbar end   -->
                <div class="col-sm-9"> <!-- rightbar start   -->
                    <div class="container col-9 px-10 py-4  bg-secondary bg-opacity-50">
                    <?php
                        if(isset($_POST['store_product_name'])) {
                            $store_product_name = $_POST['store_product_name'];
                            $store_product_quantity = $_POST['store_product_quantity'];

                            if(empty(trim($store_product_quantity))) {
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
                                die();
                            }

                            $store_product_entry_date = $_POST['store_product_entry_date'];
                            
                            $query = "INSERT INTO store_product (store_product_name, store_product_quantity, store_product_entry_date ) VALUES ( '$store_product_name', '$store_product_quantity', '$store_product_entry_date')";

                            if($conn->query($query) === TRUE) {
                                echo "Data inserted successfully";
                                header('location: list_of_entry_product.php');
                                die();
                            } 
                            else{
                                echo "Error: " . $query . "<br>" . $conn->error;
                            }
                        }
                    ?>

                    


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        Product Name: <select name="store_product_name" id="" class="form-select">
                            <?php
                                show_data_options('product', 'product_id', 'product_name');
                            ?>
                        </select> <br> <br>
                        Product Quantity: <input type="number" name="store_product_quantity" id="" class="form-control"> <br> <br>
                        Product Entry Date: <input type="date" name="store_product_entry_date" id="" class="form-control"> <br> <br>
                        <input type="submit" class="btn btn-secondary" value="Add">
                    </form>
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
    ob_end_flush(); // Flush output buffer
     } else {
        header('location: login.php');
     }  
?>