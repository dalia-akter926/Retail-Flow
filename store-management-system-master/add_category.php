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
    <title>Store Management</title>
    <?php include('template.php') ;?>
</head>
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
                    <div class="container col-9 p-10  bg-secondary bg-opacity-50">
                    <?php
                    if(isset($_POST['category_name'])) {
                        $category_name = $_POST['category_name'];
                        if(trim($category_name=="")) {
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                            die();
                        }

                        $query = "SELECT * FROM  category WHERE category_name = '$category_name'";
                        $query_data = $conn->query($query);

                        if(mysqli_num_rows($query_data)) {
                            echo '<script> alert("This category is already exists.")</script>';
                        } else {
                            $category_entry_date = $_POST['category_entry_date'];
                            // echo $category_name, $category_entry_date;
                            $query = "INSERT INTO category (category_name, category_entry_date ) VALUES ( '$category_name', '$category_entry_date')";
                                
                            if($conn->query($query) === TRUE) {
                                echo "Data inserted successfully";
                                header('location: list_of_category.php');
                                die();
                            } 
                            else{
                                echo "Error: " . $query . "<br>" . $conn->error;
                            }
                        }
                    }
                    ?>                    
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        Category: 
                        <input type="text" name="category_name" id="" class="form-control"> <br> <br>
                        Entry Date: 
                        <input type="date" name="category_entry_date" id="" class="form-control"> <br> <br>
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