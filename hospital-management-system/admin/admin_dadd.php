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



  //add to database
  //check if name already exist, if not then add to database
  //otherwise tell that choose another name

  if(do_name_exist($conn, "doctor", $_POST['name']) == 1){
    die("Name already exist, please choose other one.");
  }
  else{
    $d_name = $_POST['name'];
    $d_spl = $_POST['spl'];
    $d_salary = $_POST['salary'];

    $d_pass = $_POST['pass'];
    echo $d_pass;
    //insert record into table
    $query = "
              INSERT INTO doctor(name, spl, salary)
              VALUES ('$d_name', '$d_spl', '$d_salary')
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
              ON $db.doctor
              TO '$d_name'@'localhost'
              ";
    $result = $conn->query($query);
    if(!$result)  die("granting access failed");

  }


?>
