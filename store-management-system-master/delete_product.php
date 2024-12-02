<?php
   require('db_connection.php');

     if($_GET['id']) {
     $id = $_GET['id'];

     $query = "DELETE FROM product WHERE product_id = $id ";

     if($conn->query($query)) {
        echo "deleted";
        header('location: list_of_product.php');
     } else {
        echo "error";
     }
   }
?>

