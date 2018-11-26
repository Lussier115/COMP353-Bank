<?php
    session_start();
    include('../config.php');
    include('../session.php');

    $current_employee_id = $_SESSION['employee_id'];
    $sql = "SELECT * FROM mec353_2.branch, mec353_2.employee 
			WHERE mec353_2.employee.employee_id = '$current_employee_id' 
			  AND mec353_2.employee.branch_id = mec353_2.branch.branch_id";

    $sql2 = "SELECT * FROM  mec353_2.employee, mec353_2.schedule 
			WHERE mec353_2.employee.employee_id = '$current_employee_id' 
			  AND mec353_2.employee.employee_id = mec353_2.schedule.employee_id";

    $result = mysqli_query($db, $sql);
    $result2 = mysqli_query($db, $sql2);
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("../includes/head-tag-contents.php"); ?>
	<link rel="stylesheet" type="text/css" href="employee.css">
</head>
<body>

<?php include("../includes/header.php"); ?>
<?php include("employee-nav.php"); ?>

<div class="container" id="main-content">
    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                print "<div>
						<h2> Welcome " . $row['title'] . ", " . $row['first_name'] . "</h2>
						<div class='employee-info'>
							<label class='label-title'><strong> Your Employee Information:</strong></label><br />
							<label> First Name: </label> " . $row['first_name'] . " <br />
							<label> Last Name: </label> " . $row['last_name'] . " <br />
							<label> Email: </label> " . $row['email'] . " <br />
							<label> Address: </label> " . $row['address'] . " <br />
							<label> Phone: </label> " . $row['phone'] . " <br />
							<label> Start Date: </label> " . $row['start_date'] . " <br />
							<label> Salary: </label> " . $row['salary'] . " <br />
						</div>
					</div>";

            }
        }
    ?>

    <?php
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
    ?>
</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>