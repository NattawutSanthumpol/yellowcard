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
if ($_SESSION['Status'] != 1) {
header("location:login.php");
exit();
}
*/ 
$strSQL   = "SELECT * FROM member LEFT JOIN level ON member.lvl_id = level.lvl_id ORDER BY mem_id asc";
$objQuery = mysqli_query($conn,$strSQL);

?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>รายชื่อครู</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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
					<li class="nav-item">
						<a class="nav-link" href="wrong.php">รายการความผิด</a>
					</li>
					<li class="nav-item active">
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
			<div class="col-auto">
				<form action="add_member.php" method="POST" enctype="multipart/form-data" name="form1">
					<button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
				</form>
				&nbsp;
				<table border="1" class="table table-hover table-responsive">
					<thead class="thead-dark">
						<tr align="center">
							<th scope="col">รหัสครู</th>
							<th scope="col">ชื่อ-นามสกุล</th>
							<th scope="col">Username</th>
							<!-- <th scope="col">Password</th> -->
							<th scope="col">ระดับสิทธิ์</th>
						
							<th scope="col">แก้ไข</th>
							
						</tr>
					</thead>
					<tbody>
						<?php while ($objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC)) { ?>
							<tr>
								<th scope="row" class="text-center"><?= $objResult["mem_id"] ?></th>
								<td><?= $objResult["mem_name"] ?></td>
								<td><?= $objResult["mem_user"] ?></td>
								<!-- <td><?php //echo base64_decode($objResult["mem_pass"]) ?></td> -->
								<td><?= $objResult["lvl_name"] ?></td>
							
								<td align="center">
									<a href="edit_member.php?id=<?= $objResult['mem_id'] ?>" class="btn btn-warning btn-sm click">แก้ไขข้อมูล</a>
								    <a href="del_member.php?id=<?= $objResult['mem_id'] ?>" class="btn btn-sm btn-danger click">ลบข้อมูล</a>
								</td>
								
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
		$(function chk() {
			//$("a").confirm({
			$(".click").confirm({
				//title: 'ยืนยันการแก้ไขข้อมูล!',
				title: false,
				content: 'คุณต้องการยืนยันแก้ไขข้อมูล ใช่ไหม?',
				theme: 'black',
				//animation: 'Rotate',
				button: {
					ตกลง: function() {
						$.alert('ทำรายการเรียบร้อย');
					},
					ยกเลิก: function() {
						//$.alert('Canceled!');
					}
				}
			});
		});
	</script>
</body>
</html>