<?php
function show_data_options($table_name, $column_1, $column_2) {
    require('db_connection.php');
        $query = "SELECT * FROM $table_name";
        $query_data = $conn->query($query);

    while($data_array = mysqli_fetch_array($query_data)) {
        $data_id = $data_array[$column_1];
        $data_name = $data_array[$column_2];
    
    echo "<option value='$data_id'>$data_name</option>";
   };
  } 
?>