<?php
   require('db_connection.php');

     if($_GET['id']) {
     $id = $_GET['id'];

     $query = "DELETE FROM store_product WHERE store_product_id = $id ";

     if($conn->query($query)) {
        echo "deleted";
        header('location: list_of_entry_product.php');
     } else {
        echo "error";
     }
   }
?>

