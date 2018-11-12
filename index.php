<?php session_start(); ?>

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
    <h2>Bank Management System!</h2>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>