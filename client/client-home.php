<?php
    session_start();
    include('../session.php');
    include('../config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['personal'])) {
            $_SESSION['profile_type'] = "personal";
            header("location: /client/client-accountBalance.php");
        } else {
            $_SESSION['profile_type'] = "business";
            header("location: /client/client-accountBalance.php");
        }
    }

    $current_client_id = $_SESSION['client_id'];
    $sql = "SELECT * FROM  mec353_2.client 
			WHERE mec353_2.client.client_id = '$current_client_id'";

    $result = mysqli_query($db, $sql);

    $sqlServices="SELECT DISTINCT service.service_type FROM mec353_2.service, mec353_2.service_used WHERE service_used.client_id='$current_client_id' AND service_used.service_id=service.service_id";
    $resultServices = mysqli_query($db, $sqlServices);

?>


<!DOCTYPE html>
<html>
<head>
    <?php include("../includes/head-tag-contents.php"); ?>
	<style>
		<?php include("client.css")?>
	</style>
</head>
<body>

<?php include("../includes/header.php"); ?>
<?php include("client-nav.php"); ?>


<div class="container" id="main-content">
    <table >
        <tr>
            <td style="text-align:left"><?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        print "<div>
						<h2> Welcome " . $row['first_name'] . "</h2>
						<div class='employee-info'>
							<label class='label-title'><strong> Your Information:</strong></label><br />
							<label> First Name: </label> " . $row['first_name'] . " <br />
							<label> Last Name: </label> " . $row['last_name'] . " <br />
							<label> Email: </label> " . $row['email'] . " <br />
							<label> Address: </label> " . $row['address'] . " <br />
							<label> Phone: </label> " . $row['phone'] . " <br />
							<label> Start Date: </label> " . $row['joining_date'] . " <br />
							<label> Credit Card #: </label> " . $row['salary'] . " <br />
							<label> Satisfactory Months #: </label> " . $row['satisfactory_months'] . " <br />
						</div>
					</div>";

                    }
                }
                ?></td>
            <td><label class='label-title'><strong> Services Used:</strong></label><br />


                <?php
                echo "<table  border=''>";
                echo "<tr> <th>Service</th></tr>";

                if ($resultServices->num_rows > 0) {
                    // output data of each row

                    while ($row = $resultServices->fetch_assoc()) {

                        echo "<tr><td>" . $row['service_type'] . "</td></tr>";

                    }
                    echo "</table>";
                } else {
                    echo "</table>";
                    echo "Not using any services";

                }


                ?>
            </td>


        </tr>




    </table>




    <form class="account_type" method="post">
		<h4>Select account type to view</h4>
		<label class="account_selection">Personal
			<input type="radio" name="personal">
			<span class="radiobutton"></span>
		</label>
		<label class="account_selection"> Business
			<input type="radio" name="business">
			<span class="radiobutton"></span>
		</label>
		<input type="submit" value="View Balance"/>
	</form>
</div>


<?php include("../includes/footer.php"); ?>

</body>
</html>