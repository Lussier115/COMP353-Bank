<?php
   session_start();
   include("../config.php");
   
   //called when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $password = mysqli_real_escape_string($db,$_POST['password']); 

      if($_POST['action'] == "client"){
        $credit_card = mysqli_real_escape_string($db,$_POST['credit_card']);
        $sql = "SELECT * FROM Client WHERE credit_card = '$credit_card' and password = '$password'";
      }elseif($_POST['action'] == "employee"){
        $email_address = mysqli_real_escape_string($db,$_POST['email_address']);
        $sql = "SELECT * FROM Employee WHERE email_address = '$email_address' and password = '$password'";
      }
      

      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);// If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count == 1) {
          ##NOT SURE YET
         session_register("myusername");
         $_SESSION['login_user'] = $username;
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
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
                <label>Credit Card  :</label><input type = "text" name = "credit_card" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <input type="hidden" name="action" value="client">
                <input type = "submit" value = " Submit "/><br />
            </form>
        </div>

        <?php include("../includes/footer.php");?>

    </body>
</html>