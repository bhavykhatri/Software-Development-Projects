<?php




  //all error showing
  error_reporting(E_ALL);
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);


  //adding configuration file
  require_once(__DIR__.'/../admin_config.php');
  require_once(__DIR__.'/../utils.php');

  //connecting to mysql
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) {
    die("Fatal Error <br>");
  }
  

  $table = $_POST['role'];
  $search_name = $_POST['name'];
  $entries = $_POST['entries'];

  //Shows top row coloumns based on the table
  show_table_columns($table);

  $query = "
            SELECT *
            FROM hospital.$table
            ";
  if($search_name == "" && $entries == ""){
    ;
  }
  elseif($search_name != "" && $entries == ""){
    $query = $query." WHERE name LIKE '%$search_name%'";

  }
  elseif($search_name == "" && $entries != ""){
    $query = $query." LIMIT $entries";
  }
  elseif($search_name != "" && $entries != ""){
    $query = $query." WHERE name LIKE '%$search_name%'";
    $query = $query." LIMIT $entries";
  }

  display_sql_query($conn, $table, $query);



?>
