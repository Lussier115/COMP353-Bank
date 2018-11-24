<?php
    session_start();
    include('../session.php');
    include('../config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($_SESSION['profile_type'] == "business") {
            $_SESSION['profile_type'] = "personal";
        } else {
            $_SESSION['profile_type'] = "business";
        }
        $profile_value = $_SESSION['profile_type'];
    }
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
	<h2>Client Account</h2>
	<p>Have all the client actions here</p>

	<form class="account_type" method="post">
		<h4>Select Account Type</h4>
		<label class="account_selection">Personal
			<input type="radio" <?php if($_SESSION['profile_type'] == "personal"){?> checked='checked' <?php } ?> name="radio">
			<span class="radiobutton"></span>
		</label>
		<label class="account_selection"> Business
			<input type="radio" <?php if($_SESSION['profile_type'] == "business"){?> checked='checked' <?php } ?> name="radio">
			<span class="radiobutton"></span>
		</label>
	</form>

	<form action="client-accountBalance.php">
		<input type="button" value="View Balance" onClick="this.form.submit()"/>
	</form>

	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<script>
        $(document).ready(function() {
            $('input[name=radio]').change(function(){
                $('form.account_type').submit();
            });
        });
	</script>
</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>