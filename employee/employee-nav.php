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
        <li>
            <a class="nav-link <?php if ($CURRENT_PAGE == "page1.php") {  /*page1.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="">Employee Page 2</a>
        </li>
        <li>
            <a class="nav-link <?php if ($CURRENT_PAGE == "page2.php") { /*page2.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="">Employee Page 2</a>
        </li>
        <li>
            <a class="nav-link <?php if ($CURRENT_PAGE == "page3.php") { /*page3.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="">Employee Page 2</a>
        </li>
    </ul>
</div>