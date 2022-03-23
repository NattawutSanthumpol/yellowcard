<?php
include_once("connect/connect.php");
echo "<meta charset='utf-8' />";
$value = $_GET['id'];
$query = mysqli_query($conn,"UPDATE std_offense SET std_off_status = 'แก้ไขแล้ว' WHERE std_off_id = '".$value."'") or die(mysql_error($conn));
header("location:chkview.php");
?>