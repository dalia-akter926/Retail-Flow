<?php
  require('db_connection.php');
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
    <title>Edit Management</title>
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
                <div class="col-sm-9"> <!-- rightbar start   -->
                   <div class="w-75 mx-auto bg-dark bg-opacity-25 p-10">
                   <?php
                        $category_name = '';
                        $category_entry_date = '';
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $query = "SELECT * FROM category WHERE category_id = $id";
                            $query_data = $conn->query($query);
                            $data_array = mysqli_fetch_assoc($query_data);

                            $category_id = $data_array['category_id'];
                            $category_name = $data_array['category_name'];
                            $category_entry_date = $data_array['category_entry_date'];
                    
                        }

                        if(isset($_POST['category_name'])) {
                            $new_category_id = $_POST['category_id'];
                            $new_category_name = $_POST['category_name'];
                            $new_category_entry_date = $_POST['category_entry_date'];

                            $query = "SELECT * FROM  category WHERE category_name = '$new_category_name' AND category_id != '$new_category_id'";

                            $query_data = $conn->query($query);

                            if(mysqli_num_rows($query_data)) {
                                echo '<script> alert("This category is already exists.")</script>';
                            } else {
                                $new_query = "UPDATE category SET 
                                    category_name = '$new_category_name',
                                    category_entry_date = '$new_category_entry_date' 
                                    WHERE category_id = $new_category_id";
                                
                                if($conn->query($new_query) === TRUE) {
                                    echo "Updated Successfully";
                                    header("Location: list_of_category.php");
                                    die();
                                }
                                else {
                                    echo "Update failed";
                                }
                            }

                        }
                    ?>


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?=$id?>" method="POST">
                        <input type="text" name="category_id" id="" value="<?php echo $category_id ?>" hidden >
                        Category: 
                        <input type="text" name="category_name" id="" value="<?php echo $category_name ?>" class="form-control"> <br> <br>
                        Entry Date: 
                        <input type="date" name="category_entry_date" id="" value="<?php echo $category_entry_date ?>" class="form-control"> <br> <br>
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