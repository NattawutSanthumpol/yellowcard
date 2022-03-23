<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include_once("connect/connect.php");

if ($_SESSION['User'] == "") {
	header("location:login.php");
	exit();
}
/*
if ($_SESSION['Status'] != 1 or $_SESSION['Status'] != 2) {
header("location:login.php");
exit();
}
 */

//echo "name ".$mem_name." คะแนน ".$mem_username." ปุ่ม ".$add." id ".$edit;
require_once 'PHPExcel/Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include 'PHPExcel/Classes/PHPExcel/IOFactory.php';

if ($_POST["submit"] == "OK") {
	copy($_FILES["excelfile"]["tmp_name"], "data/" . date("Y-m-d ") . $_FILES["excelfile"]["name"]);
	$inputFileName = "data/" . date("Y-m-d ") . $_FILES["excelfile"]["name"];
	//$inputFileName = "data.xlsx";
	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	$objReader     = PHPExcel_IOFactory::createReader($inputFileType);
	$objReader->setReadDataOnly(true);
	$objPHPExcel = $objReader->load($inputFileName);

	$objWorksheet  = $objPHPExcel->setActiveSheetIndex(0);
	$highestRow    = $objWorksheet->getHighestRow();
	$highestColumn = $objWorksheet->getHighestColumn();

	$headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
	$headingsArray = $headingsArray[1];

	$r              = -1;
	$namedDataArray = array();
	for ($row = 2; $row <= $highestRow; ++$row) {
		$dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
		if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
			++$r;
			foreach ($headingsArray as $columnKey => $columnHeading) {
				$namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
			}
		}
	}
	//echo '<pre>';
	//var_dump($namedDataArray);
	//echo '</pre><hr />';

	/* Connect to MySQL Database */

	$i = 0;
	foreach ($namedDataArray as $result) {
		$i++;
		$strSQL = "";
		$strSQL .= "INSERT INTO student ";
		$strSQL .= "VALUES ";
		$strSQL .= "('" . $result["std_id"] . "','" . $result["std_tname"] . "' ";
		$strSQL .= ",'" . $result["std_fname"] . "','" . $result["std_lname"] . "' ";
		$strSQL .= ",'" . $result["std_class"] . "','" . $result["std_depart"] . "') ";
		mysqli_query($conn,$strSQL) or die(mysqli_error($conn));
		//echo "Row $i Inserted...<br>";
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>เพิ่มรายชื่อนักศึกษา</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php if ($_SESSION['Status'] == 1) { ?>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="chkview.php">ตรวจสอบรายชื่อนักศึกษา</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="wrong.php">รายการความผิด</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="member.php">รายชื่อครู</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="student.php">รายชื่อนักศึกษา</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link " href="report.php">รายงาน</a>
					</li>
					<!--<li class="nav-item">
				          <a class="nav-link " href="level.php">จัดการสิทธิ์</a>
				        </li>-->
				</ul>
			<?php } elseif ($_SESSION['Status'] == 2) { ?>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="chkview.php">ตรวจสอบรายชื่อนักศึกษา</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="wrong.php">รายการความผิด</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link " href="report.php">รายงาน</a>
					</li>
				</ul>
			<?php } else { ?><ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="chkview.php">ตรวจสอบรายชื่อนักศึกษา</a>
					</li>
				</ul>
			<?php } ?>
			<form class="form-inline my-2 my-lg-0">
				<div class="text-light"><?= $_SESSION["Name"] ?>&nbsp;
					&nbsp;
					&nbsp;
				</div>
				<button class="btn btn-outline-warning my-2 my-sm-0" type="button" onclick="window.location.href='logout.php'">Logout</button>
			</form>
		</div>
	</nav>
	<div class="container"><br>

		<div class="row justify-content-md-center">
			<div class="col-auto form-group">
				<form action="add_student.php" method="POST" enctype="multipart/form-data" name="form1">
					<input type="file" name="excelfile" id="excelfile" class="form-control-file">
					<button type="submit" name="submit" value="OK" class="btn btn-outline-success btn-block">OK</button>
				</form>
			</div>
			<?php
			if ($_POST["submit"] == "OK") {
				echo "<br><br><br><center>Row is $i <br>Insert Data Complete ";
				mysqli_close($objConnect);
			}

			?>
		</div>
	</div>
</body>

</html>