<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>カレンダー</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style media="screen">
      .sat {
        color: blue;
      }
      .sun {
        color: red;
      }
      .conteiner {
        text-align: center;
      }
      .tableHeader {
        font-weight: bold;
      }
      .table table {
        width 50%
        margin 0 auto;
        max-width: 768px;
        border: 1px;
        align: center;
        margin-left: auto;
        margin-right: auto;
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
        
        $thisMonthText = $thisMonth->format('Y年m月');
        $prevMonthText = "y=" . $prevMonth->format('Y') . "&m=" . $prevMonth->format('n');
        $nextMonthText = "y=" . $nextMonth->format('Y') . "&m=" . $nextMonth->format('n');

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
    <div class="conteiner">
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-2">
          <span class="tableHeader"><?= $thisMonthText ?></span>
        </div>
        <div class="col-md-5"></div>
      </div>
      <div class-"row">
        <div class="col-md-12">
          <div class="table">
            <table>
              <thead>
                <tr><?= $header ?></tr>
              </thead>
              <tbody>
                <?= $tbody ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-2">
          <a href="./calender.php">今月</a>
        </div>
        <div class="col-md-5"></div>
      </div>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-1">
          <a href="./calender.php?<?= $prevMonthText ?>">前月へ</a>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-1">
          <a href="./calender.php?<?= $nextMonthText ?>">来月へ</a>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>