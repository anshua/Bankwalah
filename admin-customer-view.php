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

<h2>Customer Details</h2>


<?php
require_once "dbconfig.php";

/*------------------------------new customer with pic-sig insert starts-----------------------------------*/
if (isset($_POST["submitnew"])) {

// force insert NULL into unique field CustLogin
if ($_POST["CustLogin"] == "") { $sql_custnew = "INSERT INTO customers (CustName, CustFName, CustMName, CustDOB, CustJoinDate, CustSex, CustLAdd, CustPAdd, CustPhone, CustEmail, CustPAN, CustAadhaar, CustBrID, CustACType, CustCurrBal, CustLog, CustLogin, CustPass, CustNetBank)
VALUES ('$_POST[CustName]', '$_POST[CustFName]', '$_POST[CustMName]', '$_POST[CustDOB]', '$_POST[CustJoinDate]', '$_POST[CustSex]', '$_POST[CustLAdd]', '$_POST[CustPAdd]', '$_POST[CustPhone]', '$_POST[CustEmail]', '$_POST[CustPAN]', '$_POST[CustAadhaar]', '$_POST[CustBrID]', '$_POST[CustACType]', '$_POST[CustCurrBal]', '$_POST[CustLog]', NULL, '$_POST[CustPass]', '$_POST[CustNetBank]')"; } else { $sql_custnew = "INSERT INTO customers (CustName, CustFName, CustMName, CustDOB, CustJoinDate, CustSex, CustLAdd, CustPAdd, CustPhone, CustEmail, CustPAN, CustAadhaar, CustBrID, CustACType, CustCurrBal, CustLog, CustLogin, CustPass, CustNetBank)
VALUES ('$_POST[CustName]', '$_POST[CustFName]', '$_POST[CustMName]', '$_POST[CustDOB]', '$_POST[CustJoinDate]', '$_POST[CustSex]', '$_POST[CustLAdd]', '$_POST[CustPAdd]', '$_POST[CustPhone]', '$_POST[CustEmail]', '$_POST[CustPAN]', '$_POST[CustAadhaar]', '$_POST[CustBrID]', '$_POST[CustACType]', '$_POST[CustCurrBal]', '$_POST[CustLog]', '$_POST[CustLogin]', '$_POST[CustPass]', '$_POST[CustNetBank]')"; }


if ($conn->query($sql_custnew) === TRUE) {
	echo "<div class=\"alert alert-success\">New customer was created successfully.</div>";

// getting CustID set to AUTO_INCREMENT
$CustID = mysqli_insert_id($conn);

/* photo upload checks starts */
$photo_target_file = "img-customers/" . basename($_FILES["CustPhoto"]["name"]);
$photo_uploadOk = 1;
$photo_imageFileType = pathinfo($photo_target_file,PATHINFO_EXTENSION);

// Check if photo file is a actual image or fake image
if(isset($_POST["submit"])) {
	$photo_check = @getimagesize($_FILES["CustPhoto"]["tmp_name"]);
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
if ($_FILES["CustPhoto"]["size"] > 100000) {
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
	if (move_uploaded_file($_FILES["CustPhoto"]["tmp_name"], "img-customers/".$CustID."-photo.jpg")) {
		echo "<div class=\"alert alert-success\">Photo was successfully uploaded.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Photo was not uploaded due to some moving error.</div>";
	}
}
/* photo upload checks ends */


/* signature upload checks starts */
$sig_target_file = "img-customers/" . basename($_FILES["CustSig"]["name"]);
$sig_uploadOk = 1;
$sig_imageFileType = pathinfo($sig_target_file,PATHINFO_EXTENSION);

// Check if signature file is a actual image or fake image
if(isset($_POST["submit"])) {
	$sig_check = @getimagesize($_FILES["CustSig"]["tmp_name"]);
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
if ($_FILES["CustSig"]["size"] > 100000) {
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
	if (move_uploaded_file($_FILES["CustSig"]["tmp_name"], "img-customers/".$CustID."-sig.jpg")) {
		echo "<div class=\"alert alert-success\">Signature was successfully uploaded.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Signature was not uploaded due to some moving error.</div>";
	}
}
/* signature upload checks ends */

}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql_custnew . "<br />" . $conn->error . "</div>";
}

/* opening transaction starts */
date_default_timezone_set('Asia/Kolkata'); $datetime = date('Y-m-d H:i:s'); // setting standard time
$sql_opentrans = "INSERT INTO transactions (TrDateTime, TrRemarks, TrCustID, TrEmpID, TrAmount) VALUES ('$datetime', 'Account Opening Balance', '$CustID', '$ses_EmpID', '$_POST[CustCurrBal]')";
if ($conn->query($sql_opentrans) === TRUE) {
	echo "<div class=\"alert alert-success\">Account Opening Transaction was created with the given balance.</div>";
}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql_opentrans . "<br />" . $conn->error . "</div>";
}
/* opening transaction ends */

}
/*------------------------------new customer with pic-sig insert ends-----------------------------------*/


/*------------------------------edit customer with pic-sig insert starts-----------------------------------*/
if (isset($_POST["submitedit"])) {

// force insert NULL into unique field CustLogin
if ($_POST["CustLogin"] == "") { $sql_custedit = "UPDATE customers SET CustName = '$_POST[CustName]', CustFName = '$_POST[CustFName]', CustMName = '$_POST[CustMName]', CustDOB = '$_POST[CustDOB]', CustJoinDate = '$_POST[CustJoinDate]', CustSex = '$_POST[CustSex]', CustLAdd = '$_POST[CustLAdd]', CustPAdd = '$_POST[CustPAdd]', CustPhone = '$_POST[CustPhone]', CustEmail = '$_POST[CustEmail]', CustPAN = '$_POST[CustPAN]', CustAadhaar = '$_POST[CustAadhaar]', CustBrID = '$_POST[CustBrID]', CustACType = '$_POST[CustACType]', CustLog = '$_POST[CustLog]', CustLogin = NULL, CustPass = '$_POST[CustPass]', CustNetBank = '$_POST[CustNetBank]' WHERE CustID = $_POST[CustID]"; } else { $sql_custedit = "UPDATE customers SET CustName = '$_POST[CustName]', CustFName = '$_POST[CustFName]', CustMName = '$_POST[CustMName]', CustDOB = '$_POST[CustDOB]', CustJoinDate = '$_POST[CustJoinDate]', CustSex = '$_POST[CustSex]', CustLAdd = '$_POST[CustLAdd]', CustPAdd = '$_POST[CustPAdd]', CustPhone = '$_POST[CustPhone]', CustEmail = '$_POST[CustEmail]', CustPAN = '$_POST[CustPAN]', CustAadhaar = '$_POST[CustAadhaar]', CustBrID = '$_POST[CustBrID]', CustACType = '$_POST[CustACType]', CustLog = '$_POST[CustLog]', CustLogin = '$_POST[CustLogin]', CustPass = '$_POST[CustPass]', CustNetBank = '$_POST[CustNetBank]' WHERE CustID = $_POST[CustID]"; }


if ($conn->query($sql_custedit) === TRUE) {
	$CustID = $_POST["CustID"];
	echo "<div class=\"alert alert-warning\">If photo and/or signature do not appear to be updated, the old files might be cached. Reload by pressing F5.</div>";
	echo "<div class=\"alert alert-success\">The customer details were updated successfully.</div>";


/* photo upload checks starts */
$photo_target_file = "img-customers/" . basename($_FILES["CustPhoto"]["name"]);
$photo_uploadOk = 1;
$photo_imageFileType = pathinfo($photo_target_file,PATHINFO_EXTENSION);

// Check if photo file is a actual image or fake image
if(isset($_POST["submit"])) {
	$photo_check = @getimagesize($_FILES["CustPhoto"]["tmp_name"]);
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
if ($_FILES["CustPhoto"]["size"] > 100000) {
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
	if (move_uploaded_file($_FILES["CustPhoto"]["tmp_name"], "img-customers/$_POST[CustID]-photo.jpg")) {
		echo "<div class=\"alert alert-success\">Photo was successfully changed.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Photo was not changed due to some moving error.</div>";
	}
}
/* photo upload checks ends */


/* signature upload checks starts */
$sig_target_file = "img-customers/" . basename($_FILES["CustSig"]["name"]);
$sig_uploadOk = 1;
$sig_imageFileType = pathinfo($sig_target_file,PATHINFO_EXTENSION);

// Check if signature file is a actual image or fake image
if(isset($_POST["submit"])) {
	$sig_check = @getimagesize($_FILES["CustSig"]["tmp_name"]);
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
if ($_FILES["CustSig"]["size"] > 100000) {
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
	if (move_uploaded_file($_FILES["CustSig"]["tmp_name"], "img-customers/$_POST[CustID]-sig.jpg")) {
		echo "<div class=\"alert alert-success\">Signature was successfully changed.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Signature was not changed due to some moving error.</div>";
	}
}
/* signature upload checks ends */

}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql_custedit . "<br />" . $conn->error . "</div>";
}

}
/*------------------------------edit customer with pic-sig insert ends-----------------------------------*/


/*------------------------------for view through link request starts-----------------------------------*/
if (isset($_GET["id"])) { $CustID = $_GET["id"];
/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT CustID FROM customers WHERE CustID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["CustID"];
}
/* setting check parameters end */
/*------------------------------for view through link request ends-----------------------------------*/


if (isset($_POST["submitnew"]) || isset($_POST["submitedit"]) || ($_GET["id"] == $my_ID)) {
/*-----------------------------displaying customer details starts-------------------------*/
$sql = "SELECT *, branches.BrLoc FROM customers INNER JOIN branches ON customers.CustBrID=branches.BrID WHERE CustID=".$CustID;

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<div class=\"table-responsive\" id=\"printcustrecord\">
<table class=\"table table-striped\">
	<tr>
		<td>Current Balance*</td>
		<td style=\"width:70%;\"><button type=\"button\" class=\"btn btn-default btn-lg\" style=\"color:limegreen; font-size:40px; border-radius:50%;\">&#8377; ".$row["CustCurrBal"]."</button></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Photo</td>
		<td style=\"width:70%;\"><img src=\"img-customers/".$row["CustID"]."-photo.jpg\" alt=\"".$row["CustName"]." - Photo Load Error\" class=\"picsig\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Signature</td>
		<td style=\"width:70%;\"><img src=\"img-customers/".$row["CustID"]."-sig.jpg\" alt=\"".$row["CustName"]." - Sig Load Error \" class=\"picsig\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Customer ID*</td>
		<td style=\"width:70%;\">".$row["CustID"]."</td>
	</tr>
	<tr>
		<td>Name*</td>
		<td style=\"width:70%;\"><a href=\"admin-customer-view.php?id=".$row["CustID"]."\">".$row["CustName"]."</a></td>
	</tr>
	<tr>
		<td>Father's Name*</td>
		<td style=\"width:70%;\">".$row["CustFName"]."</td>
	</tr>
	<tr>
		<td>Mother's Name</td>
		<td style=\"width:70%;\">".$row["CustMName"]."</td>
	</tr>
	<tr>
		<td>Date of Birth*</td>
		<td>".$row["CustDOB"]."<button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD</button></td>
	</tr>
	<tr>
		<td>Join Date*</td>
		<td>".$row["CustJoinDate"]."<button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD</button></td>
	</tr>
	<tr>
		<td>Sex*</td>
		<td>".$row["CustSex"]."</td>
	</tr>
	<tr>
		<td>Local Address*</td>
		<td style=\"width:70%;\">".$row["CustLAdd"]."</td>
	</tr>
	<tr>
		<td>Permanent Address</td>
		<td style=\"width:70%;\">".$row["CustPAdd"]."</td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style=\"width:70%;\">".$row["CustPhone"]."</td>
	</tr>
	<tr>
		<td>Email</td>
		<td style=\"width:70%;\">".$row["CustEmail"]."</td>
	</tr>
	<tr>
		<td>PAN</td>
		<td style=\"width:70%;\">".$row["CustPAN"]."</td>
	</tr>
	<tr>
		<td>Aadhaar</td>
		<td style=\"width:70%;\">".$row["CustAadhaar"]."</td>
	</tr>
	<tr>
		<td>Branch ID*</td>
		<td style=\"width:70%;\"><a href=\"admin-branch-view.php?id=".$row["CustBrID"]."\">".$row["CustBrID"]." (".$row["BrLoc"].")</a></td>
	</tr>
	<tr>
		<td>Account Type*</td>
		<td style=\"width:70%;\">".$row["CustACType"]."</td>
	</tr>
	<tr>
		<td>Customer Log</td>
		<td style=\"width:70%;\">".$row["CustLog"]."</td>
	</tr>
	<tr>
		<td>Net Banking Required*</td>
		<td style=\"width:70%;\">".$row["CustNetBank"]."</td>
	</tr>
	<tr>
		<td>Net Banking Login</td>
		<td style=\"width:70%;\">".$row["CustLogin"]."</td>
	</tr>
	<tr>
		<td>Net Banking Password</td>
		<td style=\"width:70%;\">".$row["CustPass"]."</td>
	</tr>
</table>
</div>

<button type=\"button\" class=\"btn btn-warning btn-xs\" onclick=\"printDiv('printcustrecord')\">PRINT CUSTOMER RECORD</button><a href=\"admin-customer-edit.php?id=".$row["CustID"]."\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">EDIT</button></a>
<a href=\"admin-customer-deleted.php?id=".$row["CustID"]."&name=".$row["CustName"]."&fname=".$row["CustFName"]."\"><button onclick=\"alertdeleteFunction()\" type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">DELETE PERMANENTLY</button></a><a href=\"admin-trans-new.php?id=".$row["CustID"]."&name=".$row["CustName"]."&bal=".$row["CustCurrBal"]."\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">TRANSACT</button></a><a href=\"admin-trans-tform.php?id=".$row["CustID"]."&name=".$row["CustName"]."&bal=".$row["CustCurrBal"]."\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">TRANSFER</button></a>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}
/*-----------------------------displaying customer details ends-------------------------*/


/*-----------------------------list of transactions of this customer starts-------------------------*/
echo "<h3>List of Transactions by This Customer</h3>";

$sql_transcust = "SELECT * FROM transactions WHERE TrCustID=".$CustID." ORDER BY TrID ASC";

$result_transcust = $conn->query($sql_transcust);
if ($result_transcust->num_rows > 0) {
	echo "<div class=\"table-responsive\" id=\"printtranscust\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Date-Time Stamp<br /><span style=\"font-size:10px;\">(YYYY-MM-DD HR:MI:SC)</span></th>
		<th>Customer ID</th>
		<th>Employee ID</th>
		<th>Remarks</th>
		<th>Transaction Amount<br /><span style=\"font-size:10px;\">(&#8377;)</span></th>
		<th>Balance<br /><span style=\"font-size:10px;\">(&#8377;)</span></th>
	</tr>";
	// output data of each row
	$finbal = 0.00;
	while($row = $result_transcust->fetch_assoc()) {
		$finbal = $finbal + $row["TrAmount"];

		echo "<tr>
				<td><a href=\"admin-trans-view.php?id=".$row["TrID"]."\">".$row["TrID"]."</a></td>
				<td>".$row["TrDateTime"]."</td>
				<td><a href=\"admin-customer-view.php?id=".$row["TrCustID"]."\">".$row["TrCustID"]."</a></td>
				<td><a href=\"admin-employee-view.php?id=".$row["TrEmpID"]."\">".$row["TrEmpID"]."</a></td>
				<td>".$row["TrRemarks"]."</td>
				<td>".$row["TrAmount"]."</td>
				<td>".$finbal."</td>
			</tr>";
    }
	echo "</table></div>
		<button type=\"button\" class=\"btn btn-warning btn-xs\" onclick=\"printDiv('printtranscust')\">PRINT CUSTOMER TRANSACTIONS</button>";
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}
/*-----------------------------list of transactions of this customer ends-------------------------*/


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