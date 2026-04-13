<?php


require __DIR__ . '/db.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['content']))
{
    
    $stmt = $pdo->prepare('UPDATE posts SET contents = :content WHERE id = :id');

    $stmt->execute([
        ':id' => $_POST['post_id'],
        ':content' => $_POST['content']
    ]);

}


header('Location: index.php');
exit;

?>