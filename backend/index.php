<?php

    require __DIR__ . '/db.php';

    $msg = "";

    session_start();


    if(!isset($_SESSION['user_id']))
    {
        header('Location: signin.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content']))
    {
        $msg = "possdfted";

        $text = $_POST['content'];

        $stmt = $pdo->prepare('INSERT INTO posts (user_id,contents) VALUES (:user_id,:contents)');

        $stmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':contents' => $text
        ]);
       

        header('Location: index.php');
        exit;
    }

    $stmt = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC');
    
    $stmt->execute([
        ':user_id' => $_SESSION['user_id']
    ]);

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../fontend//style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
   
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>

    
    <!-- Add Modal -->
    <div class="modal fade modal-section" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog tester">
        <div class="modal-content ">


          <div class="modal-body tester">
            <div class="d-flex text-center text-white justify-content-between">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #171745;">New Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php" method="post">
                <?php echo $msg . "<br>"?>
                <input type="text" name="content">
                <br>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <input type="submit" value="Add"> -->
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade modal-section" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog tester">
        <div class="modal-content ">
          <div class="modal-body tester">
            <div class="d-flex text-center text-white justify-content-between">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #171745;">Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="editpost.php" method="post">
                <?php echo $msg . "<br>"?>

                <input type="text" name="content">

                <input type="hidden" id="edit-id" name="post_id">

                <br>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <input type="submit" value="Add"> -->
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

     <!-- nav bar -->
    <div class="container-fluid nav-bar mb-3">
        <div class="d-flex justify-content-between py-md-2 py-xs-2 text-center align-items-center">
            <div class="text-muted">
                <div class="display-6 fw-bold text-white"> TO DO</div>
            </div>
            <div>
                
                <button  type="button" class="add-btn d-flex justify-content-between py-1 text-center align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                    <img class="add-img" src="..\fontend\images\plus.png" alt="img" style="width: 30px;">
                </button>
            </div>
        </div>
    </div>

    

    <!-- List item demo -->
     
    <div class="container-fluid ">
       
        <div class="row my-3">
             <?php foreach($posts as $post):  ?>
            <div class="col">
                <div class="to-do-item d-flex justify-content-between align-items-center p-1 px-2 gap-2 my-3">
                    <div class="d-flex align-items-center text-start gap-4">
                                <button style="background-color: #17174500; border: none;" class="edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#modal_edit" data-id="<?php echo $post['id'] ?>">
                                    <img src="..\fontend\images\edit.png" alt="" style="width: 20px;">
                                </button>        
                        <div> <?php echo $post['contents']; ?></div>
                    </div>
                    <div class="d-flex flex-direction-col gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>
                        </div>
                        <div>
                            <!-- remember to change -->
                             <form action="deletepost.php" method="post">
                                    <input type="hidden" name='post_id' value= "<?php echo $post['id']?>">
                                    <button type="submit" style="background: none; border: 0;"><img src="../fontend\images\delete.png" alt="" style="width: 20px;" class="reactive-image"></button>
                             </form>
                            <!-- <a href=""> </a> -->
                        </div>
                    </div>
                </div>
                 <?php endforeach; ?>
            </div>
           
        </div>
       
<script src="../fontend//javascript//script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>