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

<h2>Edit Customer Details</h2>

<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT CustID FROM customers WHERE CustID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["CustID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {

$sql = "SELECT * FROM customers WHERE CustID=".$_GET["id"];

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		// sex radio button setup
		if ($row["CustSex"] == "Male") { $CustSex = "<input type=\"radio\" name=\"CustSex\" value=\"Male\" checked> Male<input type=\"radio\" name=\"CustSex\" value=\"Female\" style=\"margin-left:30px;\"> Female<input type=\"radio\" name=\"CustSex\" value=\"Other\" style=\"margin-left:30px;\"> Other"; }
		elseif ($row["CustSex"] == "Female") { $CustSex = "<input type=\"radio\" name=\"CustSex\" value=\"Male\"> Male<input type=\"radio\" name=\"CustSex\" value=\"Female\" style=\"margin-left:30px;\" checked> Female<input type=\"radio\" name=\"CustSex\" value=\"Other\" style=\"margin-left:30px;\"> Other"; }
		elseif ($row["CustSex"] == "Other") { $CustSex = "<input type=\"radio\" name=\"CustSex\" value=\"Male\"> Male<input type=\"radio\" name=\"CustSex\" value=\"Female\" style=\"margin-left:30px;\"> Female<input type=\"radio\" name=\"CustSex\" value=\"Other\" style=\"margin-left:30px;\" checked> Other"; }
		else { $CustSex = ""; }

		// customer account type radio button setup
		if ($row["CustACType"] == "Saving") { $CustACType = "<input type=\"radio\" name=\"CustACType\" value=\"Saving\" checked> Saving AC<input type=\"radio\" name=\"CustACType\" value=\"Current\" style=\"margin-left:30px;\"> Current AC<input type=\"radio\" name=\"CustACType\" value=\"RD\" style=\"margin-left:30px;\"> Recurring Deposit AC<input type=\"radio\" name=\"CustACType\" value=\"FD\" style=\"margin-left:30px;\"> Fixed Diposit AC"; }
		elseif ($row["CustACType"] == "Current") { $CustACType = "<input type=\"radio\" name=\"CustACType\" value=\"Saving\"> Saving AC<input type=\"radio\" name=\"CustACType\" value=\"Current\" style=\"margin-left:30px;\" checked> Current AC<input type=\"radio\" name=\"CustACType\" value=\"RD\" style=\"margin-left:30px;\"> Recurring Deposit AC<input type=\"radio\" name=\"CustACType\" value=\"FD\" style=\"margin-left:30px;\"> Fixed Diposit AC"; }
		elseif ($row["CustACType"] == "RD") { $CustACType = "<input type=\"radio\" name=\"CustACType\" value=\"Saving\"> Saving AC<input type=\"radio\" name=\"CustACType\" value=\"Current\" style=\"margin-left:30px;\"> Current AC<input type=\"radio\" name=\"CustACType\" value=\"RD\" style=\"margin-left:30px;\" checked> Recurring Deposit AC<input type=\"radio\" name=\"CustACType\" value=\"FD\" style=\"margin-left:30px;\"> Fixed Diposit AC"; }
		elseif ($row["CustACType"] == "FD") { $CustACType = "<input type=\"radio\" name=\"CustACType\" value=\"Saving\"> Saving AC<input type=\"radio\" name=\"CustACType\" value=\"Current\" style=\"margin-left:30px;\"> Current AC<input type=\"radio\" name=\"CustACType\" value=\"RD\" style=\"margin-left:30px;\"> Recurring Deposit AC<input type=\"radio\" name=\"CustACType\" value=\"FD\" style=\"margin-left:30px;\" checked> Fixed Diposit AC"; }
		else { $CustACType = "<input type=\"radio\" name=\"CustACType\" value=\"Saving\" checked> Saving AC<input type=\"radio\" name=\"CustACType\" value=\"Current\" style=\"margin-left:30px;\"> Current AC<input type=\"radio\" name=\"CustACType\" value=\"RD\" style=\"margin-left:30px;\"> Recurring Deposit AC<input type=\"radio\" name=\"CustACType\" value=\"FD\" style=\"margin-left:30px;\"> Fixed Diposit AC"; }

		// net banking choice radio button setup
		if ($row["CustNetBank"] == "Yes") { $CustNetBank = "<input type=\"radio\" name=\"CustNetBank\" value=\"No\"> No<input type=\"radio\" name=\"CustNetBank\" value=\"Yes\" style=\"margin-left:30px;\" checked> Yes"; }
		elseif ($row["CustNetBank"] == "No") { $CustNetBank = "<input type=\"radio\" name=\"CustNetBank\" value=\"No\" checked> No<input type=\"radio\" name=\"CustNetBank\" value=\"Yes\" style=\"margin-left:30px;\"> Yes"; }
		else { $CustNetBank = "<input type=\"radio\" name=\"CustNetBank\" value=\"No\" checked> No<input type=\"radio\" name=\"CustNetBank\" value=\"Yes\" style=\"margin-left:30px;\"> Yes"; }
	
		// branch id and location setup
		$sql_br = "SELECT BrID, BrLoc FROM branches ORDER BY BrID ASC";
		$result_br = $conn->query($sql_br);
		if ($result_br->num_rows > 0) {
			// output data of each row
			$CustBrID = "";
			while($row_br = $result_br->fetch_assoc()) {
				if ($row["CustBrID"] == $row_br["BrID"]) { $selected_br_id = " selected"; } else { $selected_br_id = ""; }
				$CustBrID .= "<option value=\"".$row_br["BrID"]."\"".$selected_br_id.">".$row_br["BrID"]." - ".$row_br["BrLoc"]."</option>";
			}
		}
		else {
			echo "<option value=\"Reload Page\" disabled>Nothing found. Try reloading by pressing F5.</option>";
		}


		echo "<div class=\"alert alert-danger\">Fields marked with * are mandatory.</div>
<form action=\"admin-customer-view.php\" method=\"post\" enctype=\"multipart/form-data\">
<div class=\"table-responsive\">
<table class=\"table table-striped\">
	<tr>
		<td style=\"width:30%;\">Customer ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustID\" style=\"width:50%; background-color:red;\" value=\"".$row["CustID"]."\" readonly></td>
	</tr>
	<tr>
		<td>Name*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustName\" style=\"width:50%;\" value=\"".$row["CustName"]."\" required></td>
	</tr>
	<tr>
		<td>Father's Name*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustFName\" style=\"width:50%;\" value=\"".$row["CustFName"]."\" required></td>
	</tr>
	<tr>
		<td>Mother's Name</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustMName\" style=\"width:50%;\" value=\"".$row["CustMName"]."\"></td>
	</tr>
	<tr>
		<td>Date of Birth*</td>
		<td><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-right:20px;\" disabled>YYYY-MM-DD</button><input type=\"text\" name=\"CustDOB\" class=\"datepicker\" value=\"".$row["CustDOB"]."\" required></td>
	</tr>
	<tr>
		<td>Join Date*</td>
		<td><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-right:20px;\" disabled>YYYY-MM-DD</button><input type=\"text\" name=\"CustJoinDate\" class=\"datepicker\" value=\"".$row["CustJoinDate"]."\" required></td>
	</tr>
	<tr>
		<td>Sex*</td>
		<td>".$CustSex."</td>
	</tr>
	<tr>
		<td>Local Address*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustLAdd\" style=\"width:90%;\" value=\"".$row["CustLAdd"]."\" required></td>
	</tr>
	<tr>
		<td>Permanent Address</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustPAdd\" style=\"width:90%;\" value=\"".$row["CustPAdd"]."\"></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustPhone\" style=\"width:50%;\" value=\"".$row["CustPhone"]."\"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style=\"width:70%;\"><input type=\"email\" name=\"CustEmail\" style=\"width:50%;\" value=\"".$row["CustEmail"]."\"></td>
	</tr>
	<tr>
		<td>PAN</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustPAN\" style=\"width:50%;\" value=\"".$row["CustPAN"]."\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>Format : AAAAA2222A</button></td>
	</tr>
	<tr>
		<td>Aadhaar</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustAadhaar\" style=\"width:50%;\" value=\"".$row["CustAadhaar"]."\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>Format : 111122223333</button></td>
	</tr>
	<tr>
		<td>Branch ID*</td>
		<td style=\"width:70%;\"><select type=\"text\" name=\"CustBrID\" style=\"width:50%;\"><option value=\"Select Branch\" disabled>Select Branch</option>".$CustBrID."</select></td>
	</tr>
	<tr>
		<td>Account Type*</td>
		<td>".$CustACType."</td>
	</tr>
	<tr>
		<td>Current Balance*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustCurrBal\" style=\"width:50%; background-color:red;\" value=\"".$row["CustCurrBal"]."\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>&#8377; Upto 2 Decimals</button></td>
	</tr>
	<tr>
		<td>Customer Log</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustLog\" style=\"width:50%;\" value=\"".$row["CustLog"]."\"></td>
	</tr>
	<tr>
		<td>Net Banking Required*</td>
		<td>".$CustNetBank."</td>
	</tr>
	<tr>
		<td>Net Banking Login</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"CustLogin\" style=\"width:50%;\" value=\"".$row["CustLogin"]."\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>Unique</button></td>
	</tr>
	<tr>
		<td>Net Banking Password</td>
		<td style=\"width:70%;\"><input type=\"password\" name=\"CustPass\" style=\"width:50%;\" value=\"".$row["CustPass"]."\"></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td><img src=\"img-customers/".$row["CustID"]."-photo.jpg\" alt=\"".$row["CustName"]." - Photo Load Error\" class=\"picsigsmall\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px; margin-right:20px;\" disabled>Max 1 MB, Only jpg</button><input type=\"file\" name=\"CustPhoto\" id=\"CustPhoto\" accept=\".jpg\" style=\"display:inline;\"></td>
	</tr>
	<tr>
		<td>Signature</td>
		<td><img src=\"img-customers/".$row["CustID"]."-sig.jpg\" alt=\"".$row["CustName"]." - Sig Load Error \" class=\"picsigsmall\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px; margin-right:20px;\" disabled>Max 1 MB, Only jpg</button><input type=\"file\" name=\"CustSig\" id=\"CustSig\" accept=\".jpg\" style=\"display:inline;\"></td>
	</tr>
</table>
</div>
<input type=\"submit\" name=\"submitedit\" value=\"UPDATE\"><a href=\"admin-customer-view.php?id=".$row["CustID"]."\"><button type=\"button\" class=\"btn btn-info btn-xs\" style=\"margin-left:20px;\">RETURN</button></a>
</form>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}

}
else {
	header("Location: admin-dashboard.php");
}
?>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>