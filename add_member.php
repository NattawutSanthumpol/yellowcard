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
$add          = $_POST["addData"];
$mem_id       = $_POST['mem_id'];
$mem_name     = $_POST["mem_name"];
$mem_username = $_POST["mem_username"];
$mem_pass     = base64_encode($_POST['mem_pass']);
$mem_lvl      = $_POST['mem_lvl'];

//echo "name ".$mem_name." คะแนน ".$mem_username." ปุ่ม ".$add." id ".$edit;
if ($add == "addData") {
	if ($_POST["mem_name"] != "" and $_POST["mem_username"] != "") {

		$strSQL = "INSERT INTO member VALUES(" . "'$mem_id','$mem_name','$mem_username','$mem_pass','$mem_lvl'" . ")";
		echo $strSQL;
		$objQuery = mysqli_query($conn,$strSQL) or die("Query Error : " . mysqli_error($conn));
		header("location:member.php");
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
	<title>เพิ่มสมาชิก</title>
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
			<div class="col-xl-auto form-group">
				<form action="add_member.php" method="POST" enctype="multipart/form-data" name="form1">
					<table border="1" class="table table-hover table-responsive">
						<thead class="thead-dark">
							<tr align="center">
								<th scope="col" colspan="2">จัดการข้อมูลความผิด</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="right">รหัส : </td>
								<td><input type="text" class="form-control" name="mem_id" value=""></td>
							</tr>
							<tr>
								<td align="right">ชื่อ - นามสกุล : </td>
								<td><input type="text" class="form-control" name="mem_name" value="<?= $res['mem_name'] ?>"></td>
							</tr>
							<tr>
								<td align="right">Username : </td>
								<td><input type="text" class="form-control" name="mem_username" value="<?= $res['mem_username'] ?>"></td>
							</tr>
							<tr>
								<td align="right">Password : </td>
								<td><input type="text" class="form-control" name="mem_pass" value="<?= $res['mem_pass'] ?>"></td>
							</tr>
							<tr>
								<td align="right">ระดับสิทธิ์ : </td>
								<td>
									<select name="mem_lvl" class="form-control">
										<?php
										$showSQL  = "SELECT * FROM level";
										$querySQL = mysqli_query($conn,$showSQL) or die("Query level Error : " . mysqli_error($conn));
										while ($showlvl = mysqli_fetch_array($querySQL,MYSQLI_ASSOC)) {
										?>
											<option value="<?= $showlvl['lvl_id'] ?>"><?= $showlvl['lvl_name'] ?></option>
										<?php } ?>
									</select>

								</td>
							</tr>
							<tr>
								<td align="center" colspan="2"><button type="submit" class="btn btn-success" name="addData" value="addData">เพิ่มข้อมูล</button>
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