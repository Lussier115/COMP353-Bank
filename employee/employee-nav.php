<?php
$CURRENT_PAGE = basename($_SERVER["PHP_SELF"]);
?>

<div class="container">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "index.php") {
                ?>active<?php } ?>" href="/index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($CURRENT_PAGE == "about.php") {
                ?>active<?php } ?>" href="/about.php">About Us</a>
        </li>
        <li>
            <a class="nav-link <?php if (strpos($CURRENT_PAGE,"home") == true) {
                ?>active<?php } ?>" href="/account.php">Account</a>
        </li>
        <li>
            <a class="nav-link <?php if ($CURRENT_PAGE == "employee-bankBalance.php") {  /*page1.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="/employee/employee-bankBalance.php">Profits & Losses</a>
        </li>
        <li>
            <a class="nav-link <?php if ($CURRENT_PAGE == "page2.php") { /*page2.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="">Employee Page 2</a>
        </li>
        <li>
			<a class="nav-link <?php if ($CURRENT_PAGE == "Employee-Schedule-Payroll.php") { /*page2.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="/employee/Employee-Schedule-Payroll.php">Employee Schedule Payroll</a>
		</li>
    </ul>
</div>