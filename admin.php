<?php
if(isset($_FILES['test']['tmp_name']) && file_exists($_FILES['test']['tmp_name'])){
	if(array_pop(explode('.', $_FILES['test']['name'])) == 'json' ){
		if($json_array = json_decode(file_get_contents($_FILES['test']['tmp_name']), true)){
			$i = 0;
			while($i < count($json_array)){
				if(array_key_exists('q', $json_array[$i]) && array_key_exists('var1', $json_array[$i]) && array_key_exists('var2', $json_array[$i]) && array_key_exists('var3', $json_array[$i]) && array_key_exists('var4', $json_array[$i]) && array_key_exists('answer', $json_array[$i])) {
					$check = 1;
				}
				else{
					$check = 0;
				}
				$i++;
			}
			if($check == 1){
				$files = scandir('tests/');
				$num_test = count($files) - 1;
				if(move_uploaded_file($_FILES['test']['tmp_name'], 'tests/'. 'test' .$num_test.'.json')){
					header ('Location:list.php',true,303);
					exit;
				}
			}
			else{
				echo '<p style="color:red">Ошибка неверная структура данных</p>';
			}
		}
		else{
			echo '<p style="color:red">Загруженный файл не содержит данных JSON. Выберите верный файл</p>';
		}
	}
	else{
		echo 'Неверный формат файла';
	}
}
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <style media="screen">
    form, h1, a {
      margin: 10px auto;
      padding: 0 25% 0;
    }
    input[value="Отправить"] {
      margin: 10px auto;
    }
  </style>
</head>
<body>
  <h1>Загрузите тест в формате JSON</h1>
  <form action="admin.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="test">
    <input type="submit" value="Отправить" />
  </form>
  <a href="list.php">К списку загруженных тестов</a>
</body>
</html>
