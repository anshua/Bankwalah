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

<h2>Clean Branch <span style="color:red;">(Mass Removal Warning)</span></h2>

<div class="alert alert-warning">This page is intended for mass removal. Be sure of what you are doing!</div>

<div class="alert alert-danger">If you have deleted a branch, put that Branch ID below to permanently remove the associated employees and customers. This process also deletes photos and signatures of the associated employees and customers. Remember, if you put wrong Branch ID here, then all employees and customers data of that branch will be lost.</div>

<form action="admin-branch-cleaned.php" method="post">
<div class="table-responsive">
<table class="table">
	<tr>
		<td style="width:30%;">Branch ID</td>
		<?php
			if (isset($_GET["id"])) { echo "<td style=\"width:70%;\"><input type=\"text\" name=\"BrID\" value=\"".$_GET["id"]."\" style=\"width:50%;\"></td>"; }
			else { echo "<td style=\"width:70%;\"><input type=\"text\" name=\"BrID\" style=\"width:50%;\"></td>"; }
		?>
	</tr>
</table>
</div>
<input type="submit" name="submit" value="CLEAN"><input type="reset" name="reset" value="RESET" style="margin-left:20px;">
</form>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>