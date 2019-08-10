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
    <h1>最新の投稿10件とコメント最大10件を表示します。</h1>
<?php
    try {
      $pdo = new PDO(DSN, DB_USER, DB_PASS);
      $stmt = $pdo->prepare('select * from posts where parentId = 0 order by id DESC Limit 10');
      $stmt->execute();
    } catch (\Exception $e) {
      $info = '投稿がよみこめませんでした。';
    }
    foreach ($stmt as $row) {
?>
      <div class="post">
        <form action="comment.php">
          <h2>投稿：<?= $row['email'] ?></h2>
          <img src="<?= $row['imagePath'] ?>"
          <p>message:<?= $row['message'] ?></p>
          <button type="submit" name="commentPost" method="post">コメントする</button>
          <button type="submit" name="deletePost" method="post">削除</button>
        </form>
<?php
        try {
          $stmt2 = $pdo->prepare('select * from posts where parentId = ? order by id DESC');
          $stmt2->execute([ $row['id'] ]);
        } catch (\Exception $e) {
          $info = '投稿がよみこめませんでした。';
        }
        foreach ($stmt2 as $row2) {
?>
          <form action="comment.php">
            <h4>コメント：<?= $row['email'] ?></h4>
            <img src="<?= $row['imagePath'] ?>"
            <span>message:<?= $row['message'] ?></span>
            <button type="submit" name="commentPost" method="post">コメントする</button>
            <button type="submit" name="deletePost" method="post">削除</button>
          </form>
<?php
        }
?>        
        <hr>
      </div>
<?php
    }
?>    
</body>
</html>
