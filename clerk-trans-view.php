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

<h2>Transaction Details</h2>


<?php
require_once "dbconfig.php";

/*------------------------------getting thiscustbranch starts-----------------------------------*/
if (isset($_POST["submitnew"]) || isset($_POST["submitedit"]) || isset($_POST["submitconf"])) { $my_sql = mysqli_query($conn,"SELECT branches.BrID FROM customers INNER JOIN branches ON customers.CustBrID=branches.BrID WHERE customers.CustID=$_POST[TrCustID]"); $my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC); $thiscustbranch = $my_row["BrID"]; }
/*------------------------------getting thiscustbranch ends-----------------------------------*/


// for new transaction
if (isset($_POST["submitnew"]) && ($thiscustbranch == $ses_BrID)) {
	// uploading transaction
	$sql_trans = "INSERT INTO transactions (TrDateTime, TrRemarks, TrCustID, TrEmpID, TrAmount) VALUES ('$_POST[TrDateTime]', '$_POST[TrRemarks]', '$_POST[TrCustID]', '$_POST[TrEmpID]', '$_POST[TrAmount]')";
	if ($conn->query($sql_trans) === TRUE) {
		echo "<div class=\"alert alert-success\">Transaction was successful.</div>";
		// getting TrID set to AUTO_INCREMENT
		$TrID = mysqli_insert_id($conn);
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_trans . "<br />" . $conn->error . "</div>";
	}

	// updating customer balance
	$sql_balupdate = "UPDATE customers SET CustCurrBal=(CustCurrBal + $_POST[TrAmount]) WHERE CustID=$_POST[TrCustID]";
	if ($conn->query($sql_balupdate) === TRUE) {
		echo "<div class=\"alert alert-success\">Customer Balance was updated.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_balupdate . "<br />" . $conn->error . "</div>";
	}
}

// for updating existing transaction
if (isset($_POST["submitedit"]) && ($thiscustbranch == $ses_BrID)) {
	// revising customer balance
	$amt1 = mysqli_query($conn, "SELECT TrAmount FROM Transactions WHERE TrID=$_POST[TrID]"); $amt2 = mysqli_fetch_assoc($amt1); $prevamt = $amt2["TrAmount"];
	$sql_balrevise = "UPDATE customers SET CustCurrBal=(CustCurrBal - $prevamt + $_POST[TrAmount]) WHERE CustID=$_POST[TrCustID]";
	if ($conn->query($sql_balrevise) === TRUE) {
		echo "<div class=\"alert alert-success\">Customer Balance was revised.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_balrevise . "<br />" . $conn->error . "</div>";
	}

	// revising transaction
	$sql_transrevise = "UPDATE transactions SET TrDateTime = '$_POST[TrDateTime]', TrRemarks = '$_POST[TrRemarks]', TrAmount = '$_POST[TrAmount]' WHERE TrID = $_POST[TrID]";
	if ($conn->query($sql_transrevise) === TRUE) {
		echo "<div class=\"alert alert-success\">Transaction was revised.</div>";
		$TrID = $_POST["TrID"];
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_transrevise . "<br />" . $conn->error . "</div>";
	}
}




// for transfer of money
if (isset($_POST["submitconf"]) && ($thiscustbranch == $ses_BrID)) {
	// collecting sender and recipient information
	$sql_s = mysqli_query($conn,"SELECT CustID, CustName, CustCurrBal FROM customers WHERE CustID=$_POST[TrCustID]");
	$row_s = mysqli_fetch_array($sql_s,MYSQLI_ASSOC); // use varibales as $row_s["CustID"]

	$sql_r = mysqli_query($conn,"SELECT CustID, CustName FROM customers WHERE CustID=$_POST[TrRecID]");
	$row_r = mysqli_fetch_array($sql_r,MYSQLI_ASSOC); // use varibales as $row_r["CustID"]

	$TrRemarks_s = "Sent to ID ".$row_r["CustID"]." (".$row_r["CustName"].") ".$_POST["TrRemarks"];
	$TrRemarks_r = "Received from ID ".$row_s["CustID"]." (".$row_s["CustName"].") ".$_POST["TrRemarks"];
	$TrAmount_s = -$_POST["TrAmount"];
	$TrAmount_r = $_POST["TrAmount"];
	
	// uploading sent transaction
	$sql_send = "INSERT INTO transactions (TrDateTime, TrRemarks, TrCustID, TrEmpID, TrAmount) VALUES ('$_POST[TrDateTime]', '$TrRemarks_s', '$_POST[TrCustID]', '$_POST[TrEmpID]', '$TrAmount_s')";
	if ($conn->query($sql_send) === TRUE) {
		echo "<div class=\"alert alert-success\">Sent Transaction was successful.</div>";
		// getting TrID set to AUTO_INCREMENT
		$TrID = mysqli_insert_id($conn);
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_send . "<br />" . $conn->error . "</div>";
	}

	// updating sender balance
	$sql_sendbal = "UPDATE customers SET CustCurrBal=(CustCurrBal + $TrAmount_s) WHERE CustID=$_POST[TrCustID]";
	if ($conn->query($sql_sendbal) === TRUE) {
		echo "<div class=\"alert alert-success\">Sender Balance was updated.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_sendbal . "<br />" . $conn->error . "</div>";
	}

	// uploading receive transaction
	$sql_rec = "INSERT INTO transactions (TrDateTime, TrRemarks, TrCustID, TrEmpID, TrAmount) VALUES ('$_POST[TrDateTime]', '$TrRemarks_r', '$_POST[TrRecID]', '$_POST[TrEmpID]', '$TrAmount_r')";
	if ($conn->query($sql_rec) === TRUE) {
		echo "<div class=\"alert alert-success\">Receive Transaction was successful.</div>";
		// getting TrID set to AUTO_INCREMENT
		//$TrID = mysqli_insert_id($conn);
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_rec . "<br />" . $conn->error . "</div>";
	}

	// updating recipient balance
	$sql_recbal = "UPDATE customers SET CustCurrBal=(CustCurrBal + $TrAmount_r) WHERE CustID=$_POST[TrRecID]";
	if ($conn->query($sql_recbal) === TRUE) {
		echo "<div class=\"alert alert-success\">Recipient Balance was updated.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_recbal . "<br />" . $conn->error . "</div>";
	}
}






/*------------------------------for view through link request starts-----------------------------------*/
if (isset($_GET["id"])) { $TrID = $_GET["id"];
/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT transactions.TrID, customers.CustBrID FROM transactions INNER JOIN customers ON transactions.TrCustID=customers.CustBrID WHERE customers.CustBrID=$ses_BrID AND transactions.TrID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["TrID"];
}
/* setting check parameters end */
/*------------------------------for view through link request ends-----------------------------------*/


if (isset($_POST["submitnew"]) || isset($_POST["submitedit"]) || ($_GET["id"] == $my_ID)) {

$sql_trprint = "SELECT t.*, c.CustName, c.CustBrID, b.BrLoc
FROM transactions AS t
INNER JOIN customers AS c
ON c.CustID=t.TrCustID
INNER JOIN branches AS b
ON c.CustBrID=b.BrID
WHERE t.TrID=".$TrID;

$result = $conn->query($sql_trprint);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<div class=\"table-responsive\" id=\"printtransrecord\">
<table class=\"table table-striped\">
	<tr>
		<td>Transaction Amount*</td>
		<td style=\"width:70%;\"><button type=\"button\" class=\"btn btn-default btn-lg\" style=\"color:limegreen; font-size:40px; border-radius:50%;\">&#8377; ".$row["TrAmount"]."</button><button type=\"button\" class=\"btn btn-danger btn-xs blink\" style=\"margin-left:20px;\" disabled>&#8377; Upto 2 Decimals ♦ + For Credit ♦ - For Debit</button></td>
	</tr>
		<td style=\"width:30%;\">Customer Photo</td>
		<td style=\"width:70%;\"><img src=\"img-customers/".$row["TrCustID"]."-photo.jpg\" alt=\"".$row["CustName"]." - Photo Load Error\" class=\"picsig\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Customer Signature</td>
		<td style=\"width:70%;\"><img src=\"img-customers/".$row["TrCustID"]."-sig.jpg\" alt=\"".$row["CustName"]." - Sig Load Error \" class=\"picsig\"></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Customer Name</td>
		<td style=\"width:70%;\"><a href=\"clerk-customer-view.php?id=".$row["TrCustID"]."\">".$row["CustName"]."</a></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Branch ID</td>
		<td style=\"width:70%;\"><a href=\"clerk-branch-view.php?id=".$row["CustBrID"]."\">".$row["CustBrID"]." (".$row["BrLoc"].")</a></td>
	</tr>

	<tr>
		<td style=\"width:30%;\">Customer ID*</td>
		<td style=\"width:70%;\">".$row["TrCustID"]."</td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Employee ID*</td>
		<td style=\"width:70%;\"><a href=\"clerk-employee-view.php?id=".$row["TrEmpID"]."\">".$row["TrEmpID"]."</a></td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Transaction ID*</td>
		<td style=\"width:70%;\">".$row["TrID"]."</td>
	</tr>
	<tr>
		<td style=\"width:30%;\">Remarks</td>
		<td style=\"width:70%;\">".$row["TrRemarks"]."</td>
	</tr>
	<tr>
		<td>Date-Time Stamp*</td>
		<td style=\"width:70%;\">".$row["TrDateTime"]."<button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD HR:MI:SC</button></td>
	</tr>
</table>
</div>

<button type=\"button\" class=\"btn btn-warning btn-xs\" onclick=\"printDiv('printtransrecord')\">PRINT TRANSACTION RECEIPT</button><a href=\"clerk-trans-edit.php?id=".$row["TrID"]."\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">EDIT AND UPDATE BALANCE</button></a>
<a href=\"clerk-trans-deleted.php?id=".$row["TrID"]."&name=".$row["CustName"]."&cid=".$row["TrCustID"]."&tramount=".$row["TrAmount"]."\"><button onclick=\"alertdeleteFunction()\" type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">DELETE PERMANENTLY AND UPDATE BALANCE</button></a>";
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
<?php $conn->close(); ?>
</body>
</html>