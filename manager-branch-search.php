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

<h2>Search Branches</h2>

<div class="alert alert-info">Put one or more of the fields below to search a branch. If all are left blank then the list of all branches will be displayed.</div>

<form action="manager-branch-searched.php" method="post">
<div class="table-responsive">
<table class="table">
	<tr>
		<td>Location</td>
		<td style="width:70%;"><input type="text" name="BrLoc" style="width:90%;"></td>
	</tr>
	<tr>
		<td>IFSC</td>
		<td style="width:70%;"><input type="text" name="BrIFSC" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style="width:70%;"><input type="text" name="BrPhone" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style="width:70%;"><input type="text" name="BrEmail" style="width:50%;"></td>
	</tr>
	<tr>
		<td style="width:30%;">Branch ID</td>
		<td style="width:70%;"><input type="text" name="BrID" style="width:50%;"></td>
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