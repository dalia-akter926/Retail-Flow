<?php
   require('db_connection.php');

     if($_GET['id']) {
     $id = $_GET['id'];

     $query = "DELETE FROM category WHERE category_id = $id ";

     if($conn->query($query)) {
        echo "deleted";
        header('location: list_of_category.php');
     } else {
        echo "error";
     }
   }
?>

