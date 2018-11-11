<?php
   session_start();
   include("../config.php");

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }   
   
    //called when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $session_token = generateRandomString();
        $password = mysqli_real_escape_string($db,$_POST['password']);
        $first_name = mysqli_real_escape_string($db,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($db,$_POST['last_name']);
        $email_address = mysqli_real_escape_string($db,$_POST['email_address']);
        $address = mysqli_real_escape_string($db,$_POST['address']);
        $phone = mysqli_real_escape_string($db,$_POST['phone']);

        if($_POST['action'] == "client"){

            $date_of_birth = mysqli_real_escape_string($db,$_POST['birthday']);
            $join_date = date('Y-d-m');
            $branch_id = '1';

            $sql = "INSERT INTO `mec353_2`.`client`(`password`, `first_name`, `last_name`, `email`, `address`, `phone`, `date_of_birth`, `joining_date`, `session_token`, `branch_id`) VALUES('$password', '$first_name', '$last_name', '$email_address', '$address', '$phone', '$date_of_birth', '$join_date', '$session_token', '$branch_id')";

            mysqli_query($db,$sql);
            setcookie("session_token", $session_token, (86400 * 30));//name - value - expiry(30 days)

        }elseif($_POST['action'] == "employee"){
            $is_admin = mysqli_real_escape_string($db, $_POST['is_admin']) == 'on' ? 1 : 0;
            $title = mysqli_real_escape_string($db,$_POST['title']);
            $start_date = mysqli_real_escape_string($db,$_POST['start_date']);
            $salary = mysqli_real_escape_string($db,$_POST['salary']);

            $branch_id = '1';

            $sql = "INSERT INTO `mec353_2`.`employee`(`password`, `first_name`, `last_name`, `email`, `address`, `phone`, `title`, `start_date`, `salary`, `isAdmin`, `session_token`, `branch_id`) 
                VALUES('$password', '$first_name', '$last_name', '$email_address', '$address', '$phone', '$title', '$start_date', '$salary', '$is_admin', '$session_token', '$branch_id')";

            mysqli_query($db,$sql);
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
                <label>First Name  :</label><input type = "text" name = "first_name" class = "box"/><br /><br />
                <label>Last Name  :</label><input type = "text" name = "last_name" class = "box"/><br /><br />
                <label>Email Address  :</label><input type = "email_address" name = "email_address" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br/>
                <label>Phone Number :</label><input type = "tel" name = "phone" class = "box"/><br /><br />
                <label>Address :</label><input type = "text" name = "address" class = "box"/><br /><br />
                <label>Date of Birth :</label><input type = "date" name = "birthday" class = "box"/><br /><br />
                <input type="hidden" name="action" value="client">
                <input type = "submit" value = " Submit "/><br />
            </form>
        </div>

        <?php include("../includes/footer.php");?>

    </body>
</html>