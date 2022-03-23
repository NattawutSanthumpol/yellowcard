<?php
include_once("connect/connect.php");
echo "<meta charset='utf-8' />";
$value = $_POST['value'];
if (is_numeric($value)) {
	$query = mysqli_query($conn, "select * from student where std_id LIKE '" . $value . "%'") or die(mysqli_connect_error($conn));
} else {
	$query = mysqli_query($conn, "select * from student where std_fname LIKE '%" . $value . "%'") or die(mysqli_connect_error($conn));
}

while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	echo "<tr>";
	echo "<td align='center'>" . $result["std_id"] . "</td>";
	echo "<td>" . $result["std_tname"] . " " . $result["std_fname"] . " " . $result["std_lname"] . "</td>";
	echo "<td align='center'>" . $result["std_class"] . "</td>";
	echo "<td align='center'>" . $result["std_depart"] . "</td>";
	echo "<td align='center'><a href='add_std_off.php?id=" . $result["std_id"] . "'><button type='button' class='btn btn-warning btn-sm'>เลือก</button></a></td>";
	echo "</tr>";
}
