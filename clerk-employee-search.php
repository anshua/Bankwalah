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

<h2>Search Employees</h2>

<div class="alert alert-info">Put one or more of the fields below to search an employee. If all are left blank then the list of all employees will be displayed.</div>

<form action="clerk-employee-searched.php" method="post">
<div class="table-responsive">
<table class="table">
	<tr>
		<td>Name</td>
		<td style="width:70%;"><input type="text" name="EmpName" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Father's Name</td>
		<td style="width:70%;"><input type="text" name="EmpFName" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Date of Birth</td>
		<td><input type="text" name="EmpDOB" class="datepicker"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>YYYY-MM-DD</button></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style="width:70%;"><input type="text" name="EmpPhone" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style="width:70%;"><input type="text" name="EmpEmail" style="width:50%;"></td>
	</tr>
	<tr>
		<td style="width:30%;">Employee ID</td>
		<td style="width:70%;"><input type="text" name="EmpID" style="width:50%;"></td>
	</tr>
</table>
</div>
<input type="submit" name="submit" value="SEARCH"><input type="reset" name="reset" value="RESET" style="margin-left:20px;">
</form>


		</div>
		<div class="col-sm-4 mainside-clr"><?php include_once "clerk-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-clr"><?php include_once "clerk-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>