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

<h2>Add New Employee</h2>

<div class="alert alert-danger">Fields marked with * are mandatory.</div>

<form action="admin-employee-view.php" method="post" enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<td style="width:30%;">Employee ID*</td>
		<td style="width:70%;"><input type="text" name="EmpID" value="SET TO AUTO_INCREMENT" style="width:50%;" disabled></td>
	</tr>
	<tr>
		<td>Name*</td>
		<td style="width:70%;"><input type="text" name="EmpName" style="width:50%;" required></td>
	</tr>
	<tr>
		<td>Father's Name*</td>
		<td style="width:70%;"><input type="text" name="EmpFName" style="width:50%;" required></td>
	</tr>
	<tr>
		<td>Mother's Name</td>
		<td style="width:70%;"><input type="text" name="EmpMName" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Date of Birth*</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>YYYY-MM-DD</button><input type="text" name="EmpDOB" class="datepicker" required></td>
	</tr>
	<tr>
		<td>Join Date*</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>YYYY-MM-DD</button><input type="text" name="EmpJoinDate" class="datepicker" value="<?php echo date("Y-m-d"); ?>" required></td>
	</tr>
	<tr>
		<td>Sex*</td>
		<td><input type="radio" name="EmpSex" value="Male" checked> Male<input type="radio" name="EmpSex" value="Female" style="margin-left:30px;"> Female<input type="radio" name="EmpSex" value="Other" style="margin-left:30px;"> Other</td>
	</tr>
	<tr>
		<td>Local Address*</td>
		<td style="width:70%;"><input type="text" name="EmpLAdd" style="width:90%;" required></td>
	</tr>
	<tr>
		<td>Permanent Address</td>
		<td style="width:70%;"><input type="text" name="EmpPAdd" style="width:90%;"></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style="width:70%;"><input type="text" name="EmpPhone" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style="width:70%;"><input type="email" name="EmpEmail" style="width:50%;"></td>
	</tr>
	<tr>
		<td>PAN</td>
		<td style="width:70%;"><input type="text" name="EmpPAN" style="width:50%;"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>Format : AAAAA2222A</button></td>
	</tr>
	<tr>
		<td>Aadhaar</td>
		<td style="width:70%;"><input type="text" name="EmpAadhaar" style="width:50%;"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>Format : 111122223333</button></td>
	</tr>
	<tr>
		<td>Branch ID*</td>
		<td style="width:70%;">
			<select type="text" name="EmpBrID" style="width:50%;" required>
				<option value="Select Branch" selected disabled>Select Branch</option>
<?php
require_once "dbconfig.php";

$sql = "SELECT BrID, BrLoc FROM branches ORDER BY BrID ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<option value=\"".$row["BrID"]."\">".$row["BrID"]." - ".$row["BrLoc"]."</option>";
	}
}
else {
	echo "<option value=\"Reload Page\" disabled>Nothing found. Try reloading by pressing F5.</option>";
}


?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Role*</td>
		<td><input type="radio" name="EmpRole" value="Administrator" checked> Administrator (Shaktimaan)<input type="radio" name="EmpRole" value="Manager" style="margin-left:30px;"> Manager (Geeta)<input type="radio" name="EmpRole" value="Clerk" style="margin-left:30px;"> Clerk (Gangadhar)</td>
	</tr>
	<tr>
		<td>Employee Login*</td>
		<td style="width:70%;"><input type="text" name="EmpLogin" style="width:50%;" required><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>Unique</button></td>
	</tr>
	<tr>
		<td>Employee Password*</td>
		<td style="width:70%;"><input type="password" name="EmpPass" style="width:50%;" required></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>Max 1 MB, Only jpg</button><input type="file" name="EmpPhoto" id="EmpPhoto" accept=".jpg" style="display:inline;"></td>
	</tr>
	<tr>
		<td>Signature</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>Max 1 MB, Only jpg</button><input type="file" name="EmpSig" id="EmpSig" accept=".jpg" style="display:inline;"></td>
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