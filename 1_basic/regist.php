<?php
//HTMLのエスケープ
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

require_once('config.php');


//セッションIDの更新
session_start();
session_regenerate_id(true);

if(mb_strlen($_POST['message']) > 140) {
  $message = mb_substr($_POST['message'], 0, 140);
} else {
  $message = $_POST['message'];
}

$info = '';

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('insert into board.posts (parentId, email, imagePath, message) values(?, ?, ?, ?)');
  $stmt->execute([$_POST['parentId'], $_POST['email'], NULL, $message]);
  $info = '投稿されました。';
} catch (\Exception $e) {
  $info = '投稿が失敗しました。';
}

require_once('board_template.php');  
?>
