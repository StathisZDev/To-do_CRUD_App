<?php 
    require __DIR__ . '/db.php';

    $error = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'],$_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([
            ':email' => $email,
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password']))
        {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
            exit;
        }
        else
        {
            //cancel page reload
            $error = 'Failed to log in';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="signin.php" method="post"> 
        <?php echo $error , "<br>"?>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Sign in"><br>
    </form>
</body>
</html>