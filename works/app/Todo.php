<?php
namespace MyApp;

class Todo
{
  private $pdo;
  
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
    Token::create();
  }

  public function processPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      Token::validate(); //送られてきたtokenのチェック
      $action = filter_input(INPUT_GET, 'action'); 
    
      switch ($action) {
        case 'add':
          $this->add();
          break;
        case 'toggle':
          $this->toggle();
          break;
        case 'delete':
          $this->delete();
          break;
        case 'purge':
          $this->purge();
          break;
        default:
          exit;
      }
    
      header('Location: ' . SITE_URL); //重複登録を避ける
      exit;
    }
  }

  private function add()
  {
    $title = trim(filter_input(INPUT_POST, 'title')); //POSTで送られたデータを取得
    if ($title === '') { //データが空文字だったらすぐに返す
      return;
    }
  
    $stmt = $this->pdo->prepare('INSERT INTO todos (title) VALUES (:title)'); //レコードを挿入
    $stmt->bindValue('title', $title, \PDO::PARAM_STR); //型の指定
    $stmt->execute(); //実行
  }
  
  private function toggle()
  {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) {
      return;
    }
  
    $stmt = $this->pdo->prepare("UPDATE todos SET is_done = NOT is_done WHERE id = :id");
    $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }
  
  private function delete()
  {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) {
      return;
    }
  
    $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
    $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  private function purge()
  {
    $this->pdo->query("DELETE FROM todos WHERE is_done = 1");
  }

  public function getAll()
  {
    $stmt = $this->pdo->query("SELECT * FROM todos ORDER BY id DESC");
    $todos = $stmt->fetchAll();
    return $todos;
  }
}
