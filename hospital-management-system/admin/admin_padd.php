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




  //add to database
  //check if name already exist, if not then add to database
  //otherwise tell that choose another name

  if(do_name_exist($conn, "patient", $_POST['name']) == 1){
    die("Name already exist, please choose other one.");
  }
  else{
    $d_name = $_POST['name'];
    $d_disease = $_POST['disease'];
    $d_status = $_POST['status'];
    $d_did = $_POST['did'];
    $d_payment = $_POST['payment'];

    $d_pass = $_POST['pass'];
    
    //insert record into table
    $query = "
              INSERT INTO patient(name, disease, status, did, payment)
              VALUES ('$d_name', '$d_disease', '$d_status', '$d_did', '$d_payment')
              ";
    $result = $conn->query($query);
    // die(mysqli_error($db));
    if(!$result)  die("Inserting record into database failed");

    //create a user and grant access to it
    $query = "
              CREATE USER '$d_name'@'localhost'
              IDENTIFIED BY '$d_pass';
              ";
    $result = $conn->query($query);
    if(!$result)  die("creating user failed reasons might be: <br>
                      either user already exist in database and as user name
                      <br> query is wrong!");

    //grant privilege
    $query = "
              GRANT
                SELECT
              ON $db.*
              TO '$d_name'@'localhost'
              ";
    $result = $conn->query($query);
    if(!$result)  die("granting access failed");

  }


?>
