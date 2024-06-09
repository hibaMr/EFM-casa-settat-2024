
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <header class="header">
        <?php if(isset($_SESSION['employe'])){ ?>
        <h1 class="h1"><?php echo $_SESSION['employe']['nom'] ?> </h1>
        <?php } ?>
        <nav>
            <ul>
                <li><a href="connEmp.php">Connecter</a></li>
                <li><a href="Sinscrire.php">S'inscrire</a></li>
                <li><a href="listIns.php">liste de voyage</a></li>
                <li><a href="deconnecter.php" onclick="return confirm('voler vous deconnecter?')">se deconnecter</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>