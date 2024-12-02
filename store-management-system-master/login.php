<?php
  require('db_connection.php');
  session_start();      
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2157df5358.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">

    <title>Login</title>
    <style>
      .custom-background{
        background-image: url('360_F_638605652_6ZYMTPCnAtJLhmxSlpuKvkBIdhdPBD7S.jpg'); 
        background-size: cover;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: rgb(255, 255, 255);
      }      
    </style> 
</head>
<body class="custom-background">       
  <div class="container bg-dark bg-opacity-10 p-20">
    <div class="row text-center" > 
      <h3>Welcome to Store-Management System </h3>
      <h4>Please login to access the system</h4>
    </div>
    <br><br>
    <div class="row">

      <div class="w-50 mx-auto p-10" style="background: rgba(173, 216, 230, 0.5); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-radius: 8px;">

        <?php
        if(isset($_POST['user_email'])) {
          $user_email = $_POST['user_email'];
          $user_password = $_POST['user_password'];
          
          $query = "SELECT * FROM  user WHERE user_email = '$user_email' AND user_password = '$user_password'";
          $query_data = $conn->query($query);

          if(mysqli_num_rows($query_data)) {

              $data_array = mysqli_fetch_array($query_data);
              $user_first_name = $data_array['user_first_name'];
              $user_last_name = $data_array['user_last_name'];

              $_SESSION['user_first_name'] = $user_first_name;
              $_SESSION['user_last_name'] = $user_last_name;

              header('location: index.php');
          } 
          else{
              echo '<script> alert("Invalid email or password")</script>';
          }
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">        
    <div style="text-align: left;">
        <label for="user_email" style="font-size: 1.25rem;">Email:</label>
        <input type="email" name="user_email" id="user_email" class="form-control bg-light bg-opacity-75" placeholder="User Email"> <br> <br>
        
        <label for="user_password" style="font-size: 1.25rem;">Password:</label>
        <input type="password" name="user_password" id="user_password" class="form-control bg-light bg-opacity-75" placeholder="Password"> <br> <br>
    </div>
    <input type="submit" class="btn btn-secondary" value="Login" style="padding: 10px 20px; font-size: 1.25rem;">

</form>

      </div>
    </div>
  </div>
</body>
</html>