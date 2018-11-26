<?php
    session_start();

    include('../config.php');

    $current_client_id = $_SESSION['client_id'];
    $current_profile = $_SESSION['profile_type'];
    $sql = "SELECT DISTINCT interest_rate.kind_of_service,account.balance, charge_plan.limit, charge_plan.charge, charge_plan.option 
			FROM mec353_2.interest_rate, mec353_2.account, mec353_2.charge_plan 
			WHERE mec353_2.account.client_id = '$current_client_id' 
			  AND mec353_2.interest_rate.interest_rate_id = mec353_2.account.interest_rate_id 
			  AND mec353_2.interest_rate.type_of_account = '$current_profile'
			  AND mec353_2.charge_plan.charge_plan_id = mec353_2.account.charge_plan_id";

    // AND interest_rate.type_of_account = ($current_profile)";
    $result = mysqli_query($db, $sql);
?>


<!DOCTYPE html>
<html>
<head>
    <?php include("../includes/head-tag-contents.php"); ?>
</head>
<body>
<?php include("../includes/header.php"); ?>
<?php include("client-nav.php"); ?>
<div class="container">
	<h1>Account Balance</h1>

    <?php
        echo "<table class=". $_SESSION['profile_type']." border=''>";
        echo "<tr> <th>Account</th><th>Balance</th><th> Limit</th><th>Charge</th><th>Option</th></tr>";

        if ($result->num_rows > 0) {
            // output data of each row

            while ($row = $result->fetch_assoc()) {

                echo "<tr><td>" . $row['kind_of_service'] . "</td><td>" . $row['balance'] . "$" . "</td><td>".$row['limit']."</td> <td>".$row['charge']. "$". "</td><td>".$row['option']."</td></tr>";

            }
            echo "</table>";
        } else {
            echo "</table>";
            echo "No Accounts to show";

        }

    ?>
	<form action="/client/client-home.php">
		<button type="submit"> Back</button>
	</form>


</div>
<?php include("../includes/footer.php"); ?>

</body>
</html>
