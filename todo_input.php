<?php
session_start();
include("functions.php");
check_session_id();
?>

</html>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>投稿画面</title>
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
  <!-- BootstrapのCSS読み込み -->
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap-4.5.0-dist/css/style2.css" rel="stylesheet">
  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/67ae73f65d.js" crossorigin="anonymous"></script>
</head>

<body>

  <header>
    <div class="container">

      <div class="container-small">

        <div class="headA">self-introduction</div>

        <button type="button" class="headC"><span class="fa fa-bars" title="MENU"></span></button>

      </div>

      <nav class="headB">
        <ul>
          <li><a href="todo_read.php">Timeline</a></li>
          <li><a href="todo_logout.php">Logout</a></li>
        </ul>
      </nav>

    </div>

  </header>

  <div class="jumbotron jumbotron-extend">

    <form class="form-horizontal" action="create_file.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="user_name" class="col-sm-2 control-label">User_name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="user_name" placeholder="User_name" name="user_name">
        </div>
      </div>
      <div class="form-group">
        <label for="hobby" class="col-sm-2 control-label">Hobby</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="hobby" placeholder="Hobby" name="hobby">
        </div>
      </div>
      <div class="form-group">
        <label for="hobby_image" class="col-sm-2 control-label">Hobby_image</label>
        <input type="file" id="hobby_image" class="col-sm-2 control-label" name="hobby_image" accept="image/*" capture="camera">
      </div>
      <div class="form-group">
        <label for="dream" class="col-sm-2 control-label">Dream</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="dream" placeholder="Dream" name="dream">
        </div>
      </div>
      <div class="form-group">
        <label for="strong" class="col-sm-2 control-label">Strong</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="strong" placeholder="Strong" name="strong">
        </div>
      </div>
      <div class="form-group">
        <label for="weak" class="col-sm-2 control-label">Weak</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="weak" placeholder="Weak" name="weak">
        </div>
      </div>
      <div class="form-group">
        <label for="favorite" class="col-sm-2 control-label">Favorite</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="favorite" placeholder="Favorite" name="favorite">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <p><button type="submit" class="btn btn-black">POST</button></p>
        </div>
      </div>
    </form>

  </div>

  <script>
    $(function() {
      $('.headC').click(function() {
        $('.headB').slideToggle();
      })
    })
  </script>

</body>

</html>