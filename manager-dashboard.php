<?php include_once "manager-session.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include_once "manager-inc-head.php"; ?>
</head>

<body onscroll="navStick()">

<?php include_once "manager-inc-header.php"; ?>
<?php include_once "manager-inc-nav.php"; ?>

<div class="content">

	<div class="row">
		<div class="col-sm-8 mainbody-mgr">

<h2>Manager Dashboard</h2>

<h3>Customers</h3>
<ul>
	<li><a href="manager-customer-new.php">Add New Customer</a></li>
	<li><a href="manager-customer-search.php">Search Customers</a></li>
	<li><a href="manager-customer-searched.php">List of All Customers of This Branch</a></li>
</ul>

<h3>Employees</h3>
<ul>
	<li><a href="manager-employee-new.php">Add New Employee</a></li>
	<li><a href="manager-employee-search.php">Search Employees</a></li>
	<li><a href="manager-employee-searched.php">List of All Employees</a></li>
</ul>

<h3>Branches</h3>
<ul>
	<li><a href="manager-branch-search.php">Search Branches</a></li>
	<li><a href="manager-branch-searched.php">List of All Branches</a></li>
</ul>

<h3>Transactions</h3>
<ul>
	<li><a href="manager-trans-new.php">Add New Transaction</a></li>
	<li><a href="manager-trans-search.php">Search Transactions</a></li>
	<li><a href="manager-trans-tform.php">Transfer Money</a></li>
	<li><a href="manager-trans-searched.php">List of All Transactions of Customers of This Branch</a></li>
</ul>

		</div>
		<div class="col-sm-4 mainside-mgr"><?php include_once "manager-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-mgr"><?php include_once "manager-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>