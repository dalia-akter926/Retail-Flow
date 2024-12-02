<?php
  require('db_connection.php');
  include('template.php');
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
    <title>Add Product</title>
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
                  <div  class="container col-9 px-10 py-4  bg-secondary bg-opacity-50">
                    <?php
                            if(isset($_POST['product_name'])) {
                            $product_name = $_POST['product_name'];
                            if(trim($product_name=="")) {
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
                                die();
                            }
                            $product_category = $_POST['product_category'];
                            $product_code = $_POST['product_code'];
                            $product_entry_date = $_POST['product_entry_date'];

                            $query = "SELECT * FROM  product WHERE product_name = '$product_name'";
                            $query_data = $conn->query($query);
    
                            if(mysqli_num_rows($query_data)) {
                                echo '<script> alert("This product is already exists.")</script>';
                            } else {
                                $product_category = $_POST['product_category'];
                                $product_code = $_POST['product_code'];
                                $product_entry_date = $_POST['product_entry_date'];
                        
                             $query = "INSERT INTO product (product_name, product_category, product_code, product_entry_date ) VALUES ( '$product_name', '$product_category', '$product_code', '$product_entry_date')";
                                
                            if($conn->query($query) === TRUE) {
                                echo "Data inserted successfully";
                                header('location: list_of_product.php');
                                die();

                            } 
                            else{
                                echo "Error: " . $query . "<br>" . $conn->error;
                            }
                        }


                            }
                        ?>

                        <?php 
                            $query = "SELECT * FROM category";
                            $query_data = $conn->query($query);
                        ?>


                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            
                            Product Name: <input type="text" name="product_name" id="" class="form-control"> <br> <br>
                            Product Category: <select name="product_category" id=""  class="form-select">
                                <?php
                                    
                                    while($data_array = mysqli_fetch_array($query_data)) {
                                        $category_id = $data_array['category_id'];
                                        $category_name = $data_array['category_name'];
                                    
                                    echo "<option value='$category_id'>$category_name</option>";
                                    };
                                    
                                ?>
                            </select> <br> <br>
                            Product Code: <input type="text" name="product_code" id="" class="form-control"> <br> <br>
                            Product Entry Date: <input type="date" name="product_entry_date" id="" class="form-control"> <br> <br>
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