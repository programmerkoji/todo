<?php
require_once(__DIR__ . '/Utils.php');
require_once(__DIR__ . '/Token.php');
require_once(__DIR__ . '/Database.php');

function addTodo($pdo)
{
  $title = trim(filter_input(INPUT_POST, 'title')); //POSTで送られたデータを取得
  if ($title === '') { //データが空文字だったらすぐに返す
    return;
  }

  $stmt = $pdo->prepare('INSERT INTO todos (title) VALUES (:title)'); //レコードを挿入
  $stmt->bindValue('title', $title, PDO::PARAM_STR); //型の指定
  $stmt->execute(); //実行
}

function toggleTodo($pdo)
{
  $id = filter_input(INPUT_POST, 'id');
  if (empty($id)) {
    return;
  }

  $stmt = $pdo->prepare("UPDATE todos SET is_done = NOT is_done WHERE id = :id");
  $stmt->bindValue('id', $id, PDO::PARAM_INT);
  $stmt->execute();
}

function getTodos($pdo)
{
  $stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC");
  $todos = $stmt->fetchAll();
  return $todos;
}

function deleteTodo($pdo)
{
  $id = filter_input(INPUT_POST, 'id');
  if (empty($id)) {
    return;
  }

  $stmt = $pdo->prepare("DELETE FROM todos WHERE id = :id");
  $stmt->bindValue('id', $id, PDO::PARAM_INT);
  $stmt->execute();
}
