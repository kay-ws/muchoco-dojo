<!DOCTYPE html>
<html>
  <head>
    <title>quiz</title>
    <meta charset="utf-8" />
  </head>
  <body>
  <?php
    $a1 = '';
    if (isset($_POST['text1'])) {
      $a1 = $_POST['text1'];
    } 
    
    $a2 = '';
    $a2_1 = '';
    $a2_2 = '';
    $a2_3 = '';
    if (isset($_POST['check1']) && is_array($_POST['check1'])) {
      $a2 = $_POST['check1'];
      foreach ($a2 as $value) {
        switch ($value) {
          case '1':
            $a2_1 = 'checked';
            break;
          case '2':
            $a2_2 = 'checked';
            break;
          case '3':
            $a2_3 = 'checked';
            break;
        }
      }
    }
    
    $a3 = '';
    $a3_1 = '';
    $a3_2 = '';
    $a3_3 = '';
    if (isset($_POST['radio1'])) {
      $a3 = $_POST['radio1'];
      switch ($a3){
        case '1':
          $a3_1 = 'checked';
          break;
        case '2':
          $a3_2 = 'checked';
          break;
        case '3':
          $a3_3 = 'checked';
          break;
      }
    }
    var_dump($a1, $a2, $a3);
   ?>
   <form method="POST" action"./quiz.php">
      <p>
        [Q1] 4! =
        <input type="text" name="text1" value=<?= $a1 ?>></input>
      </p>
      <p>
        [Q2]〇〇〇〇〇〇〇〇〇
        <input type="checkbox" name="check1[]" value="1" <?= $a2_1 ?>>A</input>
        <input type="checkbox" name="check1[]" value="2" <?= $a2_2 ?>>B</input>
        <input type="checkbox" name="check1[]" value="3" <?= $a2_3 ?>>C</input>
      </p>
      <p>
        [Q3]●●●●●●●●●
        <input type="radio" name="radio1" value=1 <?= $a3_1 ?>>D</input>
        <input type="radio" name="radio1" value=2 <?= $a3_2 ?>>E</input>
        <input type="radio" name="radio1" value=3 <?= $a3_3 ?>>F</input>
      </p>
      <input type="submit" name="button1" value="回答する"></input>
   </form>
 </body>
  </head>
</html>