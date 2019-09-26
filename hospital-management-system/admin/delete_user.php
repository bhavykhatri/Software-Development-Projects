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
  else {
    echo "Connection to mysql established! <br>";
  }




  if(do_name_exist($conn, $_POST['role'], $_POST['name']) == 0){
    die("<b>Name doesn't exist in database.</b>");
  }
  else{
    $table = $_POST['role'];
    $name = $_POST['name'];
    //3 steps:
    //Revoke all permissions for the user
    //Delete user
    //Remove entry from the table

    //permissions revoke
    $query = "
              REVOKE ALL PRIVILEGES, GRANT OPTION
              FROM '$name'@'localhost'
              ";
    $result = $conn->query($query);
    if(!$result)  die("Permission revokation failed");


    //remove user
    $query = "
              DROP USER '$name'@'localhost'
              ";
    $result = $conn->query($query);
    if(!$result)  die("Dropping/Removing user failed");

    //remove  record from table
    $query = "
              DELETE FROM hospital.$table
              WHERE name LIKE '$name'
              ";
    $result = $conn->query($query);
    // die(mysqli_error($db));
    if(!$result)  die("Removing record from table failed");


    echo "<b>Record and user removed successfully!</b><br>";

  }


?>
