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
    <title>Add User</title>
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
                    <div class="container col-9 px-10 py-4  bg-secondary bg-opacity-50">
                    <?php
                        if(isset($_GET['user_first_name'])) {
                        $user_first_name = $_GET['user_first_name'];
                        $user_last_name = $_GET['user_last_name'];
                        $user_email = $_GET['user_email'];
                        $user_password = $_GET['user_password'];
                        
                        
                        $query = "INSERT INTO user (user_first_name, user_last_name, user_email, user_password ) VALUES ( '$user_first_name', '$user_last_name', '$user_email', '$user_password')";
                            
                        if($conn->query($query) === TRUE) {
                            echo "Data inserted successfully";
                        } 
                        else{
                            echo "Error: " . $query . "<br>" . $conn->error;
                        }


                        }
                    ?>

                    


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                        First Name: <input type="text" name="user_first_name" id="" class="form-control"> <br> <br>
                        Last Name: <input type="text" name="user_last_name" id="" class="form-control"> <br> <br>
                        Email: <input type="email" name="user_email" id="" class="form-control"> <br> <br>
                        Password: <input type="password" name="user_password" id="" class="form-control"> <br> <br>
                        <input type="submit" class="btn btn-secondary" value="Register">
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
     } else {
        header('location: login.php');
     }  
?>