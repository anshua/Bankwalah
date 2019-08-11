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

<h2>Transfer Confirm</h2>

<div class="alert alert-warning">The process uses javascript clock which interprets your system time. To avaoid uploading wrong time into database, keep your computer's time accurate. Also, do not reload the page after submit, otherwise the same transaction may occur twice.</div>

<?php echo "<div class=\"alert alert-danger\">Fields marked with * are mandatory. Only money transfers of customers of this Branch ".$ses_BrID." (".$ses_BrLoc.") will be furnished. Others will be discarded.</div>"; ?>


<?php

/*------------------------------getting thiscustbranch starts-----------------------------------*/
if (isset($_POST["submit"])) {
	$my_sql = mysqli_query($conn,"SELECT branches.BrID FROM customers INNER JOIN branches ON customers.CustBrID=branches.BrID WHERE customers.CustID=$_POST[TrCustID]"); $my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC); $thiscustbranch = $my_row["BrID"];
}
/*------------------------------getting thiscustbranch ends-----------------------------------*/
/* setting check parameters starts */
$sql_send = mysqli_query($conn,"SELECT CustID, CustName, CustCurrBal FROM customers WHERE CustID=$_POST[TrCustID]");
$row_send = mysqli_fetch_array($sql_send,MYSQLI_ASSOC); // use varibales as $row_send["CustID"]

$sql_rec = mysqli_query($conn,"SELECT CustID, CustName, CustFName FROM customers WHERE CustID=$_POST[TrRecID]");
$row_rec = mysqli_fetch_array($sql_rec,MYSQLI_ASSOC); // use varibales as $row_rec["CustID"]
/* setting check parameters end */

if (($thiscustbranch == $ses_BrID) && isset($_POST["TrCustID"]) && isset($_POST["TrRecID"]) && isset($_POST["TrAmount"]) && ($_POST["TrAmount"] <= $row_send["CustCurrBal"])) {

	echo  "<form action=\"clerk-trans-view.php\" method=\"post\" name=\"FormClock\">
<div class=\"table-responsive\">
<table class=\"table table-striped\">
	<tr>
		<td style=\"width:30%;\">Transaction ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrID\" value=\"SET TO AUTO_INCREMENT\" style=\"width:50%;\" disabled></td>
	</tr>
	<tr>
		<td>Date-Time Stamp*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrDateTime\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD HR:MI:SC</button></td>
	</tr>
	<tr>
		<td>Remarks</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrRemarks\" value=\"".$_POST["TrRemarks"]."\" style=\"width:50%;\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Customer ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrCustID\" value=\"".$row_send["CustID"]."\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>".$row_send["CustName"].", Balance: &#8377; ".$row_send["CustCurrBal"]."</button></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Customer Photo-Signature</td>
		<td style=\"width:70%;\"><img src=\"img-customers/".$row_send["CustID"]."-photo.jpg\" alt=\"".$row_send["CustName"]." - Photo Load Error\" class=\"picsig\"><img src=\"img-customers/".$row_send["CustID"]."-sig.jpg\" alt=\"".$row_send["CustName"]." - Sig Load Error \" class=\"picsig\" style=\"margin-left:20px;\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Recipient ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrRecID\" value=\"".$row_rec["CustID"]."\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>".$row_rec["CustName"].", S/O ".$row_rec["CustFName"]."</button></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Recipient Photo</td>
		<td style=\"width:70%;\"><img src=\"img-customers/".$row_rec["CustID"]."-photo.jpg\" alt=\"".$row_rec["CustName"]." - Photo Load Error\" class=\"picsig\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Employee ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrEmpID\" value=\"".$ses_EmpID."\" style=\"width:50%; background-color:red;\" readonly></td>
	</tr>
	<tr>
		<td>Transfer Amount*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrAmount\" value=\"".$_POST["TrAmount"]."\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs blink\" style=\"margin-left:20px;\" disabled>&#8377; Upto 2 Decimals ♦ + For Credit ♦ - For Debit</button></td>
	</tr>
</table>
</div>
<input type=\"submit\" name=\"submitconf\" value=\"CONFIRM\"><a href=\"clerk-trans-tform.php\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">DISCARD AND START FRESH TRANSFER</button></a></form>";
}

else {
	header("Location: clerk-dashboard.php");
}

?>



		</div>
		<div class="col-sm-4 mainside-clr"><?php include_once "clerk-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-clr"><?php include_once "clerk-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<script type="text/javascript" src="js/livedatetime.js"></script>
<?php $conn->close(); ?></body>
</html>