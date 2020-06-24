<?php
// 送信データのチェック
// var_dump($_GET);
// exit();
session_start();

// 関数ファイルの読み込み
include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM ideasheet2 WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

</html>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>編集画面</title>
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

    <form class="form-horizontal" action="todo_update.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="user_name" class="col-sm-2 control-label">User_name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="user_name" placeholder="User_name" name="user_name" value="<?= $record["user_name"] ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="hobby" class="col-sm-2 control-label">Hobby</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="hobby" placeholder="Hobby" name="hobby" value="<?= $record["hobby"] ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="hobby_image" class="col-sm-2 control-label">Hobby_image</label>
        <input type="file" id="hobby_image" class="col-sm-2 control-label" name="hobby_image" accept="image/*" capture="camera" value="<?= $record["hobby_image"] ?>">
      </div>
      <div class="form-group">
        <label for="dream" class="col-sm-2 control-label">Dream</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="dream" placeholder="Dream" name="dream" value="<?= $record["dream"] ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="strong" class="col-sm-2 control-label">Strong</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="strong" placeholder="Strong" name="strong" value="<?= $record["strong"] ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="weak" class="col-sm-2 control-label">Weak</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="weak" placeholder="Weak" name="weak" value="<?= $record["weak"] ?>">
        </div>
      </div>
      <div class="form-group">
        <label for="favorite" class="col-sm-2 control-label">Favorite</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="favorite" placeholder="Favorite" name="favorite" value="<?= $record["favorite"] ?>">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <p><button type="submit" class="btn btn-black">POST</button></p>
        </div>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
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