<?php
  require('db_connection.php');
  session_start();
  $user_first_name = $_SESSION['user_first_name'];
  $user_last_name = $_SESSION['user_last_name'];

  if(!empty($user_first_name) && !empty($user_last_name)) { 

    $query1 = "SELECT * FROM product";
    $query1_data = $conn->query($query1);
   
    $all_product = array();
   
    while($data_array1 = mysqli_fetch_assoc($query1_data)) {
       $product_id = $data_array1['product_id'];
       $product_name = $data_array1['product_name'];
   
       $all_product[$product_id] = $product_name;
    };
      
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
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
                    <div class="col-sm-10 mx-auto bg-dark bg-opacity-25 p-10">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                        Select Product: <select name="product_name" id="" class="form-select">
                        <?php
                            $query = "SELECT * FROM product";
                            $query_data = $conn->query($query);
                            
                            while($data_array = mysqli_fetch_assoc($query_data)) {
                                $product_id = $data_array['product_id'];
                                $product_name = $data_array['product_name'];
                                
                            
                        ?>
                            
                            <option value="<?php echo $product_id ?>"> <?php echo $product_name ?> </option>
                            <?php } ?>
                            </select> 
                            <input type="submit" class="btn btn-secondary mt-4" value="Generate Report">
                        </form>
                        
                        
                        <?php
                        $total_store_product = 0;
                        $total_spend_product = 0;
                        //  report store product data
                            if(isset($_GET['product_name'])) {
                                echo "<h5 class='mt-8'>Store Product Report</h5>";
                                $product_name2 = $_GET['product_name']; 
                                $query2 = "SELECT * FROM store_product WHERE store_product_name = $product_name2";
                                $query_data2 = $conn->query($query2);

                                while($data_array = mysqli_fetch_array($query_data2)) {
                                    $store_product_name = $data_array['store_product_name'];
                                    $store_product_quantity = $data_array['store_product_quantity'];
                                    $store_product_entry_date = $data_array['store_product_entry_date'];

                                    echo "<p class='fw-semibold'>$all_product[$store_product_name]</p>";
                                    echo "<table class='table table-striped table-hover'><tr><td>Store Date</td> <td>Quantity</td></tr>";
                                    echo "<tr><td>$store_product_entry_date</td> <td>$store_product_quantity</td></tr>";
                                    echo "</table";

                                    $total_store_product += $store_product_quantity;
                                }

                                
                            }
                        ?>
                        <br>
                        
                        <?php
                        //  report spend product data
                            if(isset($_GET['product_name'])) {
                                echo "<h5 class='mt-8'>Spend Product Report</h5>";
                                $product_name3 = $_GET['product_name']; 
                                $query3 = "SELECT * FROM spend_product WHERE spend_product_name = $product_name3";
                                $query_data3 = $conn->query($query3);
                                
                                while($data_array = mysqli_fetch_array($query_data3)) {
                                    $spend_product_name = $data_array['spend_product_name'];
                                    $spend_product_quantity = $data_array['spend_product_quantity'];
                                    $spend_product_entry_date = $data_array['spend_product_entry_date'];
                                    
                                    echo "<p class='fw-semibold'>$all_product[$spend_product_name]</p>";
                                    echo "<table class='table table-striped table-hover'><tr><td>spend Date</td> <td>Quantity</td></tr>";
                                    echo "<tr><td>$spend_product_entry_date</td> <td>$spend_product_quantity</td></tr>";
                                    echo "</table";

                                    $total_spend_product += $spend_product_quantity;
                                }

                                
                            }
                        ?>
                        <br>
                        <h5 class="mt-8">Remaining Product Report</h5>
                        <table class='table table-striped table-hover'>
                            <tr>
                                <td>Remaining QTY</td> 
                            </tr>
                            <tr>
                                <td><?php echo ($total_store_product - $total_spend_product) ?></td>
                            </tr>
                            
                        </table>


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