<?php

require_once('config.php');


//セッションIDの更新
session_start();
session_regenerate_id(true);

$info = '';
$go_board = false;

//無限ループではない。必ず１回目でbreak
while(true) {
  //emailのvalidate
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $info = '入力された値が不正です。';
    break;
  }
  
  //DB内でPOSTされたメールアドレスを検索
  try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    $stmt = $pdo->prepare('select * from board.users where email = ?');
    $stmt->execute([$_POST['email']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }
  //emailがDB内に存在しているか確認
  if (!isset($row['email'])) {
    $info = 'メールアドレス又はパスワードが間違っています。';
    break;
  }
  
  //パスワード確認後sessionにメールアドレスを渡す
  if (password_verify($_POST['password'], $row['password'])) {
    $_SESSION['EMAIL'] = $row['email'];
    $info = 'ログインしました';
    $go_board = true;
    break;
  } else {
    $info = 'メールアドレス又はパスワードが間違っています。';
    break;
  }
}

if (!$go_board) {
  require_once('template.php');
} else {
  require_once('board_template.php');  
}

?>
