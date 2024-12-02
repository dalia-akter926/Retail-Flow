<?php
 require('db_connection.php');

 $query1 = "SELECT * FROM category";
 $query1_data = $conn->query($query1);

 $all_category = array();

 while($data_array1 = mysqli_fetch_assoc($query1_data)) {
    $category_id = $data_array1['category_id'];
    $category_name = $data_array1['category_name'];

    $all_category[$category_id] = $category_name;
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
    <title>List of Product</title>
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
                <?php
                    $query = "SELECT * FROM product";
                    $query_data = $conn->query($query);
                    echo "<table class='table table-striped table-hover'>
                        <tr> 
                            <th>Product Name</th> 
                            <th>Product Category</th> 
                            <th>Product Code</th> 
                            <th>Action-1</th> 
                            <th>Action-2</th> 
                        </tr>";
                    while($data_array = mysqli_fetch_assoc($query_data)) {
                        $product_id = $data_array['product_id'];
                        $product_name = $data_array['product_name'];
                        $product_category = $data_array['product_category'];
                        $product_code = $data_array['product_code'];

                        if(mysqli_num_rows($conn->query("SELECT * FROM category WHERE category_id=$product_category")) > 0){
                            echo "<tr>
                            <td>$product_name</td>
                            <td>$all_category[$product_category]</td>
                            <td>$product_code</td>
                            <td> <a class='btn btn-secondary opacity-75' href='edit_product.php?id=$product_id'>Edit</a> </td>
                            <td> <a class='btn btn-danger opacity-75' href='delete_product.php?id=$product_id'>Delete</a> </td>
                            </tr>"; 
                        } else {
                            echo "";
                        }        
                    };

                    echo "</table>";
                    
                ?>
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