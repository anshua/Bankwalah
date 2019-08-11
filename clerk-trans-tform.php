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

<h2>Transfer Money</h2>

<div class="alert alert-warning">The process uses javascript clock which interprets your system time. To avaoid uploading wrong time into database, keep your computer's time accurate.</div>

<?php echo "<div class=\"alert alert-danger\">Fields marked with * are mandatory. Only money transfers of customers of this Branch ".$ses_BrID." (".$ses_BrLoc.") will be furnished. Others will be discarded.</div>"; ?>

<form action="clerk-trans-tconfirm.php" method="post" name="FormClock">
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<td style="width:30%;">Transaction ID*</td>
		<td style="width:70%;"><input type="text" name="TrID" value="SET TO AUTO_INCREMENT" style="width:50%;" disabled></td>
	</tr>
	<tr>
		<td>Date-Time Stamp*</td>
		<td style="width:70%;"><input type="text" name="TrDateTime" style="width:50%; background-color:red;" readonly><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>YYYY-MM-DD HR:MI:SC</button></td>
	</tr>
	<tr>
		<td>Remarks</td>
		<td style="width:70%;"><input type="text" name="TrRemarks" style="width:50%;"></td>
	</tr>
	<?php
		if (isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["bal"])) {
			echo "<tr>
					<td style=\"width:30%;\">Customer ID*</td>
					<td style=\"width:70%;\"><input type=\"text\" name=\"TrCustID\" value=\"".$_GET["id"]."\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>".$_GET["name"].", Balance: &#8377; ".$_GET["bal"]."</button></td>
				</tr>";
			$transfer_max = " max=\"".$_GET["bal"]."\"";
		}
		else {
			echo "<tr>
					<td style=\"width:30%;\">Customer ID*</td>
					<td style=\"width:70%;\"><input type=\"text\" name=\"TrCustID\" style=\"width:50%;\" required></td>
				</tr>";
			$transfer_max = "";
		}
	?>
	<tr>
		<td style="width:30%;">Recipient ID*</td>
		<td style="width:70%;"><input type="text" name="TrRecID" style="width:50%;" required></td>
	</tr>
	<tr>
		<td style="width:30%;">Employee ID*</td>
		<td style="width:70%;"><input type="text" name="TrEmpID" value="<?php echo $ses_EmpID; ?>" style="width:50%; background-color:red;" readonly></td>
	</tr>
	<tr>
		<td>Transfer Amount*</td>
		<td style="width:70%;"><input type="number" min="0.01" step="0.01" name="TrAmount" style="width:50%;"<?php echo $transfer_max; ?> required><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>&#8377; Upto 2 Decimals</button></td>
	</tr>
</table>
</div>
<input type="submit" name="submit" value="NEXT"><input type="reset" name="reset" value="RESET" style="margin-left:20px;">
<?php if (isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["bal"])) { echo "<a href=\"clerk-trans-tform.php\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">START FRESH TRANSFER</button></a>"; } ?>
</form>


		</div>
		<div class="col-sm-4 mainside-clr"><?php include_once "clerk-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-clr"><?php include_once "clerk-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<script type="text/javascript" src="js/livedatetime.js"></script>
<?php $conn->close(); ?></body>
</html>