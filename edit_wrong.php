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
$up       = $_POST["UpDateData"];
$wr_name  = $_POST["wr_name"];
$wr_score = $_POST["wr_score"];
$id       = $_GET['id'];
$wr_id    = $_POST['wr_id'];

$sql   = "SELECT * FROM wrong WHERE wr_id = '$id' ";
$query = mysqli_query($conn,$sql) or die("Query Error = " . mysqli_error($conn));
$res   = mysqli_fetch_array($query,MYSQLI_ASSOC);

//echo "name ".$wr_name." คะแนน ".$wr_score." id ".$wr_id;

if ($up == "update") {
	if ($_POST["wr_name"] != "" and $_POST["wr_score"] != "") {
		$strSQL   = "UPDATE wrong set wr_name = '$wr_name', wr_score = '$wr_score' WHERE wr_id = '$wr_id'";
		$objQuery = mysqli_query($conn,$strSQL) or die("Query Error : " . mysql_error($conn));
		header("location:wrong.php");
	} else {
		echo "<div class='alert alert-warning alert-dismissible fade show text-center' role='alert'><strong>Warning!</strong> คุณกรอกข้อมูลไม่ครบ!!!!!!
</div>";
	}
}
?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>แก้ไขรายการความผิด</title>
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
					<li class="nav-item">
						<a class="nav-link" href="chkview.php">ตรวจสอบรายชื่อนักศึกษา</a>
					</li>
					<li class="nav-item active">
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
					<li class="nav-item">
						<a class="nav-link" href="chkview.php">ตรวจสอบรายชื่อนักศึกษา</a>
					</li>
					<li class="nav-item  active">
						<a class="nav-link" href="wrong.php">รายการความผิด</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link " href="report.php">รายงาน</a>
					</li>
				</ul>
			<?php } else { ?><ul class="navbar-nav mr-auto">
					<li class="nav-item">
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
				<form action="edit_wrong.php" method="POST" enctype="multipart/form-data" name="form1">
					<table border="1" class="table table-hover table-responsive">
						<thead class="thead-dark">
							<tr align="center">
								<th scope="col" colspan="2">จัดการข้อมูลความผิด</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="right">ชื่อความผิด : </td>
								<td><input type="text" class="form-control" name="wr_name" value="<?= $res['wr_name'] ?>"></td>
							</tr>
							<tr>
								<td align="right">คะแนนความผิด : </td>
								<td><input type="text" class="form-control" name="wr_score" value="<?= $res['wr_score'] ?>"></td>
							</tr>
							<tr>
								<td align="center" colspan="2"><button type="submit" class="btn btn-success" name="UpDateData" value="update">แก้ไขข้อมูล</button>
									<input type="hidden" name="wr_id" value="<?= $res['wr_id'] ?>">
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>