<?php
echo <<<_END
<!DOCTYPE html>
<html>
<head>
<style>
body {
  margin: 0;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 25%;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #4CAF50;
  color: white;
}

li a:hover:not(.active) {
  background-color: #555;
  color: white;
}

form  { display: table;      }
p     { display: table-row;  }
label { display: table-cell; }
input { display: table-cell; }

</style>
</head>
<body>
<ul>
  <li><a  class="active" href="patient_session.php">Profile</a></li>
</ul>

<div style="margin-left:25%;padding:1px 16px;height:1000px;">

_END;


session_start();
$name = $_SESSION['name'];
$password = $_SESSION['password'];

echo "<b style = 'font-size:200%'> Welcome! </b><br>";
if(isset($_SESSION['name'])){
  $name = $_SESSION['name'];
  echo "<b> Hello $name</b> <br>";

  //all error showing
  error_reporting(E_ALL);
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);


  //adding configuration file
  require_once(__DIR__.'/../admin_config.php');
  require_once(__DIR__.'/../utils.php');

  //connecting to mysql
  $conn = new mysqli($hn, $name, $password, $db);
  if ($conn->connect_error) {
    die("Fatal Error <br>");
  }

  show_table_columns("patient");
  $query = "
            SELECT *
            FROM hospital.patient
            WHERE name LIKE '$name'
            ";

  display_sql_query($conn, "patient", $query);
}



echo <<<_END
</div>

</body>
</html>

_END;



 ?>
