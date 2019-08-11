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

<h2>Customer Records Deleted</h2>


<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT CustID FROM customers WHERE CustBrID=$ses_BrID AND CustID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["CustID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {
/*----------------deleting existing customer starts---------------------*/
$sql = "DELETE FROM customers WHERE CustID=".$_GET["id"];

if ($conn->query($sql) === TRUE) {
	echo "<div class=\"alert alert-success\">Customer ID : ".$_GET["id"]."<br />Customer Name : ".$_GET["name"]."<br />Father's Name : ".$_GET["fname"]."<br /><br />All records of the above customer were deleted permanently.</div>";

	$photo_file = "img-customers/".$_GET["id"]."-photo.jpg";
	$sig_file = "img-customers/".$_GET["id"]."-sig.jpg";

	if (file_exists($photo_file)) {
		if (!unlink($photo_file)) { echo "<div class=\"alert alert-danger\">Photo was not deleted due to some error.</div>"; } else { echo "<div class=\"alert alert-success\">Photo was deleted.</div>"; }
	}
	else {
		echo "<div class=\"alert alert-info\">There was no photo for this customer.</div>";
	}
	
	if (file_exists($sig_file)) {
		if (!unlink($sig_file)) { echo "<div class=\"alert alert-danger\">Signature was not deleted due to some error.</div>"; } else { echo "<div class=\"alert alert-success\">Signature was deleted.</div>"; }
	}
	else {
		echo "<div class=\"alert alert-info\">There was no signature for this customer.</div>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql . "<br />" . $conn->error . "</div>";
}
/*----------------deleting existing customer ends---------------------*/


/*----------------deleting transactions of the customer starts---------------------*/
$sql_deltr = "DELETE FROM transactions WHERE TrCustID=".$_GET["id"];

if ($conn->query($sql_deltr) === TRUE) {
	echo "<div class=\"alert alert-success\">All transactions of the customer were deleted.</div>";
}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql_deltr . "<br />" . $conn->error . "</div>";
}
/*----------------deleting transactions of the customer ends---------------------*/



}
else {
	header("Location: manager-dashboard.php");
}

?>

<a href="manager-customer-search.php"><button type="button" class="btn btn-warning btn-xs">SEARCH ANOTHER CUSTOMER</button></a>


		</div>
		<div class="col-sm-4 mainside-mgr"><?php include_once "manager-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-mgr"><?php include_once "manager-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>