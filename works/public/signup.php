<?php

require_once(__DIR__ . '/../app/config.php');

use MyApp\Database;
use MyApp\Utils;

$pdo = Database::getInstance();

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
  
  <div class="wrapper signup">
    <div class="inner">
      <h2 class="signup_ttl">新規会員登録</h2>
      <form action="" method="POST" class="signup_form">
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']) ?>">
        <p>
          <label for="username">ユーザー名</label>
          <input type="text" name="username" id="username">
        </p>
        <p>
          <label for="email">メールアドレス</label>
          <input type="email" name="email" id="email">
        </p>
        <p>
          <label for="password">パスワード</label>
          <input type="password" name="password" id="password">
        </p>
        <p>
          <label for="password_conf">パスワード確認</label>
          <input type="password" name="password_conf" id="password_conf">
        </p>
        <p class="signup_btnWrapper">
          <button type="submit" class="signup_btn">登録する</button>
        </p>
      </form>

      <p class="link_login">すでに会員の方は<a href="login_form.php" class="link_login">こちら</a></p>

    </div>
    <!-- /.inner -->
  </div>
  <!-- /.wrapper -->

</body>
</html>
