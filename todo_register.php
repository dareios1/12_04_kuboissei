<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ユーザ登録画面</title>
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
  <!-- BootstrapのCSS読み込み -->
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap-4.5.0-dist/css/style.css" rel="stylesheet">
  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="jumbotron jumbotron-extend">

    <div class="container-fluid jumbotron-container">
      <h1 class="site-name">idea sheet for children</h1>
    </div>

    <form class="form-horizontal" action="todo_register_act.php" method="POST">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Mail</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail3" placeholder="Mail" name="mail">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox"> Remember me
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <p><button type="submit" class="btn btn-black">Register</button></p>
        </div>
      </div>
      <div class="login">
        <a href="todo_login.php">or Login</a>
      </div>
    </form>

  </div>

</body>