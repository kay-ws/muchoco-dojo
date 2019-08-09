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
      $stmt = $pdo->prepare('select * from posts where parentId = 0 order by id DESC Limit 10');
      $stmt->execute();
    }
    foreach ($stmt as $row) {
?>
      <div class="post">
        <h2>投稿：<?= row['email'] ?></h2>
        <img src="<?= row['imagePath'] ?>"
        <span>message:<? row['message'] ?></span>
        <hr>
      </div>
<?php
    }
?>    
 </body>
</html>
