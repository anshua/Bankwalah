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

<h2>Search Transactions</h2>

<div class="alert alert-info">Put one or more of the fields below to search a transaction. If all are left blank then the list of all transactions will be displayed.</div>

<?php echo "<div class=\"alert alert-danger\">Only transactions of Branch ".$ses_BrID." (".$ses_BrLoc.") will be displayed.</div>"; ?>

<form action="manager-trans-searched.php" method="post">
<div class="table-responsive">
<table class="table">
	<tr>
		<td>Customer ID</td>
		<td style="width:70%;"><input type="text" name="TrCustID" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Employee ID</td>
		<td style="width:70%;"><input type="text" name="TrEmpID" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Remarks</td>
		<td style="width:70%;"><input type="text" name="TrRemarks" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Transaction Date</td>
		<td><input type="text" name="TrDate" class="datepicker"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>YYYY-MM-DD</button></td>
	</tr>
	<tr>
		<td>Amount</td>
		<td style="width:70%;"><input type="text" name="TrAmount" style="width:50%;"></td>
	</tr>
	<tr>
		<td style="width:30%;">Transaction ID</td>
		<td style="width:70%;"><input type="text" name="TrID" style="width:50%;"></td>
	</tr>
</table>
</div>
<input type="submit" name="submit" value="SEARCH"><input type="reset" name="reset" value="RESET" style="margin-left:20px;">
</form>


		</div>
		<div class="col-sm-4 mainside-mgr"><?php include_once "manager-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-mgr"><?php include_once "manager-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>