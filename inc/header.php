<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Stuliday 2021</title>
</head>
<body>
    <header id="home">
        <nav>
            <div id="menuNav">
                <div id="logo">
                    <a href="index.php">Stuliday</a> 
                </div>
                <div id="burger">
                    <a href=""><i class="fas fa-bars"></i></a>
                </div>
                <ul>
                    <li><a href="products.php">Produits</a></li>
                    <li><a href="profil.php">Mon profil</a></li>
                    <li><a href="login.php">Connexion</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <p style="color:red; font-size:20px; font-weigh:bold">
        <?php  require 'inc/config.php'; ?>
    </p>
   