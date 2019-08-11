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

<h2>Add New Branch</h2>

<div class="alert alert-danger">Fields marked with * are mandatory.</div>

<form action="admin-branch-view.php" method="post" enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<td style="width:30%;">Branch ID*</td>
		<td style="width:70%;"><input type="text" name="BrID" value="SET TO AUTO_INCREMENT" style="width:50%;" disabled></td>
	</tr>
	<tr>
		<td>Location*</td>
		<td style="width:70%;"><input type="text" name="BrLoc" style="width:90%;"></td>
	</tr>
	<tr>
		<td>IFSC*</td>
		<td style="width:70%;"><input type="text" name="BrIFSC" style="width:50%;"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>Format : BKWL0666666</button></td>
	</tr>
	<tr>
		<td>Opening Date*</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>YYYY-MM-DD</button><input type="text" name="BrOpenDate" class="datepicker" value="<?php echo date("Y-m-d"); ?>"></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style="width:70%;"><input type="text" name="BrPhone" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style="width:70%;"><input type="email" name="BrEmail" style="width:50%;"></td>
	</tr>
</table>
</div>
<input type="submit" name="submitnew" value="SUBMIT"><input type="reset" name="reset" value="RESET" style="margin-left:20px;">
</form>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>