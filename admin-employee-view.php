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

<h2>Employee Details</h2>


<?php
require_once "dbconfig.php";

/*------------------------------new employee with pic-sig insert starts-----------------------------------*/
if (isset($_POST["submitnew"])) {

$sql_empnew = "INSERT INTO employees (EmpName, EmpFName, EmpMName, EmpDOB, EmpJoinDate, EmpSex, EmpLAdd, EmpPAdd, EmpPhone, EmpEmail, EmpPAN, EmpAadhaar, EmpBrID, EmpRole, EmpLogin, EmpPass)
VALUES ('$_POST[EmpName]', '$_POST[EmpFName]', '$_POST[EmpMName]', '$_POST[EmpDOB]', '$_POST[EmpJoinDate]', '$_POST[EmpSex]', '$_POST[EmpLAdd]', '$_POST[EmpPAdd]', '$_POST[EmpPhone]', '$_POST[EmpEmail]', '$_POST[EmpPAN]', '$_POST[EmpAadhaar]', '$_POST[EmpBrID]', '$_POST[EmpRole]', '$_POST[EmpLogin]', '$_POST[EmpPass]')";

if ($conn->query($sql_empnew) === TRUE) {
	echo "<div class=\"alert alert-success\">New employee was created successfully.</div>";

// getting EmpID set to AUTO_INCREMENT
$EmpID = mysqli_insert_id($conn);

/* photo upload checks starts */
$photo_target_file = "img-employees/" . basename($_FILES["EmpPhoto"]["name"]);
$photo_uploadOk = 1;
$photo_imageFileType = pathinfo($photo_target_file,PATHINFO_EXTENSION);

// Check if photo file is a actual image or fake image
if(isset($_POST["submit"])) {
	$photo_check = @getimagesize($_FILES["EmpPhoto"]["tmp_name"]);
	if ($photo_check !== false) {
		$photo_uploadOk = 1;
	}
	else {
		echo "<div class=\"alert alert-danger\">Photo was not uploaded. Photo file is invalid.</div>";
		$photo_uploadOk = 0;
	}
}

// Check if file already exists
/*if (file_exists($photo_target_file)) {
	echo "<div class=\"alert alert-danger\">Photo was not uploaded. Photo already exists. Delete the old photo first from the server.</div>";
	$photo_uploadOk = 0;
}*/

// Check file size
if ($_FILES["EmpPhoto"]["size"] > 100000) {
	echo "<div class=\"alert alert-danger\">Photo was not uploaded. Photo filesize was larger than the allowed maximum of 1 MB.</div>";
	$photo_uploadOk = 0;
}

// Allow certain file formats
if ($photo_imageFileType != "jpg") {
	echo "<div class=\"alert alert-danger\">Photo was not uploaded. Only jpg files are accepted.</div>";
	$photo_uploadOk = 0;
}

// Check if $photo_uploadOk is set to 0 by an error
if ($photo_uploadOk == 0) {
	echo "<div class=\"alert alert-danger\">Photo was not uploaded due to some upload error.</div>";
}
else {
	if (move_uploaded_file($_FILES["EmpPhoto"]["tmp_name"], "img-employees/".$EmpID."-photo.jpg")) {
		echo "<div class=\"alert alert-success\">Photo was successfully uploaded.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Photo was not uploaded due to some moving error.</div>";
	}
}
/* photo upload checks ends */


/* signature upload checks starts */
$sig_target_file = "img-employees/" . basename($_FILES["EmpSig"]["name"]);
$sig_uploadOk = 1;
$sig_imageFileType = pathinfo($sig_target_file,PATHINFO_EXTENSION);

// Check if signature file is a actual image or fake image
if(isset($_POST["submit"])) {
	$sig_check = @getimagesize($_FILES["EmpSig"]["tmp_name"]);
	if ($sig_check !== false) {
		$sig_uploadOk = 1;
	}
	else {
		echo "<div class=\"alert alert-danger\">Signature was not uploaded. Signature file is invalid.</div>";
		$sig_uploadOk = 0;
	}
}

// Check if file already exists
/*if (file_exists($sig_target_file)) {
	echo "<div class=\"alert alert-danger\">Signature was not uploaded. Signature already exists. Delete the old signature first from the server.</div>";
	$sig_uploadOk = 0;
}*/

// Check file size
if ($_FILES["EmpSig"]["size"] > 100000) {
	echo "<div class=\"alert alert-danger\">Signature was not uploaded. Signature filesize was larger than the allowed maximum of 1 MB.</div>";
	$sig_uploadOk = 0;
}

// Allow certain file formats
if ($sig_imageFileType != "jpg") {
	echo "<div class=\"alert alert-danger\">Signature was not uploaded. Only jpg files are accepted.</div>";
	$sig_uploadOk = 0;
}

// Check if $sig_uploadOk is set to 0 by an error
if ($sig_uploadOk == 0) {
	echo "<div class=\"alert alert-danger\">Signature was not uploaded due to some upload error.</div>";
}
else {
	if (move_uploaded_file($_FILES["EmpSig"]["tmp_name"], "img-employees/".$EmpID."-sig.jpg")) {
		echo "<div class=\"alert alert-success\">Signature was successfully uploaded.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Signature was not uploaded due to some moving error.</div>";
	}
}
/* signature upload checks ends */

}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql_empnew . "<br />" . $conn->error . "</div>";
}

}
/*------------------------------new employee with pic-sig insert ends-----------------------------------*/


/*------------------------------edit employee with pic-sig insert starts-----------------------------------*/
if (isset($_POST["submitedit"])) {

$sql_empedit = "UPDATE employees SET EmpName = '$_POST[EmpName]', EmpFName = '$_POST[EmpFName]', EmpMName = '$_POST[EmpMName]', EmpDOB = '$_POST[EmpDOB]', EmpJoinDate = '$_POST[EmpJoinDate]', EmpSex = '$_POST[EmpSex]', EmpLAdd = '$_POST[EmpLAdd]', EmpPAdd = '$_POST[EmpPAdd]', EmpPhone = '$_POST[EmpPhone]', EmpEmail = '$_POST[EmpEmail]', EmpPAN = '$_POST[EmpPAN]', EmpAadhaar = '$_POST[EmpAadhaar]', EmpBrID = '$_POST[EmpBrID]', EmpRole = '$_POST[EmpRole]', EmpLogin = '$_POST[EmpLogin]', EmpPass = '$_POST[EmpPass]' WHERE EmpID = $_POST[EmpID]";

if ($conn->query($sql_empedit) === TRUE) {
	$EmpID = $_POST["EmpID"];
	echo "<div class=\"alert alert-warning\">If photo and/or signature do not appear to be updated, the old files might be cached. Reload by pressing F5.</div>";
	echo "<div class=\"alert alert-success\">The employee details were updated successfully.</div>";


/* photo upload checks starts */
$photo_target_file = "img-employees/" . basename($_FILES["EmpPhoto"]["name"]);
$photo_uploadOk = 1;
$photo_imageFileType = pathinfo($photo_target_file,PATHINFO_EXTENSION);

// Check if photo file is a actual image or fake image
if(isset($_POST["submit"])) {
	$photo_check = @getimagesize($_FILES["EmpPhoto"]["tmp_name"]);
	if ($photo_check !== false) {
		$photo_uploadOk = 1;
	}
	else {
		echo "<div class=\"alert alert-danger\">Photo was not changed. Photo file is invalid.</div>";
		$photo_uploadOk = 0;
	}
}

// Check if file already exists
/*if (file_exists($photo_target_file)) {
	echo "<div class=\"alert alert-danger\">Photo was not changed. Photo already exists. Delete the old photo first from the server.</div>";
	$photo_uploadOk = 0;
}*/

// Check file size
if ($_FILES["EmpPhoto"]["size"] > 100000) {
	echo "<div class=\"alert alert-danger\">Photo was not changed. Photo filesize was larger than the allowed maximum of 1 MB.</div>";
	$photo_uploadOk = 0;
}

// Allow certain file formats
if ($photo_imageFileType != "jpg") {
	echo "<div class=\"alert alert-danger\">Photo was not changed. Only jpg files are accepted.</div>";
	$photo_uploadOk = 0;
}

// Check if $photo_uploadOk is set to 0 by an error
if ($photo_uploadOk == 0) {
	echo "<div class=\"alert alert-danger\">Photo was not changed due to some upload error.</div>";
}
else {
	if (move_uploaded_file($_FILES["EmpPhoto"]["tmp_name"], "img-employees/$_POST[EmpID]-photo.jpg")) {
		echo "<div class=\"alert alert-success\">Photo was successfully changed.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Photo was not changed due to some moving error.</div>";
	}
}
/* photo upload checks ends */


/* signature upload checks starts */
$sig_target_file = "img-employees/" . basename($_FILES["EmpSig"]["name"]);
$sig_uploadOk = 1;
$sig_imageFileType = pathinfo($sig_target_file,PATHINFO_EXTENSION);

// Check if signature file is a actual image or fake image
if(isset($_POST["submit"])) {
	$sig_check = @getimagesize($_FILES["EmpSig"]["tmp_name"]);
	if ($sig_check !== false) {
		$sig_uploadOk = 1;
	}
	else {
		echo "<div class=\"alert alert-danger\">Signature was not changed. Signature file is invalid.</div>";
		$sig_uploadOk = 0;
	}
}

// Check if file already exists
/*if (file_exists($sig_target_file)) {
	echo "<div class=\"alert alert-danger\">Signature was not changed. Signature already exists. Delete the old signature first from the server.</div>";
	$sig_uploadOk = 0;
}*/

// Check file size
if ($_FILES["EmpSig"]["size"] > 100000) {
	echo "<div class=\"alert alert-danger\">Signature was not changed. Signature filesize was larger than the allowed maximum of 1 MB.</div>";
	$sig_uploadOk = 0;
}

// Allow certain file formats
if ($sig_imageFileType != "jpg") {
	echo "<div class=\"alert alert-danger\">Signature was not changed. Only jpg files are accepted.</div>";
	$sig_uploadOk = 0;
}

// Check if $sig_uploadOk is set to 0 by an error
if ($sig_uploadOk == 0) {
	echo "<div class=\"alert alert-danger\">Signature was not changed due to some upload error.</div>";
}
else {
	if (move_uploaded_file($_FILES["EmpSig"]["tmp_name"], "img-employees/$_POST[EmpID]-sig.jpg")) {
		echo "<div class=\"alert alert-success\">Signature was successfully changed.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Signature was not changed due to some moving error.</div>";
	}
}
/* signature upload checks ends */

}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql_empedit . "<br />" . $conn->error . "</div>";
}

}
/*------------------------------edit employee with pic-sig insert ends-----------------------------------*/


/*------------------------------for view through link request starts-----------------------------------*/
if (isset($_GET["id"])) { $EmpID = $_GET["id"];
/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT EmpID FROM employees WHERE EmpID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["EmpID"];
}
/* setting check parameters end */
/*------------------------------for view through link request ends-----------------------------------*/


if (isset($_POST["submitnew"]) || isset($_POST["submitedit"]) || ($_GET["id"] == $my_ID)) {
/*-----------------------------displaying employee details starts-------------------------*/
$sql = "SELECT *, branches.BrLoc FROM employees INNER JOIN branches ON employees.EmpBrID=branches.BrID WHERE EmpID=".$EmpID;

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<div class=\"table-responsive\" id=\"printemprecord\">
<table class=\"table table-striped\">
	<tr>
		<td style=\"width:30%;\">Photo</td>
		<td style=\"width:70%;\"><img src=\"img-employees/".$row["EmpID"]."-photo.jpg\" alt=\"".$row["EmpName"]." - Photo Load Error\" class=\"picsig\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Signature</td>
		<td style=\"width:70%;\"><img src=\"img-employees/".$row["EmpID"]."-sig.jpg\" alt=\"".$row["EmpName"]." - Sig Load Error \" class=\"picsig\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Employee ID*</td>
		<td style=\"width:70%;\">".$row["EmpID"]."</td>
	</tr>
	<tr>
		<td>Name*</td>
		<td style=\"width:70%;\"><a href=\"admin-employee-view.php?id=".$row["EmpID"]."\">".$row["EmpName"]."</a></td>
	</tr>
	<tr>
		<td>Father's Name*</td>
		<td style=\"width:70%;\">".$row["EmpFName"]."</td>
	</tr>
	<tr>
		<td>Mother's Name</td>
		<td style=\"width:70%;\">".$row["EmpMName"]."</td>
	</tr>
	<tr>
		<td>Date of Birth*</td>
		<td>".$row["EmpDOB"]."<button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD</button></td>
	</tr>
	<tr>
		<td>Join Date*</td>
		<td>".$row["EmpJoinDate"]."<button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD</button></td>
	</tr>
	<tr>
		<td>Sex*</td>
		<td>".$row["EmpSex"]."</td>
	</tr>
	<tr>
		<td>Local Address*</td>
		<td style=\"width:70%;\">".$row["EmpLAdd"]."</td>
	</tr>
	<tr>
		<td>Permanent Address</td>
		<td style=\"width:70%;\">".$row["EmpPAdd"]."</td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style=\"width:70%;\">".$row["EmpPhone"]."</td>
	</tr>
	<tr>
		<td>Email</td>
		<td style=\"width:70%;\">".$row["EmpEmail"]."</td>
	</tr>
	<tr>
		<td>PAN</td>
		<td style=\"width:70%;\">".$row["EmpPAN"]."</td>
	</tr>
	<tr>
		<td>Aadhaar</td>
		<td style=\"width:70%;\">".$row["EmpAadhaar"]."</td>
	</tr>
	<tr>
		<td>Branch ID*</td>
		<td style=\"width:70%;\"><a href=\"admin-branch-view.php?id=".$row["EmpBrID"]."\">".$row["EmpBrID"]." (".$row["BrLoc"].")</a></td>
	</tr>
	<tr>
		<td>Role*</td>
		<td style=\"width:70%;\">".$row["EmpRole"]."</td>
	</tr>
	<tr>
		<td>Employee Login*</td>
		<td style=\"width:70%;\">".$row["EmpLogin"]."</td>
	</tr>
	<tr>
		<td>Employee Password*</td>
		<td style=\"width:70%;\">".$row["EmpPass"]."</td>
	</tr>
</table>
</div>

<button type=\"button\" class=\"btn btn-warning btn-xs\" onclick=\"printDiv('printemprecord')\">PRINT EMPLOYEE RECORD</button><a href=\"admin-employee-edit.php?id=".$row["EmpID"]."\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">EDIT</button></a>
<a href=\"admin-employee-deleted.php?id=".$row["EmpID"]."&name=".$row["EmpName"]."&fname=".$row["EmpFName"]."\"><button onclick=\"alertdeleteFunction()\" type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">DELETE PERMANENTLY</button></a>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}
/*-----------------------------displaying employee details ends-------------------------*/


/*-----------------------------list of transactions of this employee starts-------------------------*/
echo "<h3>List of Transactions by This Employee</h3>";

$sql_transemp = "SELECT * FROM transactions WHERE TrEmpID=".$EmpID." ORDER BY TrID ASC";

$result_transemp = $conn->query($sql_transemp);
if ($result_transemp->num_rows > 0) {
	echo "<div class=\"table-responsive\" id=\"printtransemp\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Date-Time Stamp<br /><span style=\"font-size:10px;\">(YYYY-MM-DD HR:MI:SC)</span></th>
		<th>Customer ID</th>
		<th>Employee ID</th>
		<th>Remarks</th>
		<th>Transaction Amount<br /><span style=\"font-size:10px;\">(&#8377;)</span></th>
	</tr>";
	// output data of each row
	while($row = $result_transemp->fetch_assoc()) {
		echo "<tr>
				<td><a href=\"admin-trans-view.php?id=".$row["TrID"]."\">".$row["TrID"]."</a></td>
				<td>".$row["TrDateTime"]."</td>
				<td><a href=\"admin-customer-view.php?id=".$row["TrCustID"]."\">".$row["TrCustID"]."</a></td>
				<td><a href=\"admin-employee-view.php?id=".$row["TrEmpID"]."\">".$row["TrEmpID"]."</a></td>
				<td>".$row["TrRemarks"]."</td>
				<td>".$row["TrAmount"]."</td>
			</tr>";
    }
	echo "</table></div>
		<button type=\"button\" class=\"btn btn-warning btn-xs\" onclick=\"printDiv('printtransemp')\">PRINT EMPLOYEE TRANSACTIONS</button>";
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}
/*-----------------------------list of transactions of this employee ends-------------------------*/

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