<!DOCTYPE html>
<html>
  <head>
    <title>quiz</title>
    <meta charset="utf-8" />
    <style>
      .correct {
        color: black;
        font-weight: bold;
      }
      .incorrect {
        color: red;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
  <?php
    if (isset($_POST['text1'])) {
      $init_flag = false;
    } else {
      $init_flag = true;
    }
//    var_dump($init_flag);
    if (isset($_POST['text1']) && is_string($_POST['text1'])) {
      $a1 = $_POST['text1'];
    } else {
      $a1 = '';
    }
    
    $a2_1 = '';
    $a2_2 = '';
    $a2_3 = '';
    if (isset($_POST['check1']) && is_array($_POST['check1'])) {
      $a2 = $_POST['check1'];
      foreach ($a2 as $value) {
        ${"a2_" . $value} = 'checked';
      }
    } else {
      $a2 = '';
    }
    
    $a3_1 = '';
    $a3_2 = '';
    $a3_3 = '';
    if (isset($_POST['radio1']) && is_string($_POST['radio1'])) {
      $a3 = $_POST['radio1'];
      ${"a3_" . $a3} = 'checked';
    } else {
      $a3 = '';
    }
    
//    var_dump($a1, $a2, $a3);
   ?>
   <form method="POST" action"./quiz.php">
      <p>
        [Q1] ４の階乗（4!）の値は？：
        <input type="text" name="text1" value=<?= $a1 ?>></input>
      </p>
      <p>
      <?php
        if (!$init_flag) { //初期状態では表示しない
          if ($a1 === "24") {
      ?>
            <div class="correct">正解です。</div>
      <?php  
          } else {
      ?>
            <div class="incorrect">不正解です。</div>
      <?php  
          }
        }
      ?>
      </p>
        
      <p>
        [Q2]日本にあるのは？：
        <input type="checkbox" name="check1[]" value="1" <?= $a2_1 ?>>京都タワー</input>
        <input type="checkbox" name="check1[]" value="2" <?= $a2_2 ?>>東京タワー</input>
        <input type="checkbox" name="check1[]" value="3" <?= $a2_3 ?>>上海タワー</input>
      </p>
      <p>
      <?php
        if(!$init_flag) {
          if ($a2_1 === 'checked' && $a2_2 === 'checked' && $a2_3 === '') {
      ?>
            <div class="correct">正解です。</div>
      <?php
          } else {
      ?>
            <div class="incorrect">不正解です。</div>
      <?php
          }
        }
      ?>
      </p>
      <p>
        [Q3]一番小さいのは？：
        <input type="radio" name="radio1" value=1 <?= $a3_1 ?>>１ｍ</input>
        <input type="radio" name="radio1" value=2 <?= $a3_2 ?>>一寸</input>
        <input type="radio" name="radio1" value=3 <?= $a3_3 ?>>一里</input>
      </p>
      <p>
      <?php
        if (!$init_flag) {
          if ($a3_2 === 'checked') {
      ?>
            <div class="correct">正解です。</div>
      <?php
          } else {
      ?>
            <div class="incorrect">不正解です。</div>
      <?php
          }
        }
      ?>
      
      <input type="submit" name="button1" value="回答する"></input>
   </form>
 </body>
  </head>
</html>