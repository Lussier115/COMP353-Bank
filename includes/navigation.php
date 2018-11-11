<?php
$CURRENT_PAGE = basename($_SERVER["PHP_SELF"]);
session_start();
?>

<div class="container">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "index.php") {
                ?>active<?php } ?>" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "about.php") {
                ?>active<?php } ?>" href="../../about.php">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "contact.php") {
                ?>active<?php } ?>" href="../contact.php">Contact</a>
        </li>
        <?php
        if (isset($_SESSION['session_token'])) {
            if ($_SESSION['account'] == 'client') {
                ?>

                <li class="nav-item">
                    <a class="nav-link <?php if ($CURRENT_PAGE == "client-home.php") {
                        ?>active<?php } ?>" href="../client/client-home.php"> Client</a>
                </li>'
            <?php }

            if ($_SESSION['account'] == 'employee') { ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($CURRENT_PAGE == "employee-home.php") {
                        ?>active<?php } ?>" href="../employee/employee-home.php"> Employee</a>
                </li>
            <?php }
        }
        ?>
    </ul>
</div>