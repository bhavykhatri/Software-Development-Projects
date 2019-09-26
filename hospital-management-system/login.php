<?php
echo <<<_END
      <html>
      <body>

      <h2>Hospital Management System</h2>
      <h3>Login Page </h3>

      <form action="login.php" method="post">
      Role:<br>
        <input type="radio" name="role" value="admin" > Admin
        <input type="radio" name="role" value="patient" checked> Patient
        <input type="radio" name="role" value="doctor" checked> Doctor <br>
        Name:<br> <input type="text" name="name" value = "Trehan"><br>
        Password: <br> <input type="password" name="pass" value="1234568"><br>
        <input type="submit" value = "Login">
      </form>

      </body>
      </html>
_END;




  if(isset($_POST['role']) && isset($_POST['name']) && isset($_POST['pass']) ){

    //First making a connection through root user
    //then check if the user name exist in the database
    //check if using password you are able to make a connection or not

    //all error showing
      error_reporting(E_ALL);
      ini_set('display_startup_errors', 1);
      ini_set('display_errors', 1);


      //adding configuration file
      require_once(__DIR__.'/admin_config.php');
      require_once(__DIR__.'/utils.php');

      //connecting to mysql
      $conn = new mysqli($hn, $un, $pw, $db);
      if ($conn->connect_error) {
        die("Fatal Error <br>");
      }
      else {
        echo "Connection to mysql established! <br>";
      }

      $role = $_POST['role'];
      $username = $_POST['name'];
      $password = $_POST['pass'];
      //check if user name exist in database
      if(do_name_exist($conn, $role, $_POST['name']) == 1){


          $conn_user = new mysqli($hn, $username, $password, $db);
          if ($conn_user->connect_error) {
            echo "<script>
                    alert('invalid password');
                  </script>";
          }
          else {
            //send it to patient.html page
            echo "Successfully logged in! <br>";

            session_start();
            $_SESSION['name'] = $username;
            $_SESSION['password'] = $password;
            //take it to other page based on the role
            if($role == "doctor"){
              header("location: /hms/doctor/doctor_session.php");
            }
            elseif($role == "patient"){
              header("location: /hms/patient/patient_session.php");
            }
          }
      }
      else{
        echo "<script>
                alert('invalid username');
              </script>";
        //die("wrong username");
      }

    }

 ?>
