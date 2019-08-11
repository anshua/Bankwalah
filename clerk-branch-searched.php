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

<h2>Branches Search List</h2>


<?php
require_once "dbconfig.php";

$fields = array('BrLoc', 'BrIFSC', 'BrPhone', 'BrEmail', 'BrID');
$conditions = array();
// loop through the defined fields
foreach($fields as $field){
	// if the field is set and not empty
	if(isset($_POST[$field]) && $_POST[$field] != '') {
		// create a new condition while escaping the value inputed by the user (SQL Injection)
		$conditions[] = "`$field` LIKE '%" . mysqli_real_escape_string($conn,$_POST[$field]) . "%'";
	}
}
// builds the query
$query = "SELECT BrID, BrLoc, BrIFSC, BrPhone, BrEmail FROM branches";
// if there are conditions defined
if(count($conditions) > 0) {
// append the conditions
$query .= " WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
}
$query .= " ORDER BY BrID ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
	echo "<div class=\"table-responsive\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Location</th>
		<th>IFSC</th>
		<th>Phone</th>
		<th>Email</th>
	</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<tr>
		<td>".$row["BrID"]."</td>
		<td><a href=\"clerk-branch-view.php?id=".$row["BrID"]."\">".$row["BrLoc"]."</a></td>
		<td>".$row["BrIFSC"]."</td>
		<td>".$row["BrPhone"]."</td>
		<td>".$row["BrEmail"]."</td>
	</tr>";
    }
	echo "</table></div>";
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}




?>

		</div>
		<div class="col-sm-4 mainside-clr"><?php include_once "clerk-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-clr"><?php include_once "clerk-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>