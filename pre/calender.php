<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>カレンダー</title>
    <style>
      .sat {
        color: blue;
      }
      .sun {
        color: red;
      }
      .ahref {
        text-align: center;
      }
    </style>
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
  if ($y === 0) return false;
  if ($m === 0) return false;
  if (!checkdate($m, 1, $y)) { //$y年$m月1日が有効な日付かチェック
    return false;
  }
  return true;
}
      $year = 0;
      $month = 0;
      $dayArray = ['月','火','水','木','金','土','日']; 

      try {      
      
        list($year, $month) = get_param();
        
        if (!check_valid_param($year, $month)) {
          //無効：現在の年月に更新する
          $now = new DateTime();
        
          $year = intval($now->format('Y'));
          $month = intval($now->format('n'));
        }

        $thisMonth = new DateTime();
        $thisMonth->setDate($year, $month, 1);
        $prevMonth = new DateTime();
        $prevMonth->setDate($year, $month - 1, 1);
        $nextMonth = new DateTime();
        $nextMonth->setDate($year, $month + 1, 1);
      } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
      }
    ?>
  </head>
  <body>
    <table>
      <tbody>
        <tr>
          <table border="1">
            <caption><?= $thisMonth->format('Y年m月') ?></caption>
            <thead>
              <tr>
                <?php foreach ($dayArray as $day) { ?>
                <th><?= $day ?></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
                $dateArray = [];
                $day_first = $thisMonth->format("w");
                if ($day_first === 0) {
                  $day_first = 7;
                }
                for($i = 1; $i < $day_first; $i++) { //前パティング
                  $dateArray[] = '&nbsp;';
                }
                for($date = 1; $date <= $thisMonth->format('t'); $date++) {
                  $dateArray[] = $date;
                }
                $pudding = 7 - (count($dateArray) % 7);
                if ($pudding === 7) {
                  $pudding = 0;
                }
                for($i = 0; $i < $pudding; $i++) { //後パティング
                  $dateArray[] = '&nbsp;';
                }
                for($i = 0; $i < count($dateArray); $i++) {
              ?>
              <?php if ($i % 7 === 0) { //行開始 ?>
              <tr>
              <?php } ?>
      
              <?php if ($i % 7 === 5) { //土日の色付け ?>
              <td class="sat"><?= $dateArray[$i] ?></td>
              <?php } elseif ($i % 7 === 6) { ?>
              <td class="sun"><?= $dateArray[$i] ?></td>
              <?php } else { ?>
              <td><?= $dateArray[$i] ?></td>
              <?php } ?>
              
              <?php if ($i % 7 === 6) { //行末 ?>
              </tr>
              <?php } ?>
      
              <?php
                }
              ?>
            </tbody>
          </table>  
        </tr>
        <tr></tr>
        <tr class="ahref">
          <td>
            <a href="./calender.php?y=<?= $prevMonth->format('Y') ?>&m=<?= $prevMonth->format('n') ?>">前月へ</a>
          </td>
          <td><a href="./calender.php">今月</a></td>
          <td>
            <a href="./calender.php?y=<?= $nextMonth->format('Y') ?>&m=<?= $nextMonth->format('n') ?>">来月へ</a>
          </td>
        </tr>      
      </tbody>
    </table>
  </body>
</html>