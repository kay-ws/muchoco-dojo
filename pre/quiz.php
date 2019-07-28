<?php
define('CHECKED', 'checked');
define('ANSWER1_CORRECT', '24');
define('MESSAGE_CORRECT', '<div class="correct">正解です。</div>');
define('MESSAGE_INCORRECT', '<div class="incorrect">不正解です。</div>');

$answer1 = '';
$answer1_comment ='';
$answer2 = '';
$answer2_checked_1 = '';
$answer2_checked_2 = '';
$answer2_checked_3 = '';
$answer2_comment = '';
$answer3 = '';
$answer3_checked_1 = '';
$answer3_checked_2 = '';
$answer3_checked_3 = '';
$answer3_comment = '';

$is_executed = (isset($_POST['send'])) ? true : false;

//回答１
$answer1 = (isset($_POST['text1']) && is_string($_POST['text1']))? $_POST['text1'] : '';
if ($is_executed) {
  $answer1_comment = ($answer1 === ANSWER1_CORRECT) ? MESSAGE_CORRECT : MESSAGE_INCORRECT;
}

//回答２
$answer2 = (isset($_POST['check1']) && is_array($_POST['check1'])) ? $_POST['check1'] : '';
if ($answer2 !== '') {
  foreach ($answer2 as $value) {
    ${"answer2_checked_" . $value} = CHECKED;
  }
}
if ($is_executed) {
  $answer2_comment = ($answer2_checked_1 === CHECKED 
                    && $answer2_checked_2 === CHECKED
                    && $answer2_checked_3 === '') ? MESSAGE_CORRECT : MESSAGE_INCORRECT;
}

//回答３
$answer3 = (isset($_POST['radio1']) && is_string($_POST['radio1'])) ? $_POST['radio1'] : '';
if ($answer3 !== '') ${"answer3_checked_" . $answer3} = CHECKED;
if ($is_executed) {
//  $answer3_comment = ($answer3_checked_1 === ''
//                    && $answer3_checked_2 === CHECKED
//                    && $answer3_checked_3 === '') ? MESSAGE_CORRECT : MESSAGE_INCORRECT;
  $answer3_comment = ($answer3_checked_2 === CHECKED) ? MESSAGE_CORRECT : MESSAGE_INCORRECT;
}
?>
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
    <form method="POST" action"./quiz.php">
      <p>
        [Q1] ４の階乗（4!）の値は？：
        <input type="text" name="text1" value=<?= $answer1 ?>></input>
      </p>
      <p>
        <?= $answer1_comment ?>
      </p>
        
      <p>
        [Q2]日本にあるのは？：
        <input type="checkbox" name="check1[]" value="1" <?= $answer2_checked_1 ?>>京都タワー</input>
        <input type="checkbox" name="check1[]" value="2" <?= $answer2_checked_2 ?>>東京タワー</input>
        <input type="checkbox" name="check1[]" value="3" <?= $answer2_checked_3 ?>>上海タワー</input>
      </p>
      <p>
        <?= $answer2_comment ?>
      </p>
      <p>
        [Q3]一番小さいのは？：
        <input type="radio" name="radio1" value=1 <?= $answer3_checked_1 ?>>１ｍ</input>
        <input type="radio" name="radio1" value=2 <?= $answer3_checked_2 ?>>一寸</input>
        <input type="radio" name="radio1" value=3 <?= $answer3_checked_3 ?>>一里</input>
      </p>
      <p>
        <?= $answer3_comment ?>
      </p>
      <input type="submit" name="send" value="回答する"></input>
    </form>
  </body>
</html>
