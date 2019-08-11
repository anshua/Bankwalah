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

<h2>Transaction Confirm</h2>

<div class="alert alert-warning">The process uses javascript clock which interprets your system time. To avaoid uploading wrong time into database, keep your computer's time accurate. Also, do not reload the page after submit, otherwise the same transaction may occur twice.</div>
<div class="alert alert-danger">Fields marked with * are mandatory.</div>



<?php
/* setting check parameters starts */
$sql_newtr = mysqli_query($conn,"SELECT CustID, CustName, CustCurrBal FROM customers WHERE CustID=$_POST[TrCustID]");
$row_newtr = mysqli_fetch_array($sql_newtr,MYSQLI_ASSOC); // use varibales as $row_newtr["CustID"]
/* setting check parameters end */

if (isset($_POST["TrCustID"]) && isset($_POST["TrAmount"]) && ($_POST["TrAmount"] >= -$row_newtr["CustCurrBal"])) {
	echo  "<form action=\"admin-trans-view.php\" method=\"post\" name=\"FormClock\">
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
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrCustID\" value=\"".$row_newtr["CustID"]."\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>".$row_newtr["CustName"].", Balance: &#8377; ".$row_newtr["CustCurrBal"]."</button></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Customer Photo-Signature</td>
		<td style=\"width:70%;\"><img src=\"img-customers/".$row_newtr["CustID"]."-photo.jpg\" alt=\"".$row_newtr["CustName"]." - Photo Load Error\" class=\"picsig\"><img src=\"img-customers/".$row_newtr["CustID"]."-sig.jpg\" alt=\"".$row_newtr["CustName"]." - Sig Load Error \" class=\"picsig\" style=\"margin-left:20px;\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Employee ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrEmpID\" value=\"".$ses_EmpID."\" style=\"width:50%; background-color:red;\" readonly></td>
	</tr>
	<tr>
		<td>Transaction Amount*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrAmount\" value=\"".$_POST["TrAmount"]."\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs blink\" style=\"margin-left:20px;\" disabled>&#8377; Upto 2 Decimals ♦ + For Credit ♦ - For Debit</button></td>
	</tr>
</table>
</div>
<input type=\"submit\" name=\"submitnew\" value=\"CONFIRM\"><a href=\"admin-trans-view.php\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">DISCARD AND START FRESH TRANSACTION</button></a></form>";
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
<script type="text/javascript" src="js/livedatetime.js"></script>
<?php $conn->close(); ?></body>
</html>