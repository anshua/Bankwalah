<div id="navbar">
	<a class="active" href="admin-dashboard.php">Dashboard</a>
	<a href="admin-branch-searched.php">Branches</a>
	<a href="admin-employee-searched.php">Employees</a>
	<a href="admin-customer-searched.php">Customers</a>
	<a href="admin-trans-searched.php">Transactions</a>

	<?php echo "<a href=\"admin-employee-view.php?id=".$ses_EmpID."\" style=\"float:right;\"><button type=\"button\" class=\"btn btn-info btn-xs\">Logged Profile : ".$ses_EmpLogin."</button></a>"; ?>
	<a href="admin-logout.php" style="float:right;"><button type="button" class="btn btn-info btn-xs">Logout</button></a>
</div>
