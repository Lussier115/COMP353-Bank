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
			<a class="nav-link <?php if ($CURRENT_PAGE == "transfer-money.php") {  /*page1.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="/client/actions/transfer-money.php">Transfer Money</a>
		</li>
		<li>
			<a class="nav-link <?php if ($CURRENT_PAGE == "future-payment.php") { /*page2.php is only for reference. add information when page is added.*/
                ?>active<?php } ?>" href="/client/actions/future-payment.php">Pay Bills</a>
		</li>
	</ul>
</div>