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

<h2>Employee Records Deleted</h2>


<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT EmpID FROM employees WHERE EmpID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["EmpID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {

$sql = "DELETE FROM employees WHERE EmpID=".$_GET["id"];

if ($conn->query($sql) === TRUE) {
	echo "<div class=\"alert alert-success\">Employee ID : ".$_GET["id"]."<br />Employee Name : ".$_GET["name"]."<br />Father's Name : ".$_GET["fname"]."<br /><br />All records of the above employee were deleted permanently.</div>";

	$photo_file = "img-employees/".$_GET["id"]."-photo.jpg";
	$sig_file = "img-employees/".$_GET["id"]."-sig.jpg";

	if (file_exists($photo_file)) {
		if (!unlink($photo_file)) { echo "<div class=\"alert alert-danger\">Photo was not deleted due to some error.</div>"; } else { echo "<div class=\"alert alert-success\">Photo was deleted.</div>"; }
	}
	else {
		echo "<div class=\"alert alert-info\">There was no photo for this employee.</div>";
	}
	
	if (file_exists($sig_file)) {
		if (!unlink($sig_file)) { echo "<div class=\"alert alert-danger\">Signature was not deleted due to some error.</div>"; } else { echo "<div class=\"alert alert-success\">Signature was deleted.</div>"; }
	}
	else {
		echo "<div class=\"alert alert-info\">There was no signature for this employee.</div>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql . "<br />" . $conn->error . "</div>";
}

}
else {
	header("Location: admin-dashboard.php");
}

?>

<a href="admin-employee-search.php"><button type="button" class="btn btn-warning btn-xs">SEARCH ANOTHER EMPLOYEE</button></a>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>