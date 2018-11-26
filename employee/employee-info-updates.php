<?php
    session_start();
    include("../config.php");
    include('../session.php');

    if ($_SESSION['isAdmin'] == "0") {
        header("location: /authentication/login.php");
    }

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
				<legend class="text-center">Client Updates</legend>

				<div class="form-group">
					<label for="months">Satisfactory Months Update</label>
					<input type="text" class="form-control" name="months" placeholder="Ex: 6">
				</div>

				<div class="form-group">
					<label for="credit">Credit Card #</label>
					<input type="text" class="form-control" name="credit" placeholder="Ex: 4506 0610 03445 564">
				</div>

				<label for="chosen_client">Clients</label> <br/>
                <?php include('selection/client-selection.php') ?>

				<input type="submit" class="btn btn-info">
			</form>
		</div>
		<div>

		</div>

        <?php include("../includes/footer.php"); ?>

</body>
</html>