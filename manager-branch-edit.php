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

<h2>Edit Branch Details</h2>

<?php
require_once "dbconfig.php";

/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT BrID FROM branches WHERE BrID=$ses_BrID");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["BrID"];
/* setting check parameters end */

if (!empty($_GET["id"]) && ($_GET["id"] == $my_ID)) {

$sql = "SELECT * FROM branches WHERE BrID=".$_GET["id"];

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<div class=\"alert alert-danger\">Fields marked with * are mandatory.</div>
<form action=\"manager-branch-view.php\" method=\"post\">
<div class=\"table-responsive\">
<table class=\"table table-striped\">
	<tr>
		<td style=\"width:30%;\">Branch ID*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"BrID\" style=\"width:50%; background-color:red;\" value=\"".$row["BrID"]."\" readonly></td>
	</tr>
	<tr>
		<td>Location*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"BrLoc\" style=\"width:90%;\" value=\"".$row["BrLoc"]."\"></td>
	</tr>
	<tr>
		<td>IFSC*</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"BrIFSC\" style=\"width:50%;\" value=\"".$row["BrIFSC"]."\"><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>Format : BKWL0666666</button></td>
	</tr>
	<tr>
		<td>Opening Date*</td>
		<td><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-right:20px;\" disabled>YYYY-MM-DD</button><input type=\"text\" name=\"BrOpenDate\" class=\"datepicker\" value=\"".$row["BrOpenDate"]."\"></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style=\"width:70%;\"><input type=\"text\" name=\"BrPhone\" style=\"width:50%;\" value=\"".$row["BrPhone"]."\"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style=\"width:70%;\"><input type=\"email\" name=\"BrEmail\" style=\"width:50%;\" value=\"".$row["BrEmail"]."\"></td>
	</tr>
</table>
</div>
<input type=\"submit\" name=\"submitedit\" value=\"UPDATE\"><a href=\"manager-branch-view.php?id=".$row["BrID"]."\"><button type=\"button\" class=\"btn btn-info btn-xs\" style=\"margin-left:20px;\">RETURN</button></a>
</form>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}

}
else {
	header("Location: manager-dashboard.php");
}
?>


		</div>
		<div class="col-sm-4 mainside-mgr"><?php include_once "manager-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-mgr"><?php include_once "manager-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>