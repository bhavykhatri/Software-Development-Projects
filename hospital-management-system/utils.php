<?php
  function display_sql_results($result){
    if(!$result)  die("displaying sql result failed");

    $rows = $result->num_rows;

    echo <<<_END
    <style>
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}

tr:nth-child(even) {
background-color: #dddddd;
}
</style>
_END;



    // echo "No of rows are: ".$rows."<br>";
    echo "<table>";
    for($i = 0; $i<$rows; $i++){
      $row = $result->fetch_array(MYSQLI_NUM);
      echo "<tr>";
      $array_len = count($row);
      for($j = 0; $j<$array_len; $j++){
        echo "<td>".$row[$j]."</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    // var_dump($result);
  }

  function show_table_columns($table){
    echo <<<_END
    <style>
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}

tr:nth-child(even) {
background-color: #dddddd;
}
</style>
_END;
    if($table == "doctor"){
      echo "<table>";
        echo "<tr>";
        echo "<th>Doctor Id</th>";
        echo "<th>Name</th>";
        echo "<th>Speciality</th>";
        echo "<th>Salary</th>";
        echo "</tr>";
      echo "</table>";
    }
    elseif($table == "patient"){
      echo "<table>";
        echo "<tr>";
        echo "<th>Patient Id</th>";
        echo "<th>Name</th>";
        echo "<th>Disease</th>";
        echo "<th>Status</th>";
        echo "<th>Doctor Id</th>";
        echo "<th>Payment</th>";

        echo "</tr>";
      echo "</table>";
    }

  }

  function show_post_variables(){
      echo "Post associative array <br>";
      $keys = array_keys($_POST);
      $n = count($_POST);

      for($i=0; $i < $n; ++$i) {
        echo $keys[$i] . ' ' . $_POST[$keys[$i]] . "<br>";
      }

  }

  //given a table and query on that particular table this shows the result
  function display_sql_query($conn, $table, $query){
      $result = $conn->query($query);
      display_sql_results($result);
  }

  function find_doctor_id($conn, $name){
    $query = "
              SELECT *
              FROM hospital.doctor
              WHERE name LIKE '$name'
              ";

    $result = $conn->query($query);
    if(!$result) die("error in do_name_exist function");

    $row = $result->fetch_array(MYSQLI_NUM);

    return $row[0];
  }

  function do_name_exist($conn, $table, $name){

    $query = "select count(name) from $table where name like '$name' ";
    $result = $conn->query($query);
    if(!$result) die("error in do_name_exist function");

    $row = $result->fetch_array(MYSQLI_NUM);
    // echo "no of elements are: ".$row[0];

    if($row[0] == 0){
      return 0;
    }
    else{
      return 1;
    }
  }



 ?>
