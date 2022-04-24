<?php

spl_autoload_register(function($class) {
  $prefix = 'MyApp\\'; 
  
  if (strpos($class, $prefix) === 0) { //クラス名の最初にMyApp\がついてたら
    $fileName = sprintf(__DIR__ . '/%s.php', substr($class, strlen($prefix))); //MyApp\を取り除く
  
    if (file_exists($fileName)) {
      require($fileName);
    } else {
      echo $fileName . 'というファイルはありません。';
      exit;
    }
  }
});
