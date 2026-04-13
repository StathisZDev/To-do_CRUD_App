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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="..\fontend\style\style.css">
    <link rel="stylesheet" href="..\fontend\style\s_form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="conatiner">
        <div class="d-flex align-items-center justify-content-center flex-column m-5">
            <h4 class="wh display-6">Log in</h4>
            <form action="signup.php" method="post" class="p-3 glass-card"> 
                
                <label for="name">Username</label><br>
                <input class="inp" type="text" name="username" id="name" required><br>
                <label for="email">Email</label><br>
                <input class="inp" type="email" name="email" id="email" required value=""><br>
                <label for="password">Password</label><br>
                <input class="inp" type="password" name="password" id="password" required value=""><br><br>
                <div class="d-flex align-items-center justify-content-center text-center">
                    <input type="submit" value="Sign up"><br><br>
                </div>
                <br><br>
                <div ><small class="font-weight-bold wh display-16 text-muted">Already have an account? </small><a class="font-weight-bold special-btn" href="signin.php" style="text-decoration: none">Sign in</a></div>
            </form>
         </div>
    </div>
</body>
</html>