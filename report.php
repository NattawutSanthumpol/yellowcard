<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
include_once("connect/connect.php");

if ($_SESSION['User'] == "") {
	header("location:login.php");
	exit();
}



	if (isset($_POST['search'])) {
		$strSQL   = "SELECT * FROM std_offense LEFT JOIN student ON std_offense.std_id = student.std_id LEFT JOIN wrong ON std_offense.wr_id = wrong.wr_id LEFT JOIN member ON std_offense.mem_id = member.mem_id ";
		$strSQL .= "WHERE std_offense.std_off_date LIKE '" . $_POST["search"] . "%' AND std_offense.std_off_status = 'ติดกิจการ' ";
		$strSQL .= "order by student.std_class ASC";
		$objQuery = mysqli_query($conn, $strSQL);
	}
else {

	$strSQL   = "SELECT * FROM std_offense LEFT JOIN student ON std_offense.std_id = student.std_id LEFT JOIN wrong ON std_offense.wr_id = wrong.wr_id LEFT JOIN member ON std_offense.mem_id = member.mem_id ";
	$strSQL .= "WHERE std_offense.std_off_status = 'ติดกิจการ' ";
	$strSQL .= "order by student.std_class ASC";
	$objQuery = mysqli_query($conn, $strSQL);
}

?>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>รายงาน</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<script type="text/javascript" src="JS/printPreview.js"></script>
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
					<li class="nav-item active">
						<a class="nav-link " href="report.php">รายงาน</a>
					</li>
					<!--<li class="nav-item">																								      </li>-->
				</ul>
			<?php } elseif ($_SESSION['Status'] == 2) { ?>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="chkview.php">ตรวจสอบรายชื่อนักศึกษา</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="wrong.php">รายการความผิด</a>
					</li>
					<li class="nav-item active">
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
		<div class="row justify-content-xl-center">
			<div class="col-xl-auto">
				<p>
					<!-- ค้นหาข้อมูล -->
				<form action="report.php" method="POST" enctype="multipart/form-data" name="form2">
					<table class="table table-borderless table-responsive">
						<tr>
							<td align="right" valign="bottom">ค้นหาวันที่ : </td>
							<td width="80%"><input class="form-control" type="date" id="example-date-input" name="search" value="<?= date("Y-m-d") ?>"></td>
							<td align="left">
								<button type="submit" class="btn btn-success" name="se" value="search">ค้นหา</button>

							</td>
						</tr>
						<!-- แสดงผล -->
					</table>
				</form>
				<!-- <div class="row d-flex flex-row-reverse">
				<button id="btnPrint" class="btn btn-info">Print</button>
			</div> -->
				<table border="1" class="table table-hover table-responsive" id="masterContent">
					<thead class="thead-dark">
						<tr align="center">
							<th scope="col">รหัสนักศึกษา</th>
							<th scope="col">ชื่อ-นามสกุล</th>
							<th scope="col">ห้อง</th>
							<th scope="col">แผนก</th>
							<th scope="col">ความผิด</th>
							<th scope="col">คะแนน</th>
							<th scope="col">วันที่</th>
							<th scope="col">สถานะ</th>
							<th scope="col">ผู้ออกใบเตือน</th>
						</tr>
					</thead>
					<tbody>
						<?php //if (isset($_POST['search'])) {
						while ($res = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) { ?>
							<tr>
								<td align="center"><?= $res["std_id"] ?></td>
								<td><?= $res["std_tname"] ?> <?= $res["std_fname"] ?> <?= $res["std_lname"] ?></td>
								<td align="center"><?= $res["std_class"] ?></td>
								<td align="center"><?= $res["std_depart"] ?></td>
								<td align="center"><?= $res["wr_name"] ?></td>
								<td align="center"><?= $res["wr_score"] ?></td>
								<td align="center"><?= date("d/m/Y", strtotime($res["std_off_date"])) ?></td>
								<td align="center"><?= $res["std_off_status"] ?></td>
								<td align="center"><?php echo $res["mem_name"] ?></td>
							</tr>
						<?php }
						//} 
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function() {
			$("#btnPrint").printPreview({
				obj2print: '#masterContent',
				width: '810',
				title: 'รายงานความผิด'
				/*optional properties with default values*/
				// obj2print:'body',     /*if not provided full page will be printed*/
				// style:'',             /*if you want to override or add more css assign here e.g: "<style>#masterContent:background:red;</style>"*/
				// width: '670',         /*if width is not provided it will be 670 (default print paper width)*/
				// height:screen.height, /*if not provided its height will be equal to screen height*/
				// top:0,                /*if not provided its top position will be zero*/
				// left:'center',        /*if not provided it will be at center, you can provide any number e.g. 300,120,200*/
				// resizable : 'yes',    /*yes or no default is yes, * do not work in some browsers*/
				// scrollbars:'yes',     /*yes or no default is yes, * do not work in some browsers*/
				// status:'no',          /*yes or no default is yes, * do not work in some browsers*/
				// title:'Print Preview' /*title of print preview popup window*/
			});
		});
	</script>
</body>

</html>