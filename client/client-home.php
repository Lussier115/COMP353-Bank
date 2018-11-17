<?php include('../session.php') ?>

<!DOCTYPE html>
<html>
<head>
	<?php include("../includes/head-tag-contents.php");?>
    <link rel="stylesheet" type="text/css" href="client.css">
</head>
<body>

<?php include("../includes/header.php"); ?>
<?php include("client-nav.php"); ?>

<div class="container" id="main-content">
	<h2>Client Account</h2>
	<p>Have all the client actions here</p>


    <form action="checkbox-form.php" method="post">
        <label class="switch">
            <input type="checkbox" name= "account_type" id="togBtn" onChange="this.form.submit()">
            <div class="slider round" ><!--ADDED HTML --><span class="on">Business</span><span class="off">   Personal</span><!--END--></div>
        </label>
    </form>

    <form action="client-accountBalance.php">
        <input type="button" value="View Balance" onClick="this.form.submit()"  />
    </form>




</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>