<?php
session_start();
include("functions.php");
check_session_id();

// ユーザ名取得
$mail = $_SESSION['id'];

// DB接続
$pdo = connect_to_db();

// いいね数カウント


// データ取得SQL作成
$sql = "SELECT * FROM ideasheet2 LEFT OUTER JOIN ideasheet ON ideasheet2.id = ideasheet.id";
// "SELECT * FROM tablea LEFT OUTER JOIN tableb ON tablea.id = tableb.id";
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<div>{$record["user_name"]}</div>";
    $output .= "<div>{$record["created_at"]} <a href='todo_edit.php?id={$record["id"]}'>edit</a> <a href='todo_delete.php?id={$record["id"]}'>delete</a></div>";
    $output .= "<div><img src='{$record["hobby_image"]}' width=100%></div>";
    $output .= "<div>#hobby: {$record["hobby"]}</div>";
    $output .= "<div>#dream: {$record["dream"]}</div>";
    $output .= "<div>#strong: {$record["strong"]}</div>";
    $output .= "<div>#weak: {$record["weak"]}</div>";
    $output .= "<div>#favorite: {$record["favorite"]}</div>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
?>

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
  <link href="bootstrap-4.5.0-dist/css/style3.css" rel="stylesheet">
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
          <li><a href="todo_input.php">Post</a></li>
          <li><a href="todo_logout.php">Logout</a></li>
        </ul>
      </nav>

    </div>

  </header>

  <div class="jumbotron jumbotron-extend">
    
    <?= $output ?>

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