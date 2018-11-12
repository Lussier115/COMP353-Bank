<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>

<?php include("includes/header.php");?>

<?php

if (isset($_SESSION['session_token'])) {
    if ($_SESSION['account'] == 'client') {
        include("client/client-nav.php");
    }

    elseif ($_SESSION['account'] == 'employee') {
        include("employee/employee-nav.php");
    }
}
else{
    include("includes/navigation.php");
}
?>
<div class="container" id="main-content">
	<h2>About Us</h2>
	
	<p> COMP 353 Database Project <p>
	<ul>
  		<li>William-Andrew Lussier</li>
  		<li> Matthew Dugal</li>
  		<li>Alessandro Kreslin</li>
  		<li>Carlita L’Abbé </li>
  		<li>Saleh Ali</li>
	</ul>  
</div>

<?php include("includes/footer.php");?>

</body>
</html>