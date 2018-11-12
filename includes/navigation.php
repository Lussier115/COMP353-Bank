<?php
$CURRENT_PAGE = basename($_SERVER["PHP_SELF"]);
?>

<div class="container">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "index.php") {
                ?>active<?php } ?>" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "about.php") {
                ?>active<?php } ?>" href="../about.php">About Us</a>
        </li>
        <li>
            <a class="nav-link <?php if ($CURRENT_PAGE != "index.php" && $CURRENT_PAGE != "about.php") {
                ?>active<?php } ?>" href="../account.php">Account</a>
        </li>
    </ul>
</div>