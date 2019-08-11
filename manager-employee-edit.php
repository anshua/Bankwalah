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

<h2>Edit Employee Details</h2>

<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT EmpID FROM employees WHERE EmpBrID=$ses_BrID AND EmpID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["EmpID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {

$sql = "SELECT * FROM employees WHERE EmpID=".$_GET["id"];

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		// sex radio button setup
		if ($row["EmpSex"] == "Male") { $EmpSex = "<input type=\"radio\" name=\"EmpSex\" value=\"Male\" checked> Male<input type=\"radio\" name=\"EmpSex\" value=\"Female\" style=\"margin-left:30px;\"> Female<input type=\"radio\" name=\"EmpSex\" value=\"Other\" style=\"margin-left:30px;\"> Other"; }
		elseif ($row["EmpSex"] == "Female") { $EmpSex = "<input type=\"radio\" name=\"EmpSex\" value=\"Male\"> Male<input type=\"radio\" name=\"EmpSex\" value=\"Female\" style=\"margin-left:30px;\" checked> Female<input type=\"radio\" name=\"EmpSex\" value=\"Other\" style=\"margin-left:30px;\"> Other"; }
		elseif ($row["EmpSex"] == "Other") { $EmpSex = "<input type=\"radio\" name=\"EmpSex\" value=\"Male\"> Male<input type=\"radio\" name=\"EmpSex\" value=\"Female\" style=\"margin-left:30px;\"> Female<input type=\"radio\" name=\"EmpSex\" value=\"Other\" style=\"margin-left:30px;\" checked> Other"; }
		else { $EmpSex = ""; }

		// employee role button setup
		if ($row["EmpRole"] == "Administrator") { $EmpRole = "<input type=\"radio\" name=\"EmpRole\" value=\"Administrator\" checked> Administrator (Shaktimaan)<input type=\"radio\" name=\"EmpRole\" value=\"Manager\" style=\"margin-left:30px;\"> Manager (Geeta)<input type=\"radio\" name=\"EmpRole\" value=\"Clerk\" style=\"margin-left:30px;\"> Clerk (Gangadhar)"; }
		elseif ($row["EmpRole"] == "Manager") { $EmpRole = "<input type=\"radio\" name=\"EmpRole\" value=\"Administrator\"> Administrator (Shaktimaan)<input type=\"radio\" name=\"EmpRole\" value=\"Manager\" style=\"margin-left:30px;\" checked> Manager (Geeta)<input type=\"radio\" name=\"EmpRole\" value=\"Clerk\" style=\"margin-left:30px;\"> Clerk (Gangadhar)"; }
		elseif ($row["EmpRole"] == "Clerk") { $EmpRole = "<input type=\"radio\" name=\"EmpRole\" value=\"Administrator\"> Administrator (Shaktimaan)<input type=\"radio\" name=\"EmpRole\" value=\"Manager\" style=\"margin-left:30px;\"> Manager (Geeta)<input type=\"radio\" name=\"EmpRole\" value=\"Clerk\" style=\"margin-left:30px;\" checked> Clerk (Gangadhar)"; }
		else { $EmpRole = "<input type=\"radio\" name=\"EmpRole\" value=\"Administrator\"> Administrator (Shaktimaan)<input type=\"radio\" name=\"EmpRole\" value=\"Manager\" style=\"margin-left:30px;\"> Manager (Geeta)<input type=\"radio\" name=\"EmpRole\" value=\"Clerk\" style=\"margin-left:30px;\" checked> Clerk (Gangadhar)"; }
	
		// branch id and location setup
		$sql_br = "SELECT BrID, BrLoc FROM branches ORDER BY BrID ASC";
		$result_br = $conn->query($sql_br);
		if ($result_br->num_rows > 0) {
			// output data of each row
			$EmpBrID = "";
			while($row_br = $result_br->fetch_assoc()) {
				if ($row["EmpBrID"] == $row_br["BrID"]) { $selected_br_id = " selected"; } else { $selected_br_id = ""; }
				$EmpBrID .= "<option value=\"".$row_br["BrID"]."\"".$selected_br_id.">".$row_br["BrID"]." - ".$row_br["BrLoc"]."</option>";
			}
		}
		else {
			echo "<option value=\"Reload Page\" disabled>Nothing found. Try reloading by pressing F5.</option>";
		}


		echo "<div class=\"alert alert-danger\">Fields marked with * are mandatory.</div>
<form action=\"manager-employee-view.php\" method=\"post\" enctype=\"multipart/form-data\">
<div class=\"table-responsive\">
<table class=\"table table-striped\">
	<tr>
		<td style=\"width:30%;\">Employee ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpID\" style=\"width:50%; background-color:red;\" value=\"".$row["EmpID"]."\" readonly></td>
	</tr>
	<tr>
		<td>Name*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpName\" style=\"width:50%;\" value=\"".$row["EmpName"]."\" required></td>
	</tr>
	<tr>
		<td>Father's Name*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpFName\" style=\"width:50%;\" value=\"".$row["EmpFName"]."\" required></td>
	</tr>
	<tr>
		<td>Mother's Name</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpMName\" style=\"width:50%;\" value=\"".$row["EmpMName"]."\"></td>
	</tr>
	<tr>
		<td>Date of Birth*</td>
		<td><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-right:20px;\" disabled>YYYY-MM-DD</button><input type=\"text\" name=\"EmpDOB\" class=\"datepicker\" value=\"".$row["EmpDOB"]."\" required></td>
	</tr>
	<tr>
		<td>Join Date*</td>
		<td><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-right:20px;\" disabled>YYYY-MM-DD</button><input type=\"text\" name=\"EmpJoinDate\" class=\"datepicker\" value=\"".$row["EmpJoinDate"]."\" required></td>
	</tr>
	<tr>
		<td>Sex*</td>
		<td>".$EmpSex."</td>
	</tr>
	<tr>
		<td>Local Address*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpLAdd\" style=\"width:90%;\" value=\"".$row["EmpLAdd"]."\" required></td>
	</tr>
	<tr>
		<td>Permanent Address</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpPAdd\" style=\"width:90%;\" value=\"".$row["EmpPAdd"]."\"></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpPhone\" style=\"width:50%;\" value=\"".$row["EmpPhone"]."\"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style=\"width:70%;\"><input type=\"email\" name=\"EmpEmail\" style=\"width:50%;\" value=\"".$row["EmpEmail"]."\"></td>
	</tr>
	<tr>
		<td>PAN</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpPAN\" style=\"width:50%;\" value=\"".$row["EmpPAN"]."\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>Format : AAAAA2222A</button></td>
	</tr>
	<tr>
		<td>Aadhaar</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpAadhaar\" style=\"width:50%;\" value=\"".$row["EmpAadhaar"]."\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>Format : 111122223333</button></td>
	</tr>
	<tr>
		<td>Branch ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpBrID\" value=\"".$row["EmpBrID"]."\" style=\"width:50%; background-color:red;\" readonly></td>
	</tr>
	<tr>
		<td>Role*</td>
		<td>".$EmpRole."</td>
	</tr>
	<tr>
		<td>Employee Login*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"EmpLogin\" style=\"width:50%;\" value=\"".$row["EmpLogin"]."\" required><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>Unique</button></td>
	</tr>
	<tr>
		<td>Employee Password*</td>
		<td style=\"width:70%;\"><input type=\"password\" name=\"EmpPass\" style=\"width:50%;\" value=\"".$row["EmpPass"]."\" required></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td><img src=\"img-employees/".$row["EmpID"]."-photo.jpg\" alt=\"".$row["EmpName"]." - Photo Load Error\" class=\"picsigsmall\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px; margin-right:20px;\" disabled>Max 1 MB, Only jpg</button><input type=\"file\" name=\"EmpPhoto\" id=\"EmpPhoto\" accept=\".jpg\" style=\"display:inline;\"></td>
	</tr>
	<tr>
		<td>Signature</td>
		<td><img src=\"img-employees/".$row["EmpID"]."-sig.jpg\" alt=\"".$row["EmpName"]." - Sig Load Error \" class=\"picsigsmall\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px; margin-right:20px;\" disabled>Max 1 MB, Only jpg</button><input type=\"file\" name=\"EmpSig\" id=\"EmpSig\" accept=\".jpg\" style=\"display:inline;\"></td>
	</tr>
</table>
</div>
<input type=\"submit\" name=\"submitedit\" value=\"UPDATE\"><a href=\"manager-employee-view.php?id=".$row["EmpID"]."\"><button type=\"button\" class=\"btn btn-info btn-xs\" style=\"margin-left:20px;\">RETURN</button></a>
</form>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}

}
else {
	header("Location: manager-dashboard.php");
}
?>


		</div>
		<div class="col-sm-4 mainside-mgr"><?php include_once "manager-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-mgr"><?php include_once "manager-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>