<?php 
    require __DIR__ . '/db.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'],$_POST['email'],$_POST['password']) )
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare('INSERT INTO users(username,email,password) VALUES (:username,:email,:password)');
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $password_hash
        ]);

        header('Location: signin.php');
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
    <form action="signup.php" method="post"> 
        <label for="name">Username</label><br>
        <input type="text" name="username" id="name"><br>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Sign up"><br>
    </form>
</body>
</html>