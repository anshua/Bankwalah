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

<h2>Branch Records Deleted</h2>


<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT BrID FROM branches WHERE BrID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["BrID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {

	$sql_brdel = "DELETE FROM branches WHERE BrID=".$_GET["id"];
	if ($conn->query($sql_brdel) === TRUE) {
		echo "<div class=\"alert alert-success\">Branch ID : ".$_GET["id"]."<br />Location : ".$_GET["loc"]."<br />IFSC : ".$_GET["ifsc"]."<br /><br />All records of the above branch were deleted permanently.</div>";
		echo "<div class=\"alert alert-info\">Note down the above Branch ID, if you need to remove the records of associated employees and customers as well. Records of employees and customers of this branch were not deleted because they might be useful for the bank.<br /><br /><span style=\"font-weight:bold;\">If you are sure you want to permanently delete them anyway : <a href=\"admin-branch-clean.php?id=".$_GET["id"]."\" style=\"color:red; font-weight:bold;\">CLICK HERE AND PROCEED TO CLEAN IN THE NEXT PAGE</a></span></div>";
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_brdel . "<br />" . $conn->error . "</div>";
	}
}
else {
	header("Location: admin-dashboard.php");
}

?>

<a href="admin-branch-search.php"><button type="button" class="btn btn-warning btn-xs">SEARCH ANOTHER BRANCH</button></a>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>