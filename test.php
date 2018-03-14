<?php
session_start();
$testing = null;
$testid = null;
if(isset($_GET['testid'])) {
  $testJSON =  file_get_contents('tests/'. 'test' . $_GET['testid'] . '.json');
  $tests = json_decode($testJSON, 'true');
  // echo "<pre>";
  // var_dump($test);
  $_SESSION['test'] = $tests;
  $testing = true;
  if (empty($tests)) {
      http_response_code(404);
      echo "<p style='color:red;'>Неверный id теста!</p>";
      exit;
}
}

if (isset($_POST[0])) {
    $tests = $_SESSION['test'];
    foreach ($tests as $key => $test) {
        $num = $key + 1;
        if ($_POST[$key] == $test['answer']) {
            echo "Ответ на ".$num." вопрос верен."."\n";
        }
        else {
            echo "Ответ на ".$num." вопрос не верен."."\n";
        }
    }
    if(!empty($_POST['name'])){
      $image = imagecreatetruecolor(800, 600);
      $back_color = imagecolorallocate($image, 200, 240, 205);
      $text_color = imagecolorallocate($image, 5, 6, 6);
      $img_box = imagecreatefrompng(__DIR__ . '/1.png');
      $font_file = __DIR__ . '/font.ttf';

      if(!file_exists($font_file)){
        echo 'файл со шрифтом не найден';
        exit;
      }

      imagettftext($image, 50, 20, 30, 200, $text_color, $font_file, $_POST['name']);
      header('Content-Type: image/png');
      imagepng($image);
      imagedestroy($image);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Форма теста</title>
    <style media="screen">
      form, h1, a {
        margin: 10px auto;
        padding: 0 25% 0;
      }
      fieldset {
        margin: 10px auto;
      }
      input[value="Отправить"] {
        margin: 10px auto;
      }
    </style>
</head>
<body>
  <h1>Ответьте на следющие вопросы</h1>
  <?php if ($testing == true):?>
  <?php foreach ($tests as $key => $test):?>
  <form action="test.php" method="POST">
    <fieldset>
      <legend><?php echo $test['q'];?></legend>
      <label><input type="radio" name="<?php echo $key;?>" value="var1"><?php echo $test["var1"];?></label>
      <label><input type="radio" name="<?php echo $key;?>" value="var2"><?php echo $test["var2"];?></label>
      <label><input type="radio" name="<?php echo $key;?>" value="var3"><?php echo $test["var3"];?></label>
      <label><input type="radio" name="<?php echo $key;?>" value="var4"><?php echo $test["var4"];?></label>
    </fieldset>
  <?php endforeach;?>
    <input type="text" name="name" placeholder="Ваше имя">
    <input value="Отправить" type="submit">
  <?php endif;?>
  </form>
  <p><a href="list.php">К списку загруженных тестов</a></p>
  <p><a href="admin.php">К форме загрузки тестов</a></p>
</body>
</html>
