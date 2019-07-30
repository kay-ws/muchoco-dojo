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
      table {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
      }
      .ahref {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
      }
      .ahref ul {
        list-style: none;
      }
      .prevM {
        float: left;
      }
      .nextM {
        float: right;
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
      $prevPadding = array(6, 0, 1, 2, 3, 4, 5);
      $nextPadding = array(0, 6, 5, 4, 3, 2, 1);

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

//      １  ２  ３  ４  ５  ６  ７
//      月  火  水  木  金　土  日
        
        $header = '';
        foreach ($dayArray as $day) {
          $header .= "<th>${day}</th>";
        }

        $dateArray = array();
        $dayFirst = intval($thisMonth->format("w"));
        $prevPaddingCount = $prevPadding[$dayFirst];
        for($i = 0; $i < $prevPaddingCount; $i++) { //前パティング
          $dateArray[] = '&nbsp;';
        }
        for($date = 1; $date <= $thisMonth->format('t'); $date++) {
          $dateArray[] = $date;
        }
        $nextPaddingCount = $nextPadding[count($dateArray) % 7];
        for($i = 0; $i < $nextPaddingCount; $i++) { //後パティング
          $dateArray[] = '&nbsp;';
        }

        $tbody = '';
        for($i = 0; $i < count($dateArray); $i++) {
          switch (($i + 1) % 7) {
            case 1:  //月曜日
              $tbody .= "<tr><td>${dateArray[$i]}</td>";
              break;
            case 6:  //土曜日
              $tbody .= "<td class='sat'>${dateArray[$i]}</td>";
              break;
            case 0:  //日曜日 (=7)
              $tbody .= "<td class='sun'>${dateArray[$i]}</td></tr>";
              break;
            default: //その他の曜日
              $tbody .= "<td>${dateArray[$i]}</td>";
              break;
          }
        }
      } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
      }
    ?>
  </head>
  <body>
    <div class="tablewrapper">
      <div class="table">
        <table border="1">
          <caption><?= $thisMonth->format('Y年m月') ?></caption>
          <thead>
            <tr><?= $header ?></tr>
          </thead>
          <tbody>
            <?= $tbody ?>
          </tbody>
        </table>
      </div>
      <div class="ahref">
        <ul>
          <li>
            <a href="./calender.php">今月</a>
          </li>
        </ul>
        <ul>
          <li class="prevM">
            <a href="./calender.php?y=<?= $prevMonth->format('Y') ?>&m=<?= $prevMonth->format('n') ?>">前月へ</a>
          </li>
          <li class="nextM">
            <a href="./calender.php?y=<?= $nextMonth->format('Y') ?>&m=<?= $nextMonth->format('n') ?>">来月へ</a>
          </li>
        </ul>
      </div>
    </div>
  </body>
</html>