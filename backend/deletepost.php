<?php
    require __DIR__ . '/db.php';

    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id']))
    {
        $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :post_id AND user_id = :user_id');
        $stmt->execute([
            ':post_id' => $_POST['post_id'],
            ':user_id' => $_SESSION['user_id']
        ]
        );


    }

    header("Location: index.php");
    exit;
?>