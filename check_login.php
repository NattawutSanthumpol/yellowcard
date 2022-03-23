<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include_once("connect/connect.php");
$strSQL = "SELECT * FROM member WHERE mem_user = '" . mysqli_real_escape_string($conn,$_POST['inputUser'])."' AND mem_pass = '".mysqli_real_escape_string($conn,base64_encode($_POST['inputPassword']))."'";
$objQuery  = mysqli_query($conn,$strSQL) or die("Error Query");
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
if (!$objResult) {
	echo "Username and Password Incorrect!";
	//echo "<br />".mysqli_real_escape_string($conn,base64_encode($_POST['inputPassword']));
	header("location:login.php?a='w'");
} else {
	$_SESSION["User"]   = $objResult["mem_user"];
	$_SESSION["MEM_id"] = $objResult["mem_id"];
	$_SESSION["Status"] = $objResult["lvl_id"];
	$_SESSION["Name"]   = $objResult["mem_name"];

	session_write_close();

	if ($objResult["lvl_id"] == 1 or $objResult["lvl_id"] == 2) {
		header("location:chkview.php");
	} else {
		header("location:add_std_off.php");
	}
}
mysqli_close();

