<?php
 require('db_connection.php');
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
    <title>List of Category</title>
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
                <div class="col-sm-9 px-10 "> <!-- rightbar start   -->
                <?php
                    $query = "SELECT * FROM category ORDER BY category_id DESC";
                    $query_data = $conn->query($query);
                    echo "<table class='table table-striped table-hover'>
                        <tr> 
                            <th>Category</th> 
                            <th>Entry Date</th> 
                            <th>Action-1</th> 
                            <th>Action-2</th> 
                        </tr>";
                    while($data_array = mysqli_fetch_assoc($query_data)) {
                        $category_id = $data_array['category_id'];
                        $category_name = $data_array['category_name'];
                        $category_entry_date = $data_array['category_entry_date'];

                    echo "<tr>
                            <td>$category_name</td>
                            <td>$category_entry_date</td>
                            <td><a class='btn btn-secondary opacity-75' href='edit_category.php?id=$category_id'>Edit</a></td>
                            <td><a class='btn btn-danger opacity-75' href='delete_category.php?id=$category_id'>Delete</a></td>
                            </tr>";   
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