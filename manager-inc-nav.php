<div id="navbar">
	<a class="active" href="manager-dashboard.php">Dashboard</a>
	<a href="manager-branch-searched.php">Branches</a>
	<a href="manager-employee-searched.php">Employees</a>
	<a href="manager-customer-searched.php">Customers</a>
	<a href="manager-trans-searched.php">Transactions</a>

	<?php echo "<a href=\"manager-employee-view.php?id=".$ses_EmpID."\" style=\"float:right;\"><button type=\"button\" class=\"btn btn-info btn-xs\">Logged Profile : ".$ses_EmpLogin."</button></a>"; ?>
	<a href="manager-logout.php" style="float:right;"><button type="button" class="btn btn-info btn-xs">Logout</button></a>
</div>
