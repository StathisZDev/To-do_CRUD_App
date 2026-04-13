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
            <form action="signin.php" method="post" class="p-3 glass-card"> 
                 <?php echo $error , "<br>"?>
                <label for="email">Email</label><br>
                <input class="inp" type="email" name="email" id="email" required value=""><br>
                <label for="password">Password</label><br>
                <input class="inp" type="password" name="password" id="password" required value=""><br><br>
                <div class="d-flex align-items-center justify-content-center text-center">
                    <input type="submit" value="Sign in"><br><br>
                </div>
                <br><br>
                <div ><small class="font-weight-bold wh display-16 text-muted">Don't have an account? </small><a class="font-weight-bold special-btn" href="signup.php" style="text-decoration: none">Sign up</a></div>
            </form>
         </div>
    </div>
</body>
</html>