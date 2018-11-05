<?php
   session_start();
   include("../config.php");

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }   
   
    //called when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //more parameters to come
        $session_token = generateRandomString();
        $password = mysqli_real_escape_string($db,$_POST['password']);
        if($_POST['action'] == "client"){
            $credit_card = mysqli_real_escape_string($db,$_POST['credit_card']);
            $sql = "INSERT INTO Client(credit_card, password, session_token) VALUES($credit_card, $password, $session_token)";
            $result = mysqli_query($db,$sql);
        }elseif($_POST['action'] == "employee"){
            $username = mysqli_real_escape_string($db,$_POST['username']);
            $is_admin = mysqli_real_escape_string($db,$_POST['is_admin']);
            $sql = "INSERT INTO Employee(username, password, isAdmin, session_token) VALUES($username, $password, $is_admin, $session_token)";
            $result = mysqli_query($db,$sql);
            setcookie("session_token", $session_token, (86400 * 30));//name - value - expiry(30 days)
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

        <div class="container" id="main-content">
            <h2>Create Account</h2>
            
            
            <form action = "" method = "post" class = "form-box">
                <h3>For Employees</h3>
                <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <label>isAdmin  :</label><input type = "checkbox" name = "is_admin" class = "box" /><br/><br/>
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