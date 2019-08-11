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

<h2>Transaction Record Deleted</h2>


<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT TrID FROM transactions WHERE TrID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["TrID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {

	// revising customer balance
	$amt1 = mysqli_query($conn, "SELECT TrAmount FROM Transactions WHERE TrID=$_GET[id]"); $amt2 = mysqli_fetch_assoc($amt1); $prevamt = $amt2["TrAmount"];
	$sql_balrevise = "UPDATE customers SET CustCurrBal=(CustCurrBal - $prevamt) WHERE CustID=$_GET[cid]";
	if ($conn->query($sql_balrevise) === TRUE) {
		echo "<div class=\"alert alert-success\">Customer Balance was revised.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_balrevise . "<br />" . $conn->error . "</div>";
	}

	// deleting transaction
	$sql_transdel = "DELETE FROM transactions WHERE TrID=".$_GET["id"];
	if ($conn->query($sql_transdel) === TRUE) {
		echo "<div class=\"alert alert-success\">Transaction ID : ".$_GET["id"]."<br />Customer ID : ".$_GET["cid"]."<br />Customer Name : ".$_GET["name"]."<br />Transaction Amount : ".$_GET["tramount"]."<br /><br />The above mentioned transaction was deleted permanently.</div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_transdel . "<br />" . $conn->error . "</div>";
	}
}
else {
	header("Location: admin-dashboard.php");
}


?>

<a href="admin-trans-search.php"><button type="button" class="btn btn-warning btn-xs">SEARCH ANOTHER TRANSACTION</button></a>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>