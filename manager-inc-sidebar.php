<div class="card" style="margin-top:20px; margin-bottom:20px;">
	<?php echo "<img src=\"img-employees/".$ses_EmpID."-photo.jpg\" alt=\"".$ses_EmpName."\" class=\"card-image\">"; ?>
	<h3><?php echo "<a href=\"manager-employee-view.php?id=".$ses_EmpID."\">".$ses_EmpName."</a>"; ?></h3>
	<p class="card-title"><?php echo $ses_EmpRole; ?></p>
	<p style="font-size:10px;"><?php echo "<a href=\"manager-branch-view.php?id=".$ses_BrID."\">Branch ".$ses_BrID." (".$ses_BrLoc.")</a>"; ?></p>
</div>

<?php
/*-----------------------------list of transactions of this employee starts-------------------------*/
echo "<h4 style=\"text-align:center;\">Latest Five Transactions by Me</h4>";

$sql_transemp = "SELECT TrID, TrDateTime, TrCustID, TrAmount FROM transactions WHERE TrEmpID=".$ses_EmpID." ORDER BY TrID DESC LIMIT 5";

$result_transemp = $conn->query($sql_transemp);
if ($result_transemp->num_rows > 0) {
	echo "<div class=\"table-responsive\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Date-Time Stamp<br /><span style=\"font-size:10px;\">(YYYY-MM-DD HR:MI:SC)</span></th>
		<th>Customer ID</th>
		<th>Transaction Amount<br /><span style=\"font-size:10px;\">(&#8377;)</span></th>
	</tr>";
	// output data of each row
	while($row = $result_transemp->fetch_assoc()) {
		echo "<tr>
				<td><a href=\"manager-trans-view.php?id=".$row["TrID"]."\">".$row["TrID"]."</a></td>
				<td>".$row["TrDateTime"]."</td>
				<td><a href=\"manager-customer-view.php?id=".$row["TrCustID"]."\">".$row["TrCustID"]."</a></td>
				<td>".$row["TrAmount"]."</td>
			</tr>";
    }
	echo "</table></div>";
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}
/*-----------------------------list of transactions of this employee ends-------------------------*/
?>