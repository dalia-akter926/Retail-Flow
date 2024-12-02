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
    <title>Edit Spent Product</title>
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
                    <div class="w-75 mx-auto bg-dark bg-opacity-25 p-10">
                    <?php
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $query1 = "SELECT * FROM spend_product WHERE spend_product_id = $id";
                            $query_data1 = $conn->query($query1);
                            $data_array1 = mysqli_fetch_assoc($query_data1);

                            $spend_product_id = $data_array1['spend_product_id'];
                            $spend_product_name = $data_array1['spend_product_name'];
                            $spend_product_quantity = $data_array1['spend_product_quantity'];
                            $spend_product_entry_date = $data_array1['spend_product_entry_date'];
                        

                            }

                        if(isset($_POST['spend_product_name'])) {
                            $new_spend_product_id = $_POST['spend_product_id'];
                            $new_spend_product_name = $_POST['spend_product_name'];
                            $new_spend_product_quantity = $_POST['spend_product_quantity'];
                            $new_spend_product_entry_date = $_POST['spend_product_entry_date'];

                           $total_store_product_query = "SELECT SUM(store_product_quantity) as total_store_product FROM store_product WHERE store_product_name = $new_spend_product_name";

                            $query_data1 = $conn->query($total_store_product_query);
                            $total_store_product_array = mysqli_fetch_assoc($query_data1);
                            $total_store_product =0;
                            if(!empty($total_store_product_array['total_store_product'])) {
                                $total_store_product = $total_store_product_array['total_store_product'];
                            }

                            $total_spend_product_query = "SELECT SUM(spend_product_quantity) as total_spend_product FROM spend_product WHERE spend_product_name = $new_spend_product_name AND spend_product_id != '$new_spend_product_id'";

                            $query_data2 = $conn->query($total_spend_product_query);
                            $total_spend_product_array = mysqli_fetch_assoc($query_data2);
                            $total_spend_product = $new_spend_product_quantity;
                            if(!empty($total_spend_product_array['total_spend_product'])) {
                                $total_spend_product += $total_spend_product_array['total_spend_product'];
                            }

                            
                            if($total_spend_product > $total_store_product) {
                                echo '<script> alert("Total spend product is greater then total store product.");window.history.back();</script>';
                                die();
                            }


                    
                            $new_query = "UPDATE spend_product SET 
                                spend_product_name = '$new_spend_product_name', 
                                spend_product_quantity = '$new_spend_product_quantity', 
                                spend_product_entry_date = '$new_spend_product_entry_date' 
                            WHERE spend_product_id = '$new_spend_product_id' ";
                    
                            if($conn->query($new_query)) {
                                echo "Updated Successfully";
                                header('location: list_of_spend_product.php');
                            } 
                            else {
                                echo "Update Failed";
                            }
                        }


                    ?>


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?=$id?>" method="POST">
                        <input type="number" name="spend_product_id" id="" value="<?php echo $spend_product_id; ?>" hidden>
                        Product Name: <select name="spend_product_name" id="" class="form-select">
                            <?php
                                $query = "SELECT * FROM product";
                                $query_data = $conn->query($query);
                        
                            while($data_array = mysqli_fetch_array($query_data)) {
                                $data_id = $data_array['product_id'];
                                $data_name = $data_array['product_name'];
                            ?>
                        
                        <option value="<?php echo $data_id; ?>" <?php if ($data_id == $spend_product_name) { echo 'selected';} ?> > <?php echo $data_name; ?> </option>
                        
                        <?php } ?>
                        </select> <br> <br>
                        Product Quantity: <input type="number" name="spend_product_quantity" id="" value="<?php echo $spend_product_quantity; ?>" class="form-control"> <br> <br>
                        Product Entry Date: <input type="date" name="spend_product_entry_date" id="" value="<?php echo $spend_product_entry_date; ?>" class="form-control"> <br> <br>
                        <input type="submit" class="btn btn-secondary" value="submit">
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