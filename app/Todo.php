<?php

class Todo
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        Token::create();
    }

    //渡されたactionの値で処理を分岐
    public function processPost()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = filter_input(INPUT_GET, 'action');
            Token::validate();

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

            //二重投稿防止（リロード時など）
            header('Location: ' . SITE_URL);
            exit;
        }
    }

    //タスク追加
    public function add()
    {
        $title = trim(filter_input(INPUT_POST, 'title'));
        if ($title === '') {
            return;
        }

        $stmt = $this->pdo->prepare("INSERT INTO todos (title) VALUES (:title)");
        $stmt->bindValue('title', $title, PDO::PARAM_STR);
        $stmt->execute();
    }

    //チェックの入替
    public function toggle()
    {
        $id = filter_input(INPUT_POST, 'id');
        if (empty($id)) {
            return;
        }

        $stmt = $this->pdo->prepare("UPDATE todos SET is_done = NOT is_done WHERE id = :id");
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //タスクの削除
    public function delete()
    {
        $id = filter_input(INPUT_POST, 'id');
        if (empty($id)) {
            return;
        }

        $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //一括削除
    public function purge()
    {
        $this->pdo->query("DELETE FROM todos WHERE is_done = 1");
    }

    //タスク一覧表示
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM todos ORDER BY id DESC");
        $todos = $stmt->fetchAll();
        return $todos;
    }
}
