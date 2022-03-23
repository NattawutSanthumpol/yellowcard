<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include_once("connect/connect.php");

if ($_SESSION['User'] == "") {
	header("location:login.php");
	exit();
}

// isset($_GET["id"]) ? $id = "" : $id = $_GET['id'];
// isset($_POST["save"]) ? $btn = $_POST['save'] : $btn = "";
// isset($_POST["std_id"]) ? $std_id = $_POST["std_id"] : $std_id = "";
// isset($_POST["wrong"]) ? $wr_id = $_POST['wrong'] : $wr_id = "";
// isset($_POST["std_off_date"]) ? $std_off_date = $_POST["std_off_date"] : $std_off_date = "";
$id = $_GET['id'];
$btn = $_POST['save'];
$std_id = $_POST["std_id"];
$wr_id = $_POST['wrong'];
$std_off_date = $_POST["std_off_date"];
$mem_id       = $_SESSION["MEM_id"];
$t1 = "";
$t2 = "display: none;";
if (isset($id) && $btn != "save") {
	$t1     = "display: none;";
	$t2     = "";
	$sql1   = "SELECT * FROM student WHERE std_id = '$id'";
	$query1 = mysqli_query($conn, $sql1) or die("Query1 : " . mysqli_error($conn));
	$res    = mysqli_fetch_array($query1, MYSQLI_ASSOC);
}

if ($btn == "save") {
	//echo $_POST['std_id']." ".$_POST['std_fullname']." ".$_POST['wrong']." ".$_POST['std_off_date'];
	$sqlInsert = "INSERT INTO std_offense (`std_id`, `wr_id`, `mem_id`, `std_off_date`, `std_off_status`) VALUES('$std_id','$wr_id','$mem_id','$std_off_date','ติดกิจการ'" . ")";
	mysqli_query($conn, $sqlInsert) or die("Query Inset Error : " . mysqli_error($conn));
}
?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ออกรายการความผิดนักศึกษา</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="JS/jquery-1.11.3.min.js"></script>
	<script>
		function show(value) {

			$.ajax({
				type: "POST",
				url: "dataStu.php",
				data: {
					value: value
				},
				success: function(data) {
					$(".myBody").html(data);
				}
			});

			return false;
		}
	</script>
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
					<li class="nav-item">
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
	<div class="container">
		<div class="row col-xl-10">
			<table class="table">
				<tr>
					<td>ค้นหานักศึกษา &nbsp;
						&nbsp;
					</td>
					<td width="80%">
						<input type="text" class="form-control" name="search" id="search" onkeyup="return show(this.value);" />
					</td>
				</tr>
			</table>
			<table class="table table-hover" style="<?= $t1 ?>">
				<thead class="thead-dark">
					<tr>
						<th>รหัสนักศึกษา</th>
						<th>ชื่อ - นามสกุล</th>
						<th>ห้อง</th>
						<th>แผนก</th>
						<th>เลือก</th>
					</tr>
				</thead>
				<tbody class="myBody">

				</tbody>
			</table>
		</div>
		<div class="row justify-content-center">
			<div class="col-xl-auto align-self-center">
				<form action="add_std_off.php" method="POST" enctype="multipart/form-data">
					<table class="table table-borderless table-responsive" style="<?= $t2 ?>">
						<thead class="thead-dark">
							<tr>
								<th scope="col" colspan="2">เพิ่มรายการความผิดของนักศึกษา </th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="right">รหัสนักศึกษา : </td>
								<td><input type="text" name="std_id" class="form-control" value="<?= $res['std_id'] ?>"></td>
							</tr>
							<tr>
								<td align="right">ชื่อ - นามสกุล : </td>
								<td><input type="text" name="std_fullname" class="form-control" value="<?= $res['std_tname'] . ' ' . $res['std_fname'] . ' ' . $res['std_lname'] ?>"></td>
							</tr>
							<tr>
								<td align="right">ความผิด : </td>
								<td>
									<select name="wrong" class="form-control">
										<?php
										$showSQL  = "SELECT * FROM wrong";
										$querySQL = mysqli_query($conn, $showSQL) or die("Query level Error : " . mysqli_error($conn));
										while ($showWrong = mysqli_fetch_array($querySQL, MYSQLI_ASSOC)) {
										?>
											<option value="<?= $showWrong['wr_id'] ?>"><?= $showWrong['wr_name'] ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td align="right">วันที่ลงบันทึก : </td>
								<td><input type="text" name="std_off_date" class="form-control" id="example-date-input" value="<?= date('Y-m-d H:i:s') ?>"></td>
							</tr>
							<tr class="text-center">
								<td colspan="2">
									<button type="submit" name="save" value="save" class="btn btn-block btn-success">บันทึกข้อมูล</button>
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