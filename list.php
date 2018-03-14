<?php
    $list = glob('tests/*.json');
    // echo "<pre>";
    // var_dump($list);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Выбор теста</title>
    <style media="screen">
      h1, ol, body>a {
      margin: 10px auto;
      padding: 0 25% 0;
      }
      li {
        margin: 10px 40px;
      }
    </style>
  </head>
  <body>
    <h1>Тесты на выбор</h1>
    <ol>
        <?php foreach ($list as $key => $test) {$name = basename($test, ".json");?>
        <li><a href="test.php?testid=<?= $key+1 ?>"><?= $name ?></a></li>
      <?php } ?>
    </ol>
    <a href="admin.php">К форме загрузки тестов</a>
  </body>
</html>
