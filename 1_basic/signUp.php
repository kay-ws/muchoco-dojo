<?php

function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

//id再割り当て
session_regenerate_id(true);

//ログイン済みの場合
if (isset($_SESSION['email'])) {
    echo 'ようこそ' . h($_SESSION['email']) . 'さん<br>';
    echo "<a href='/logout.php'>ログアウトはこちら。</a>";
    exit();
}

//emailは形式を確認して登録
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
//passwordはハッシュ変換してから登録
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//データベースへ接続
require_once 'config.php';
$pdo = new PDO(DSN, DB_USER, DB_PASS);

//登録処理
try {
    $stmt = $pdo->prepare("insert into users(email, password) value(?, ?)");
    $stmt->execute([$email, $password]);
    $info = '登録完了';
} catch (\Exception $e) {
    $info = '登録済みのメールアドレスです。';
}

require_once 'index_template.php';
