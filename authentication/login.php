<?php
   session_start();
   include("../config.php");
   
   //called when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $password = mysqli_real_escape_string($db,$_POST['password']); 

      if($_POST['action'] == "client"){
          $email = mysqli_real_escape_string($db,$_POST['email']);
        $sql = "SELECT session_token,client_id FROM mec353_2.client WHERE email = '$email' and password = '$password'";
          $_SESSION['profile_type'] = "personal";
      }elseif($_POST['action'] == "employee"){
          $email = mysqli_real_escape_string($db,$_POST['email']);
        $sql = "SELECT session_token, isAdmin, employee_id FROM mec353_2.employee WHERE email = '$email' and password = '$password'";
      }

      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      
      if($count == '1') {
         $_SESSION['session_token'] = $row["session_token"];

         if($_POST['action'] == "client"){
             $_SESSION['account'] = "client";
             $_SESSION['client_id'] = $row["client_id"];
             header("location: ../client/client-home.php");
         }
         elseif ($_POST['action'] == "employee"){
             $_SESSION['isAdmin'] = $row['isAdmin'];
             $_SESSION['account'] = "employee";
             $_SESSION['employee_id'] = $row["employee_id"];
             header("location: ../employee/employee-home.php");
          }

      }else {
         $error = "Login Name or Password is invalid";
      }
   }
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include("../includes/head-tag-contents.php");?>
        <link rel="stylesheet" type="text/css" href="authentication.css">
    </head>
    <body>

    <?php include("../includes/header.php");?>

        <div class="container" id="main-content">
            <h2>Sign In</h2>
            <form action = "" method = "post" class = "form-box">
                <h3>For Employees</h3>
                <label>Email  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <input type="hidden" name="action" value="employee">
                <input type = "submit" value = " Submit "/><br />
            </form>

            
            <form action = "" method = "post" class = "form-box">
                <h3>For Clients</h3>
                <label>Email  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <input type="hidden" name="action" value="client">
                <input type = "submit" value = " Submit "/><br />
            </form>
        </div>

        <?php include("../includes/footer.php");?>

    </body>
</html>