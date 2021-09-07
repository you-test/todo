<?php

require_once(__DIR__ . '/app/config.php');

$pdo = Database::getInstance();

$todo = new Todo($pdo);
$todo->processPost();
$todos = $todo->getAll();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>タスクマネージャー</title>
  <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
  <h1>タスク</h1>

  <div class="container">
    <!-- タスク追加 -->
    <form action="?action=add" method="post">
      <input type="text" name="title" placeholder="新しいタスクを追加してください！">
      <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
    </form>

    <!-- 一括削除 -->
    <form action="?action=purge" method="post">
      <span class="purge">チェックしたものを削除</span>
      <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
    </form>
    <!-- タスク一覧表示-->
    <ul>
      <?php foreach ($todos as $todo): ?>
      <li>
        <form action="?action=toggle" method="post">
          <input type="checkbox" <?= $todo->is_done ? 'checked' : ''; ?> id="<?= Utils::h($todo->id); ?>">
          <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">

          <label for="<?= Utils::h($todo->id); ?>"><?= Utils::h($todo->title); ?></label>
        </form>

        <form action="?action=delete" method="POST">
          <span class="delete">x</span>
          <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
        </form>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <script src="public/js/main.js"></script>
</body>
</html>
