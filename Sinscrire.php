<?php
session_start();
require 'menu.php';
require 'conxDB.php';
$statment1 = $pdo->prepare('SELECT * FROM ville ');
$statment1->execute();
$villes = $statment1->fetchAll(PDO::FETCH_ASSOC);


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ajouter"])){
    $villeD = $_POST['villeD'];
    $villeA = $_POST['villeA'];

    $dateVoy = $_POST['dateVoy'];
    $nbrePers = $_POST['nbrePers'];

    if(!empty($villeD) && !empty($villeA) && !empty($dateVoy) && !empty($nbrePers)){
        $statment2 = $pdo->prepare('SELECT descriptionvoyage.codDesc,description,villeD,villeA,voyage.codeTrans,voyage.codeVoyage,prixTicket,duree,heureDepart,voyage.codDesc FROM voyage,descriptionvoyage WHERE voyage.codDesc = descriptionvoyage.codDesc');
        $statment2->execute();
        $codeVoy = $statment2->fetch(PDO::FETCH_ASSOC);
        $_SESSION['codeVoy'] = $codeVoy;


        $statment3 = $pdo->prepare('INSERT INTO inscription (datevoy,nbrepers) values (:datevoy,:nbrepers)');
        $statment3->execute([
            ':datevoy' => $dateVoy,
            ':nbrepers' => $nbrePers
        ]);

        header('location:listIns.php');
    }else{
        ?>
        <div class="alert alert-danger" role="alert">champs obligatiore</div>
        <?php
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>A Stagiaire</title>
    <style>
        .body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
            line-height: 1.5;
            min-height: 100vh;
            background: #f3f3f3;
            flex-direction: column;
            margin: 0;
        }

        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 500px;
            text-align: center;
            margin-top:20px;
        }

        h1 {
            color: #4CAF50;
        }

        label {
            display: block;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 5px;
            text-align: left;
            color: #555;
            font-weight: bold;
        }

        input, select {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
            border: none;
            color: white;
            cursor: pointer;
            background-color: #4CAF50;
            width: 100%;
            font-size: 16px;
        }
    </style>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <div class="body">
        <div class="main">
        <h1>Inserer un Nouveau Stagiaire</h1>
        <form action="" method="POST">
            
            <label for="villeD">ville départ</label>
            <select name="villeD" id="villeD">
                <?php foreach($villes as $ville){?>
                    <option value="<?php echo $ville['codeVille'] ?>"><?php echo $ville['ville'] ?></option>
                <?php }  ?>
            </select>
            

            <label for="villeA">ville d'arrivé</label>
            <select name="villeA" id="villeA">
                <?php foreach($villes as $ville){?>
                    <option value="<?php echo $ville['codeVille'] ?>"><?php echo $ville['ville'] ?></option>
                <?php }  ?>
            </select>

            <label for="dateVoy">date de voyage</label>
            <input type="date" id="dateVoy" name="dateVoy" placeholder="Entrer la date de voyage">

            <label for="nbrePers">nombre de personnes</label>
            <input type="number" id="nbrePers" name="nbrePers" placeholder="Entrer le nombre de personnes">

            <button type="submit" name="ajouter">Ajouter</button>
        </form>
    </div>
    </div>
    
</body>
</html>
