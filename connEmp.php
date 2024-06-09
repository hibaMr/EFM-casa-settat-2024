<?php
session_start();
require 'conxDB.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connecter'])){
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];
    if(!empty($user) && !empty($pwd)){
        $statment = $pdo->prepare('SELECT * FROM employe WHERE user = :user AND pwd = :pwd');
        $statment->execute([
            ':user' => $user,
            ':pwd' => $pwd
        ]);
        if($statment->rowCount() >= 1){
            $employe = $statment->fetch(PDO::FETCH_ASSOC);
            $_SESSION['employe'] = $employe;
            header('location:Sinscrire.php');
        }else{
            ?>
            <div class="alert alert-danger" role="alert">incorrect</div>
            <?php
        }
        
    }else{
        ?>
        <div class="alert alert-danger" role="alert">champs obligatiore</div>
        <?php
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Exercice</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    
    <div class="container">
        <div class="from-box">
            <h1 id="title">Sing Up</h1>
            <form action="" method="POST">
                <div class="input-group">
                    <div class="input-field" id="nameField">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#919191" d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                        <input type="text" placeholder="user" name="user">
                    </div>


                    <div class="input-field">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#939393" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                        <input type="password" placeholder="password" name="pwd">
                    </div>
                    <p>Lost password <a href="#">Click Here!</a></p>
                </div>
                <div class="btn-field">
                    <button type="submit" id="connecter" name="connecter">connecter</button>
                </div>
                
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>