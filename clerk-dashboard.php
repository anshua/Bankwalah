<?php include_once "clerk-session.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include_once "clerk-inc-head.php"; ?>
</head>

<body onscroll="navStick()">

<?php include_once "clerk-inc-header.php"; ?>
<?php include_once "clerk-inc-nav.php"; ?>

<div class="content">

	<div class="row">
		<div class="col-sm-8 mainbody-clr">

<h2>Clerk Dashboard</h2>

<h3>Customers</h3>
<ul>
	<li><a href="clerk-customer-new.php">Add New Customer</a></li>
	<li><a href="clerk-customer-search.php">Search Customers</a></li>
	<li><a href="clerk-customer-searched.php">List of All Customers of This Branch</a></li>
</ul>

<h3>Employees</h3>
<ul>
	<li><a href="clerk-employee-search.php">Search Employees</a></li>
	<li><a href="clerk-employee-searched.php">List of All Employees</a></li>
</ul>

<h3>Branches</h3>
<ul>
	<li><a href="clerk-branch-search.php">Search Branches</a></li>
	<li><a href="clerk-branch-searched.php">List of All Branches</a></li>
</ul>

<h3>Transactions</h3>
<ul>
	<li><a href="clerk-trans-new.php">Add New Transaction</a></li>
	<li><a href="clerk-trans-search.php">Search Transactions</a></li>
	<li><a href="clerk-trans-tform.php">Transfer Money</a></li>
	<li><a href="clerk-trans-searched.php">List of All Transactions of Customers of This Branch</a></li>
</ul>

		</div>
		<div class="col-sm-4 mainside-clr"><?php include_once "clerk-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-clr"><?php include_once "clerk-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>