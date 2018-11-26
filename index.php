<?php

    session_start();
    include('config.php');

    $sql = "SELECT * FROM mec353_2.branch";
    $sql2 = "SELECT * FROM mec353_2.bank_hq";

    $result_branch = mysqli_query($db, $sql);
    $result_hq = mysqli_query($db, $sql2);

?>

<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head-tag-contents.php"); ?>
</head>

<body>

<?php include("includes/header.php"); ?>
<?php

    if (isset($_SESSION['session_token'])) {
        if ($_SESSION['account'] == 'client') {
            include("client/client-nav.php");
        } elseif ($_SESSION['account'] == 'employee') {
            include("employee/employee-nav.php");
        }
    } else {
        include("includes/navigation.php");
    }
?>

<div class="container" id="main-content">


    <?php
        if ($result_hq->num_rows > 0) {
            while ($row = $result_hq->fetch_assoc()) {

                print "<div>
							<h3> Bank " . $row['bank_name'] . " </h3>
								<div class='branch-info'>
									<label> HQ Location: </label> " . $row['location'] . " <br />	
								</div>	
					</div>";

            }
        }
    ?>

	<h4>Town Bank Locations </h4>
	<div class="branch">
        <?php
            if ($result_branch->num_rows > 0) {
                while ($row = $result_branch->fetch_assoc()) {

                    print "<div>
						<div class='branch-info'>
							<label> Location: </label> " . $row['location'] . " <br />
							<label> Phone: </label> " . $row['phone'] . " <br />
							<label> Fax: </label> " . $row['fax'] . " <br />
						</div>
					</div>";

                }
            }
        ?>
	</div>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>