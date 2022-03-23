<!DOCTYPE html>
<?php date_default_timezone_set('Asia/Bangkok');
include_once("connect/connect.php");
/*session_start();
if(isset($_SESSION["Status"])){
header("location:check_login.php");
}*/
?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <style>
    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    body {
      background-image: linear-gradient(rgb(51, 0, 84), rgb(255, 255, 255));
      background-position: center;
      background-repeat: no-repeat;
    }

    .card-signin {
      border: 0;
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
      background-image: url("image/login.png");
      background-position: center;
      background-size: 100% 100%;
    }

    .card-signin .card-title {
      margin-bottom: 2rem;
      font-weight: 300;
      font-size: 1.5rem;
    }

    .card-signin .card-body {
      padding: 2rem;
    }

    .form-signin {
      width: 100%;
    }

    .form-signin .btn {
      font-size: 80%;
      color: #ffffff;
      border-radius: 5rem;
      letter-spacing: .1rem;
      font-weight: bold;
      padding: 1rem;
      transition: all 0.2s;
      background-color: #993399;
    }

    .form-label-group {
      position: relative;
      margin-bottom: 1rem;
    }

    .form-label-group input {
      height: auto;
      border-radius: 2rem;
    }
  </style>


</head>
<?php
isset($_GET['a']) ? $alert = $_GET['a'] : $alert = "";

if ($alert != "") {
  echo "<div class='alert alert-warning alert-dismissible fade show text-center' role='alert'><strong>Warning!</strong> Username or Password ของคุณ ไม่ถูกต้อง!!!!!!
  </div>";
}
?>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 col-md-5 col-lg-4 xs-auto">
        <!--col-sm-7 col-md-6 col-lg-5-->
        <div class="card card-signin my-3">
          <img src="image/logo.png" class="card-img-top" style="width: 150px">
          <div class="card-body">
            <form class="form-signin" action="check_login.php" method="post" enctype="multipart/form-data">
              <div class="form-label-group">
                <input type="text" name="inputUser" class="form-control" placeholder="Username" required autofocus="">
              </div>

              <div class="form-label-group">
                <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
              </div>
              <hr class="my-4">
              <button class="btn btn-lg btn-block text-uppercase" type="submit">Sign in</button>
              <!-- <a href="std_view.php" class="btn btn-block">สำหรับนักศึกษา</a> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>