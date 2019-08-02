<!-- https://qiita.com/mpyw/items/2c54d0ea95423bd88f60 -->
<?php

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

session_start();

$name = (string)filter_input(INPUT_POST, 'name'); // $_POST['name']
$text = (string)filter_input(INPUT_POST, 'text'); // $_POST['text']
$token = (string)filter_input(INPUT_POST, 'token');

//Execute only POST method
$fp = fopen('data.json', 'c+b');
$rows = (array)json_decode(stream_get_contents($fp), true);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && sha1(session_id()) === $token) {
  flock($fp, LOCK_EX);
  $rows[] = ['name' => $name, 'text' => $text];
  rewind($fp);
  fwrite($fp, json_Encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  ftruncate($fp, ftell($fp));
}
flock($fp, LOCK_SH);
fclose($fp);

session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>掲示板</title>
</head>
<body>
  <h1>掲示板</h1>
  <section>
    <h2>新規投稿</h2>
    <form action="" method="post">
      名前：<input type="text" name="name"><br>
      本文：<input type="text" name="text"><br>
      <button type="submit">投稿</button>
      <input type="hidden" name="token" value="<?= h(sha1(session_Id())) ?>">
    </form>
  </section>
  <section>
    <h2>投稿一覧</h2>
    <?php if(!empty($rows)): ?>
      <ul>
      <?php foreach($rows as $row): ?>
        <li><?= h($row['text']) ?> (<?= h($row['name']) ?>) </li>
      <?php endforeach; ?>
      </ul>  
    <?php else: ?>
      <p>投稿はまだありません</p>
    <?php endif; ?>
  </section>
</body>
</html>
