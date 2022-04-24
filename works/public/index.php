<?php

require_once(__DIR__ . '/../app/dbconnect.php');
require_once(__DIR__ . '/../app/functions.php');

Token::create();

$pdo = getPdoInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  Token::validate(); //送られてきたtokenのチェック
  $action = filter_input(INPUT_GET, 'action'); 

  switch ($action) {
    case 'add':
      addTodo($pdo);
      break;
    case 'toggle':
      toggleTodo($pdo);
      break;
    case 'delete':
      deleteTodo($pdo);
      break;
    default:
      exit;
  }

  header('Location: ' . SITE_URL); //重複登録を避ける
  exit;
}

$todos = getTodos($pdo);

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
