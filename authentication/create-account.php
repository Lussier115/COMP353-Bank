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
        $first_name = mysqli_real_escape_string($db,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($db,$_POST['last_name']);
        $email_address = mysqli_real_escape_string($db,$_POST['email_address']);
        $address = mysqli_real_escape_string($db,$_POST['address']);
        $phone = mysqli_real_escape_string($db,$_POST['phone']);
        if($_POST['action'] == "client"){
            $credit_card = mysqli_real_escape_string($db,$_POST['credit_card']);
            $birthday = mysqli_real_escape_string($db,$_POST['birthday']);
            $join_date = date();
            $sql = "INSERT INTO Client(
                credit_card, password, first_name, last_name, email_address, address, phone, birthday, join_date, session_token) VALUES(
                    $credit_card, $password, $first_name, $last_name, $email_address, $address, $phone, $join_date, $session_token)";
            createAccount($sql);
        }elseif($_POST['action'] == "employee"){
            $is_admin = mysqli_real_escape_string($db,$_POST['is_admin']);
            $title = mysqli_real_escape_string($db,$_POST['title']);
            $start_date = mysqli_real_escape_string($db,$_POST['start_date']);
            $salary = mysqli_real_escape_string($db,$_POST['salary']);

            $sql = "INSERT INTO Employee(
                password, first_name, last_name, email_address, address, phone, title, start_date, salary, isAdmin, session_token) 
                VALUES($password, $first_name, $last_name, $email_address, $address, $phone, $title, $start_date, $salary, $is_admin, $session_token)";
            createAccount($sql);
            setcookie("session_token", $session_token, (86400 * 30));//name - value - expiry(30 days)
        }

        function createAccount($sqlQuerry){
            $result = mysqli_query($db,$sqlQuerry);
            print("CREATE ACCOUNT!!!");
            print($result);
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
    <?php include("../includes/header.php"); ?>
        <div class="container" id="main-content">
            <h2>Create Account</h2>
            
            
            <form action = "" method = "post" class = "form-box">
                <h3>For Employees</h3>
                <label>Email  :</label><input type = "email_address" name = "email_address" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <label>First Name  :</label><input type = "text" name = "first_name" class = "box"/><br /><br />
                <label>Last Name  :</label><input type = "text" name = "last_name" class = "box"/><br /><br />
                <label>Title  :</label><input type = "text" name = "title" class = "box"/><br /><br />
                <label>Phone Number :</label><input type = "tel" name = "phone" class = "box"/><br /><br />
                <label>Start Date  :</label><input type = "date" name = "start_date" class = "box"/><br /><br />
                <label>Address :</label><input type = "text" name = "address" class = "box"/><br /><br />
                <label>Salary  :</label><input type = "number" name = "salary" class = "box"/><br /><br />
                <label>isAdmin  :</label><input type = "checkbox" name = "is_admin" class = "box" /><br/><br/>
                <input type="hidden" name="action" value="employee">
                <input type = "submit" value = " Submit "/><br />
            </form>

            
            <form action = "" method = "post" class = "form-box">
                <h3>For Clients</h3>
                <label>Credit Card  :</label><input type = "text" name = "credit_card" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <label>First Name  :</label><input type = "text" name = "first_name" class = "box"/><br /><br />
                <label>Last Name  :</label><input type = "text" name = "last_name" class = "box"/><br /><br />
                <label>email_address  :</label><input type = "email_address" name = "email_address" class = "box"/><br /><br />
                <label>Phone Number :</label><input type = "tel" name = "phone" class = "box"/><br /><br />
                <label>Address :</label><input type = "text" name = "address" class = "box"/><br /><br />
                <label>Date of Birth :</label><input type = "date" name = "birthday" class = "box"/><br /><br />
                <!--<label>Category? :</label><input type = "text" name = "address" class = "box"/><br /><br />-->
                <!--<label>Satisfactory months? :</label><input type = "text" name = "address" class = "box"/><br /><br />-->
                <!--<label>Charge Plan? :</label><input type = "text" name = "address" class = "box"/><br /><br />-->
                <label>Address :</label><input type = "text" name = "address" class = "box"/><br /><br />
                <input type="hidden" name="action" value="client">
                <input type = "submit" value = " Submit "/><br />
            </form>
        </div>

        <?php include("../includes/footer.php");?>

    </body>
</html>