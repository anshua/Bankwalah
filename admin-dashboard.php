<?php include_once "admin-session.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include_once "admin-inc-head.php"; ?>
</head>

<body onscroll="navStick()">

<?php include_once "admin-inc-header.php"; ?>
<?php include_once "admin-inc-nav.php"; ?>

<div class="content">

	<div class="row">
		<div class="col-sm-8 mainbody-adm">

<h2>Administrator Dashboard</h2>

<h3>Customers</h3>
<ul>
	<li><a href="admin-customer-new.php">Add New Customer</a></li>
	<li><a href="admin-customer-search.php">Search Customers</a></li>
	<li><a href="admin-customer-searched.php">List of All Customers</a></li>
</ul>

<h3>Employees</h3>
<ul>
	<li><a href="admin-employee-new.php">Add New Employee</a></li>
	<li><a href="admin-employee-search.php">Search Employees</a></li>
	<li><a href="admin-employee-searched.php">List of All Employees</a></li>
</ul>

<h3>Branches</h3>
<ul>
	<li><a href="admin-branch-new.php">Add New Branch</a></li>
	<li><a href="admin-branch-search.php">Search Branches</a></li>
	<li><a href="admin-branch-searched.php">List of All Branches</a></li>
	<li><a href="admin-branch-clean.php">Remove Employees and Customers of a Branch</a><span style="color:red;"> (Mass Removal - Be sure of what you are doing!)</span></li>
</ul>

<h3>Transactions</h3>
<ul>
	<li><a href="admin-trans-new.php">Add New Transaction</a></li>
	<li><a href="admin-trans-search.php">Search Transactions</a></li>
	<li><a href="admin-trans-tform.php">Transfer Money</a></li>
	<li><a href="admin-trans-searched.php">List of All Transactions</a></li>
</ul>

		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>