<?php
session_start();
include("functions.php");
check_session_id();

if (
  !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
  !isset($_POST['hobby']) || $_POST['hobby'] == '' ||
  !isset($_POST['dream']) || $_POST['dream'] == '' ||
  !isset($_POST['strong']) || $_POST['strong'] == '' ||
  !isset($_POST['weak']) || $_POST['weak'] == '' ||
  !isset($_POST['favorite']) || $_POST['favorite'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる
$user_name = $_POST['user_name'];
$hobby = $_POST['hobby'];
$dream = $_POST['dream'];
$strong = $_POST['strong'];
$weak = $_POST['weak'];
$favorite = $_POST['favorite'];

if (isset($_FILES['hobby_image']) && $_FILES['hobby_image']['error'] == 0) {
  // 送信が正常に行われたときの処理 ...
  $uploadedFileName = $_FILES['hobby_image']['name']; //ファイル名の取得
  $tempPathName = $_FILES['hobby_image']['tmp_name']; //tmpフォルダの場所
  $fileDirectoryPath = 'upload/'; //アップロード先フォルダ(↑自分で決める)
  // ファイルの拡張子の種類を取得.
  // ファイルごとにユニークな名前を作成.(最後に拡張子を追加) // ファイルの保存場所をファイル名に追加.
  $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
  $uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;
  $fileNameToSave = $fileDirectoryPath . $uniqueName;
  // 最終的に「upload/hogehoge.png」のような形になる
  // var_dump($_fileNameToSave);
  // exit();
  $img = '';
  if (is_uploaded_file($tempPathName)) {
    if (move_uploaded_file($tempPathName, $fileNameToSave)) {
      chmod($fileNameToSave, 0644);
      $img = '<img src="' . $fileNameToSave . '" >';
    } else {
      exit('Error:アップロードできませんでした');
      // 権限の変更 // imgタグを設定
      // 画像の保存に失敗
      exit('Error:画像がありません'); // tmpフォルダにデータがない
    }
  } else {
  }
} else {
  // 送られていない，エラーが発生，などの場合
  exit('Error:画像が送信されていません');
}


$pdo = connect_to_db();

$sql = 'INSERT INTO ideasheet2(id, user_name, hobby, hobby_image, dream, strong, weak, favorite, created_at, updated_at) VALUES(NULL, :user_name, :hobby, :hobby_image, :dream, :strong, :weak, :favorite, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':hobby', $hobby, PDO::PARAM_STR);
$stmt->bindValue(':hobby_image', $fileNameToSave, PDO::PARAM_STR);
$stmt->bindValue(':dream', $dream, PDO::PARAM_STR);
$stmt->bindValue(':strong', $strong, PDO::PARAM_STR);
$stmt->bindValue(':weak', $weak, PDO::PARAM_STR);
$stmt->bindValue(':favorite', $favorite, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:todo_input.php");
  exit();
}


// ここからファイルアップロード&DB登録の処理を追加しよう！！！
