<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>カレンダー</title>
    <?php
function get_param() {
  $y = 0;
  $m = 0;
  if (isset($_GET['y'], $_GET['m'])) {
    $y = intval($_GET['y']);
    $m = intval($_GET['m']);
  }
  return [$y, $m];
}
function check_valid_param($y, $m) {
  if ($y == 0) return false;
  if ($m == 0) return false;
  if (!checkdate($m, 1, $y)) { //$y年$m月1日が有効な日付かチェック
    return false;
  }
  return true;
}
      $year = 0;
      $month = 0;
      $datetime= 0;

      try {      
      
        list($year, $month) = get_param();
        
        if (!check_valid_param($year, $month)) {
          //無効：現在の年月に更新する
          $now = new DateTime();
        
          $year = intval($now->format('Y'));
          $month = intval($now->format('n'));
        }

        $datetime = new DateTime("{$year}-{$month}-1");
      } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
      }
    ?>
  </head>
  <body>
    <h2><?= $datetime->format('Y年m月') ?></h2>
    <a href="./calender.php">今月へ</a>
    <?php
      $datetime->modify('-1 month');
    ?>
    <a href="./calender.php?y=<?= $datetime->format('Y') ?>&m=<?= $datetime->format('n') ?>">前月へ</a>
    <?php
      $datetime->modify('+2 months');
    ?>
    <a href="./calender.php?y=<?= $datetime->format('Y') ?>&m=<?= $datetime->format('n') ?>">来月へ</a>
    
  </body>
</html>