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
    <title>Spend Product</title>
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
                        if(isset($_POST['spend_product_name'])) {
                            $spend_product_name = $_POST['spend_product_name'];

                            if(trim($spend_product_name=="")) {
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
                                die();
                            }
                           
                            $spend_product_quantity = $_POST['spend_product_quantity'];

                            $total_store_product_query = "SELECT SUM(store_product_quantity) as total_store_product FROM store_product WHERE store_product_name = $spend_product_name";
                            $query_data1 = $conn->query($total_store_product_query);
                            $total_store_product_array = mysqli_fetch_assoc($query_data1);
                            $total_store_product =0;
                            if(!empty($total_store_product_array['total_store_product'])) {
                                $total_store_product = $total_store_product_array['total_store_product'];
                            }

                            $total_spend_product_query = "SELECT SUM(spend_product_quantity) as total_spend_product FROM spend_product WHERE spend_product_name = $spend_product_name";
                            $query_data2 = $conn->query($total_spend_product_query);
                            $total_spend_product_array = mysqli_fetch_assoc($query_data2);
                            $total_spend_product = $spend_product_quantity;
                            if(!empty($total_spend_product_array['total_spend_product'])) {
                                $total_spend_product += $total_spend_product_array['total_spend_product'];
                            }

                            if($total_spend_product > $total_store_product) {
                                echo '<script> alert("Total spend product is greater then total store product.");window.history.back();</script>';
                                die();
                            }
                            
                            $spend_product_entry_date = $_POST['spend_product_entry_date'];
                            
                            $query = "INSERT INTO spend_product (spend_product_name, spend_product_quantity, spend_product_entry_date ) VALUES ( '$spend_product_name', '$spend_product_quantity', '$spend_product_entry_date')";
                                
                            if($conn->query($query) === TRUE) {
                                echo "Data inserted successfully";
                                header('location: list_of_spend_product.php');
                                die();
                            } 
                            else{
                                echo "Error: " . $query . "<br>" . $conn->error;
                            }
                        }
                    ?>

                    


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        Product Name: <select name="spend_product_name" id="" class="form-select">
                            <?php
                                show_data_options('product', 'product_id', 'product_name');
                            ?>
                        </select> <br> <br>
                        Product Quantity: <input type="number" name="spend_product_quantity" id="" class="form-control"> <br> <br>
                        Product Entry Date: <input type="date" name="spend_product_entry_date" id="" class="form-control"> <br> <br>
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