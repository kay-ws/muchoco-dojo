<?php
  require_once('config.php');
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>掲示板</title>
 </head>
 <body>
    <div class="infoMessage"><?= $info ?></div>

    <form action="post.php" method="post">
      <button type="submit" name="post">新規投稿</button>
    </form>
    <form action="logout.php" method="post">
      <button type="submit" name="logout">ログアウト</button>
    </form>
<?php
    try {
      $pdo = new PDO(DSN, DB_USER, DB_PASS);
      $stmt = $pdo->prepare('select * from posts where email = ?');
      $stmt->execute([$_POST['email']]);
      
      
    }
    
    <div class="post">
    <h2>投稿：<?= ?></h2>  
    </div>
    
    <h1>ログイン</h1>
    <form action="login.php" method="post">
      <label for="email">email</label>
      <input type="email" name="email">
      <label for="password">password</label>
      <input type="password" name="password">
      <button type="submit" name ="login">ログイン</button>
   </form>
   <h1>新規登録</h1>
   <form action="signUp.php" method="post">
     <label for="email">email</label>
     <input type="email" name="email">
     <label for="password">password</label>
     <input type="password" name="password">
     <button type="submit" name="signUp">新規登録</button>
   </form>
 </body>
</html>
