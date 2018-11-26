<?php
    /**
     * Created by PhpStorm.
     * User: william
     * Date: 26/11/18
     * Time: 11:42 AM
     */

    session_start();
    include('../config.php');
    include('../session.php');

    if ($_SESSION['isAdmin'] == "0") {
        header("location: /authentication/login.php");
    }
    $current_id = $_SESSION['employee_id'];

    $sql = "SELECT * FROM mec353_2.employee where NOT(employee.employee_id = '$current_id')";
    $result = mysqli_query($db, $sql);
    ?>

<!DOCTYPE html>
<html>
<head>
    <?php include("../includes/head-tag-contents.php"); ?>
</head>
<body>
<?php include("../includes/header.php"); ?>
<?php include("employee-nav.php"); ?>
<div class="container">

    <h2>View All Employees</h2>

    <?php
        echo "<table class='view-employee' border=''>";
        echo "<tr> <th>Title</th><th>First Name</th><th> Last Name</th><th> Address </th><th> Phone</th><th>Salary</th><th>Schedule & Payroll</th></tr>";

        if ($result->num_rows > 0) {
            // output data of each row

            while ($row = $result->fetch_assoc()) {

                echo "<tr>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['first_name']. "</td>
                        <td>".$row['last_name']."</td> 
                        <td>".$row['address']."</td> 
                        <td>".$row['phone']. "</td>
                        <td>".$row['salary'] . "$" ."</td>
                        <td>
                            <form method='post'>
                                <button type='submit' name='id' value=". $row['employee_id']. "> View </button>
                            </form>
                        </td>
                      </tr>";

            }
            echo "</table>";
        }
    ?>


    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $select_employee = $_POST['id'];

            $sql2 = "SELECT * FROM  mec353_2.schedule 
			WHERE mec353_2.schedule.employee_id = '$select_employee'";

            $result2 = mysqli_query($db, $sql2);

            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {

                    echo "<div>
						<div class='employee-schedule'>
							<label class='label-title'> <strong> Schedule and Payroll Information:</strong> </label><br />
							<label> Work Day Schedule: </label> " . $row['work_days_time'] . " <br />
							<label> Monthly Payroll Day: </label> " . $row['monthly_payroll'] . " <br />
							<label> Holidays: </label> " . $row['holidays'] . " <br />
							<label> Sickdays: </label> " . $row['sickdays'] . " <br />
						</div>
					</div>";

                }
            }
        }



    ?>

</div>
<?php include("../includes/footer.php"); ?>

</body>
</html>