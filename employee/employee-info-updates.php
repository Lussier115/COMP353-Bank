<?php
    session_start();
    include("../config.php");
    include('../session.php');


    $sql2 = "SELECT client_id, first_name, last_name FROM mec353_2.client";
    $result2 = mysqli_query($db, $sql2);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $client_id = $_POST['chosen_client'];

        if (isset($_POST['credit']) && isset($_POST['months'])) {
            $credit = $_POST['credit'];
            $months = $_POST['months'];

            $sql = "UPDATE `mec353_2`.`client` SET `credit_card`='$credit', `satisfactory_months`='$months' WHERE `client_id`='$client_id'";
            mysqli_query($db, $sql);
        }
        if (isset($_POST['credit'])) {
            $credit = $_POST['credit'];

            $sql = "UPDATE `mec353_2`.`client` SET `credit_card`='$credit' WHERE `client_id`='$client_id'";
            mysqli_query($db, $sql);
        }
        if (isset($_POST['months'])) {
            $months = $_POST['months'];

            $sql = "UPDATE `mec353_2`.`client` SET `satisfactory_months`='$months' WHERE `client_id`='$client_id'";
            mysqli_query($db, $sql);
        }

        if(isset($_POST['account_type'])){
        	$limit = $_POST['Limit'];
            $charge = $_POST['charge'];
            $option = $_POST['option'];
            $percentage = $_POST['percentage'];
            $service = $_POST['service'];
            $account_type = $_POST['account_type'];
            $balance = $_POST['balance'];

            $chargeSQL = "INSERT INTO `mec353_2`.`charge_plan` (`limit`, `charge`, `option`) VALUES ('$limit', '$charge', '$option')";
            mysqli_query($db, $chargeSQL);
            $charge_plan_id = mysqli_insert_id($db);

            $rateSQL = "INSERT INTO `mec353_2`.`interest_rate` (`kind_of_service`, `type_of_account`, `percentage`) VALUES ('$service', '$account_type', '$percentage')";
            mysqli_query($db, $rateSQL);
            $interest_rate_id = mysqli_insert_id($db);


			$accountSQL = "INSERT INTO `mec353_2`.`account` (`balance`, `charge_plan_id`, `interest_rate_id`, `client_id`) VALUES ('$balance', '$charge_plan_id', '$interest_rate_id', '$client_id')";
            mysqli_query($db, $accountSQL);
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
		<div>
			<form action="" method="post" id="payroll">
				<legend class="text-center">Client Update</legend>

				<div class="form-group">
					<label for="months">Satisfactory Months Update</label>
					<input type="text" class="form-control" name="months" placeholder="Ex: 6">
				</div>

				<div class="form-group">
					<label for="credit">Credit Card #</label>
					<input type="text" class="form-control" name="credit" placeholder="Ex: 4506 0610 03445 564">
				</div>

				<label for="chosen_client">Client</label> <br/>
                <?php include('selection/client-selection.php') ?>

				<input type="submit" class="btn btn-info">
			</form>
		</div>

		<div>
			<form action="" method="post" id="payroll">
				<legend class="text-center">Create Client Account</legend>
				<label class="text-center">Account Balance:</label>
				<div class="form-group">
					<label for="balance">Balance</label>
					<input type="text" class="form-control" name="balance" placeholder="Ex: 2500">
				</div>

				<label class="text-center">Charge Plan:</label>
				<div class="form-group">
					<label for="Limit">Limit</label>
					<input type="text" class="form-control" name="Limit" placeholder="Ex: 1500">
				</div>
				<div class="form-group">
					<label for="charge">Charge</label>
					<input type="text" class="form-control" name="charge" placeholder="Ex: 10$">
				</div>

				<div class="form-group">
					<label for="chosen_charge">Option</label> <br/>
					<select class="form-control" name="option">
						<option value='Weekly'>Weekly</option>
						<option value='Monthly'>Monthly</option>
						<option value='Yearly'>Yearly</option>
					</select>
				</div>

				<label class="text-center">Interest Rate:</label>
				<div class="form-group">
					<label for="percentage">Percentage</label>
					<input type="text" class="form-control" name="percentage" placeholder="Ex: 2.5">
				</div>
				<div class="form-group">
					<label for="chosen_Service">Service Type</label> <br/>
					<select class="form-control" name="service">
						<option value='Checking'>Checking</option>
						<option value='Credit'>Credit</option>
						<option value='Saving'>Saving</option>
					</select>
				</div>
				<div class="form-group">
					<label for="chosen_Account">Account Type</label> <br/>
					<select class="form-control" name="account_type">
						<option value='Personal'>Personal</option>
						<option value='Business'>Business</option>
					</select>
				</div>

				<label class="text-center">Client:</label>
				<div class="form-group">
					<select name="chosen_client" class="form-control">
                        <?php while ($row = mysqli_fetch_array($result2)):; ?>
							<option value=<?php echo $row[0]; ?>><?php echo "$row[1] $row[2]"; ?></option>
                        <?php endwhile; ?>
					</select>
				</div>

				<input type="submit" class="btn btn-info">
			</form>
		</div>
		<div>

		</div>

        <?php include("../includes/footer.php"); ?>

</body>
</html>