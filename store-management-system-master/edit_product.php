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
    <title>Edit Product</title>
    <?php include('template.php'); ?>
</head>
<body>

<div class="container ">
        <div class="container-fluid"> <!-- topbar start   -->
            <?php include('topbar.php'); ?>
            
        </div> <!-- topbar end   -->


        <div class="container-fluid">
            <div class="row"> 
                <div class="col-sm-3 bg-info-subtle p-0 m-0"> <!-- leftbar start   -->
                   <?php include('leftbar.php'); ?>
                </div> <!-- leftbar end   -->
                <div class="col-sm-9 "> <!-- rightbar start   -->
                 <div class="w-75 mx-auto bg-dark bg-opacity-25 p-10">
                     <?php
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $query1 = "SELECT * FROM product WHERE product_id = $id";
                        $query_data1 = $conn->query($query1);
                        $data_array1 = mysqli_fetch_assoc($query_data1);

                        $product_id = $data_array1['product_id'];
                        $product_name = $data_array1['product_name'];
                        $product_category = $data_array1['product_category'];
                        $product_code = $data_array1['product_code'];
                        $product_entry_date = $data_array1['product_entry_date'];

                        }

                    if(isset($_POST['product_name'])) {
                        $new_product_id = $_POST['product_id'];
                        $new_product_name = $_POST['product_name'];
                        $new_product_category = $_POST['product_category'];
                        $new_product_code = $_POST['product_code'];
                        $new_product_entry_date = $_POST['product_entry_date'];
                        $query = "SELECT * FROM  product WHERE product_name = '$new_product_name' AND product_id != '$new_product_id'";
                        $query_data = $conn->query($query);

                        if(mysqli_num_rows($query_data)) {
                            echo '<script> alert("This product is already exists.")</script>';
                        } else {

                            $new_query = "UPDATE product SET 
                                    product_name = '$new_product_name', 
                                    product_category = '$new_product_category', 
                                    product_code = '$new_product_code', 
                                    product_entry_date = '$new_product_entry_date' 
                                WHERE product_id = '$new_product_id' ";

                            if($conn->query($new_query)) {
                                echo "Updated Successfully";
                                header('location: list_of_product.php');
                            } 
                            else {
                                echo "Update Failed";
                            }
                        }
                    }
                        
                ?>

                <?php 
                    $query = "SELECT * FROM category";
                    $query_data = $conn->query($query);
                ?>


                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?=$id?>" method="POST">
                    <input type="text" name="product_id" id="" value="<?php echo  $product_id ?>" hidden> 
                    Product Name: <input type="text" name="product_name" id="" value="<?php echo  $product_name ?>" class="form-control"> <br> <br>
                    Product Category: <select name="product_category" id="" class="form-select">
                        <?php
                            
                            while($data_array = mysqli_fetch_array($query_data)) {
                                $category_id = $data_array['category_id'];
                                $category_name = $data_array['category_name'];
                        ?>  
                            <option value='<?php echo $category_id ?>' <?php if($category_id == $product_category) { echo 'selected';} ?> > <?php echo $category_name ?></option>;
                        
                        <?php } ?>

                    </select> <br> <br>
                    Product Code: <input type="text" name="product_code" id="" value="<?php echo  $product_code ?>" class="form-control"> <br> <br>
                    Product Entry Date: <input type="date" name="product_entry_date" id="" value="<?php echo  $product_entry_date ?>" class="form-control"> <br> <br>
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