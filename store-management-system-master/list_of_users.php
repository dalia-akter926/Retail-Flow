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
    <title>List of Users</title>
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
                        $query = "SELECT * FROM user";
                        $query_data = $conn->query($query);
                        echo "<table class='table table-striped table-hover'>
                            <tr> 
                                <th>First Name</th> 
                                <th>Last Name</th> 
                                <th>Email</th> 
                                <th>Action</th> 
                            </tr>";
                        while($data_array = mysqli_fetch_assoc($query_data)) {
                            $user_id = $data_array['user_id'];
                            $user_first_name = $data_array['user_first_name'];
                            $user_last_name = $data_array['user_last_name'];
                            $user_email = $data_array['user_email'];

                        echo "<tr>
                                <td>$user_first_name</td>
                                <td>$user_last_name</td> 
                                <td>$user_email</td>
                                <td> <a class='btn btn-secondary' href='edit_user.php?id=$user_id'>Edit</a> </td>
                                </tr>";   
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