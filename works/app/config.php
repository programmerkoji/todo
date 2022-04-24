<?php

spl_autoload_register(function($class) {
  $fileName = sprintf(__DIR__ . '/%s.php', $class);

  if (file_exists($fileName)) {
    require($fileName);
  } else {
    echo $fileName . 'というファイルはありません。';
    exit;
  }
});
