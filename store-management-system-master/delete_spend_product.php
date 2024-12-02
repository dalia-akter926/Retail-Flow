<?php
   require('db_connection.php');

     if($_GET['id']) {
     $id = $_GET['id'];

     $query = "DELETE FROM spend_product WHERE spend_product_id = $id ";

     if($conn->query($query)) {
        echo "deleted";
        header('location: list_of_spend_product.php');
     } else {
        echo "error";
     }
   }
?>

