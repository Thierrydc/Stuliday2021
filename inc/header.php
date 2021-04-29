<?php  require 'inc/config.php'; ?>
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
                    <!-- //? Affichage conditionnel du bouton se connecter/ page de profil -->
                    <?php
                    if(empty($_SESSION)) {
                    ?>
                        <a href="login.php">Se connecter</a>
                    <?php
                    } else {
                    ?>
                        <a href="profile.php"><?php echo $_SESSION['username']; ?></a>
                        <a href="?logout">Se déconnecter</a>
                    <?php
                    }
                    ?>
                    
                </ul>
            </div>
        </nav>
    </header>
   