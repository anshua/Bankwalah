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

<h2>Edit Transaction Details</h2>

<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT transactions.TrID FROM transactions INNER JOIN customers ON transactions.TrCustID=customers.CustID WHERE customers.CustBrID=$ses_BrID AND transactions.TrID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["TrID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {

$sql = "SELECT * FROM transactions WHERE TrID=".$_GET["id"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<div class=\"alert alert-danger\">Fields marked with * are mandatory.</div>
<form action=\"clerk-trans-view.php\" method=\"post\" name=\"FormClock\">
<div class=\"table-responsive\">
<table class=\"table table-striped\">
	<tr>
		<td style=\"width:30%;\">Transaction ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrID\" style=\"width:50%; background-color:red;\" value=\"".$row["TrID"]."\" readonly></td>
	</tr>
	<tr>
		<td>Date-Time Stamp*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrDateTime\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD HR:MI:SC</button></td>
	</tr>
	<tr>
		<td>Remarks</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrRemarks\" style=\"width:50%;\" value=\"".$row["TrRemarks"]."\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Customer ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrCustID\" style=\"width:50%; background-color:red;\" value=\"".$row["TrCustID"]."\" readonly></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Employee ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrEmpID\" style=\"width:50%; background-color:red;\" value=\"".$row["TrEmpID"]."\" readonly></td>
	</tr>
	<tr>
		<td>Transaction Amount*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"TrAmount\" style=\"width:50%;\" value=\"".$row["TrAmount"]."\" required><button type=\"button\" class=\"btn btn-danger btn-xs blink\" style=\"margin-left:20px;\" disabled>&#8377; Upto 2 Decimals ♦ + For Credit ♦ - For Debit</button></td>
	</tr>
</table>
</div>
<input type=\"submit\" name=\"submitedit\" value=\"UPDATE AND ADJUST BALANCE\"><a href=\"clerk-trans-view.php?id=".$row["TrID"]."\"><button type=\"button\" class=\"btn btn-info btn-xs\" style=\"margin-left:20px;\">RETURN</button></a>
</form>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}

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