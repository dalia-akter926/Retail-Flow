<?php
 require('db_connection.php');

 $query1 = "SELECT * FROM product";
 $query1_data = $conn->query($query1);

 $all_product = array();

 while($data_array1 = mysqli_fetch_assoc($query1_data)) {
    $product_id = $data_array1['product_id'];
    $product_name = $data_array1['product_name'];

    $all_product[$product_id] = $product_name;
 };

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
    <title>List of Stored Product</title>
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
                   <div>
                   <?php
                        $query = "SELECT * FROM store_product";
                        $query_data = $conn->query($query);
                        echo "<table class='table table-striped table-hover'>
                            <tr> 
                                <th>Product Name</th> 
                                <th>Product Quantity</th> 
                                <th>Entry Date</th> 
                                <th>Action-1</th> 
                                <th>Action-2</th> 
                            </tr>";
                        while($data_array = mysqli_fetch_assoc($query_data)) {
                            $store_product_id = $data_array['store_product_id'];
                            $store_product_name = $data_array['store_product_name'];
                            $store_product_quantity = $data_array['store_product_quantity'];
                            $store_product_entry_date = $data_array['store_product_entry_date'];

                       if(mysqli_num_rows($conn->query("SELECT * FROM product WHERE product_id=$store_product_name")) > 0){

                        echo "<tr>
                                <td>$all_product[$store_product_name]</td>
                                <td>$store_product_quantity</td> 
                                <td>$store_product_entry_date</td>
                                <td> <a class='btn btn-secondary' href='edit_store_product.php?id=$store_product_id'>Edit</a> </td>
                                <td> <a class='btn btn-danger' href='delete_store_product.php?id=$store_product_id'>Delete</a> </td>
                                </tr>";
                       } else {
                        echo "";
                       }
                          
                        };

                        echo "</table>";
                        
                    ?>

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