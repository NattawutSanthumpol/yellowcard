<!DOCTYPE html>
<?php date_default_timezone_set('Asia/Bangkok');
include_once("connect/connect.php");
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

</head>
<?php
isset($_GET['a']) ? $alert = $_GET['a'] : $alert = "";

if ($alert != "") {
    echo "<div class='alert alert-warning alert-dismissible fade show text-center' role='alert'><strong>Warning!</strong> Username or Password ของคุณ ไม่ถูกต้อง!!!!!!
  </div>";
}
?>

<body style="background-color: #D3D3D3;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-5 col-lg-4 xs-auto">
                <!--col-sm-7 col-md-6 col-lg-5-->
                <div class="card card-signin my-3">
                    <div class="card-header text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form class="form-signin" action="check_login.php" method="post" enctype="multipart/form-data">
                            <div class="form-label-group my-4">
                                <input type="text" name="inputUser" class="form-control" placeholder="Username" required autofocus="">
                            </div>
                            <div class="form-label-group">
                                <input type="password" name="inputPassword" class="form-control" placeholder="Password" required>
                            </div>
                            <hr class="my-4">
                            <button class="btn btn-lg btn-block text-uppercase btn-primary" type="submit">Sign in</button>
                            <!-- <a href="std_view.php" class="btn btn-block">สำหรับนักศึกษา</a> -->
                        </form>
                    </div>
                </div>
                <div class="col">
                    <h4 class="text-center">Demo</h4>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Pass</th>
                          <th>Role</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>admin</td>
                          <td>admin</td>
                          <td>Administrator</td>
                        </tr>
                        <tr>
                            <td>test1</td>
                            <td>test1</td>
                            <td>Manager</td>
                        </tr>
                        <tr>
                            <td>test2</td>
                            <td>test2</td>
                            <td>Teacher</td>
                        </tr>
                        <tr>
                            <td>test3</td>
                            <td>test3</td>
                            <td>Guest</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>