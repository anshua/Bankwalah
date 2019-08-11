<div id="navbar">
	<a class="active" href="clerk-dashboard.php">Dashboard</a>
	<a href="clerk-branch-searched.php">Branches</a>
	<a href="clerk-employee-searched.php">Employees</a>
	<a href="clerk-customer-searched.php">Customers</a>
	<a href="clerk-trans-searched.php">Transactions</a>

	<?php echo "<a href=\"clerk-employee-view.php?id=".$ses_EmpID."\" style=\"float:right;\"><button type=\"button\" class=\"btn btn-info btn-xs\">Logged Profile : ".$ses_EmpLogin."</button></a>"; ?>
	<a href="clerk-logout.php" style="float:right;"><button type="button" class="btn btn-info btn-xs">Logout</button></a>
</div>
