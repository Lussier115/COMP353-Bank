<?php
    session_start();
	include("../config.php");
    include('../session.php');

    if($_SESSION['isAdmin'] == "0"){
        header("location: /authentication/login.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $employee_id = $_POST['chosen_employee'];

        #print($employee_id);
        $work = $payroll = $holidays = $sickdays = "";

        if (empty($_POST["work"])) {
            $work = "";
        } else {
            $work = mysqli_real_escape_string($db, $_POST["work"]);
            #print($work);
        }

        if (empty($_POST["payroll"])) {
            $payroll = "";
        } else {
            $payroll = mysqli_real_escape_string($db, $_POST["payroll"]);
            #print($work);
        }

        if (empty($_POST["holidays"])) {
            $holidays = "";
        } else {
            $holidays = mysqli_real_escape_string($db, $_POST["holidays"]);
            #print($holidays);
        }

        if (empty($_POST["sickdays"])) {
            $sickdays = "";
        } else {
            $sickdays = mysqli_real_escape_string($db, $_POST["sickdays"]);
            #print($sickdays);
        }

        $sql = "SELECT employee_id FROM mec353_2.schedule WHERE employee_id = $employee_id";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) == 0) {
            #print("Insert inputs in Employee Schedule table");
            $sql = "INSERT INTO `mec353_2`.`schedule`(`employee_id`, `work_days_time`, `monthly_payroll`, `holidays`, `sickdays`) VALUES('$employee_id', '$work', '$payroll', '$holidays', '$sickdays')";

            mysqli_query($db, $sql);
            #print("DONE");
        } else {
            #print("Update Employee Schedule table with Inputs");

            if (strlen($work) == 0) {
                #print("work empty string, don't update");
            } else {
                #print("Update work_days_time in Employee Schedule table");
                $sql1 = "UPDATE mec353_2.schedule SET work_days_time = '$work' WHERE `employee_id` = '$employee_id'";
                mysqli_query($db, $sql1);
            }

            if (strlen($payroll) == 0) {
                #print("payroll empty string, don't update");
            } else {
                #print("Update monthly_payroll in Employee Schedule table");
                $sql2 = "UPDATE mec353_2.schedule SET monthly_payroll = '$payroll' WHERE `employee_id` = '$employee_id'";
                mysqli_query($db, $sql2);
            }
            if (strlen($holidays) == 0) {
                #print("\n holidays empty string, don't update");
            } else {
                #print("Update holidays in Employee Schedule table");
                $sql3 = "UPDATE mec353_2.schedule SET holidays = '$holidays' WHERE `employee_id` = '$employee_id'";
                mysqli_query($db, $sql3);
            }

            if (strlen($sickdays) == 0) {
                #print("sickdays empty string, don't update");
            } else {
                #print("Update sickdays in Employee Schedule table");
                $sql4 = "UPDATE mec353_2.schedule SET sickdays = '$sickdays' WHERE `employee_id` = '$employee_id'";
                mysqli_query($db, $sql4);
            }
        }
    }

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

<div class="card" id="">
	<div class="card-body">
		<form action="" method="post" id="payroll">
			<legend class="text-center">Employee Schedule, Payroll, Holidays & Sickdays</legend>
			<div class="form-group">
				<label for="work">Work Day Schedule</label>
				<input type="text" class="form-control" name="work" placeholder="Ex: Mon-Fri-8:00-16:00">
			</div>
			<div class="form-group">
				<label for="payroll">Monthly Payroll Day</label>
				<input type="text" class="form-control" name="payroll" placeholder="Ex: Last Friday of the month">
			</div>
			<div class="form-group">
				<label for="holidays">Holidays</label>
				<input type="text" class="form-control" name="holidays" placeholder="Ex: Aug 17 - Sept 12">
			</div>
			<div class="form-group">
				<label for="sickdays">Sickdays</label>
				<input type="text" class="form-control" name="sickdays" placeholder="Ex: Feb 13, May 9, May 10">
			</div>

			<label for="chosen_employee">Employee</label> <br/>
			<?php include('employee-selection.php') ?>

			<input type="submit" class="btn btn-info">
		</form>
		<div>
		</div>

        <?php include("../includes/footer.php"); ?>

</body>
</html>