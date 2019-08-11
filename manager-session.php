<?php
include_once "dbconfig.php";
session_start();

error_reporting(E_ALL & ~E_NOTICE);

$user_check = $_SESSION["login_geeta"];

$ses_sql = mysqli_query($conn,"SELECT employees.EmpID, employees.EmpName, employees.EmpLogin, employees.EmpRole, branches.BrID, branches.BrLoc FROM employees INNER JOIN branches ON employees.EmpBrID=branches.BrID WHERE EmpRole='Manager' AND EmpLogin='$user_check'");
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$ses_EmpID = $row["EmpID"];
$ses_EmpName = $row["EmpName"];
$ses_EmpLogin = $row["EmpLogin"];
$ses_EmpRole = $row["EmpRole"];
$ses_BrID = $row["BrID"];
$ses_BrLoc = $row["BrLoc"];

if (!isset($_SESSION["login_geeta"])) {
	header("Location: manager-login.php");
}
?>