<?php

require_once(__DIR__ . '/../app/config.php');

use MyApp\Database;
use MyApp\Todo;
use MyApp\Utils;

$pdo = Database::getInstance();

$todo = new Todo($pdo);
$todo->processPost(); //postで送信されたデータを処理するメソッド
$todos = $todo->getAll();  //todoを表示するために配列を取得するメソッド

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todoアプリ</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/2f25d783fb.js" crossorigin="anonymous"></script>
</head>
<body>
  <header><h1>Todoアプリ</h1></header>
  
  <div class="wrapper">
    <div class="inner">
      <form action="?action=add" method="post" class="todo_input">
        <input type="text" name="title" placeholder="Todoを入力しよう！">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
      </form>
    
      <ul class="todo_list">
        <?php foreach($todos as $todo): ?>
          <li class="todo_item">
            <form action="?action=toggle" method="post" class="toggle_form">
              <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
              <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
              <label for="<?= $todo->id ?>">
                <input type="checkbox" <?= $todo->is_done ? 'checked' : ''; ?> id="<?= $todo->id ?>">
                <span <?= $todo->is_done ? 'class="done"' : ''; ?>>
                  <?= Utils::h($todo->title); ?>
                </span>
              </label>
            </form>
            
            <form action="?action=delete" method="post">
              <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
              <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
              <span class="delete"><i class="fa-solid fa-delete-left"></i></span>
            </form>

          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <!-- /.inner -->
  </div>
  <!-- /.wrapper -->

  <script src="js/main.js"></script>
</body>
</html>
