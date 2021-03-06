<?php include('inc/header.php'); ?>

<?php
    $alert=false;
    if(!empty($_SESSION)) {
        try {
            //! Récupérer toutes les infos relatives à l'utilisateur connecté depuis la base de données. En ce moment dans le token de session on possède l'id de l'utilisateur, son username et son email. Il faut éventuellement récupérer tout le reste depuis la base de données.
            //? 1. On insère l'id de session dans une variable qui va servir pour une requête SQL
            $user_id = $_SESSION['id'];
            //? 2. On réalise une requête SQL de récupération de données (SELECT) qui utilise l'id de l'utilisateur connecté pour récupérer toutes sa ligne dans la BDD
            //? 3. On effectue la requête via PDO sur la base de données.
            $sth = $connect->query("SELECT * FROM users WHERE id='{$user_id}' ");
            //? 4. On récupère les données avec un fetch, en précisant que l'on souhaite obtenir les données sous forme de tableau associatif (PDO::FETCH_ASSOC)
            $user = $sth->fetch(PDO::FETCH_ASSOC);
?>

<section id="profil">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-8">
                <div class="content">
                    <!-- //* Affichage des infos username et role récupérées depuis la BDD -->
                    <h2>Bienvenue <?php echo $user['name']?></h2>
                    <p>Vous possédez le role <?php echo $user['role']?></p>
                </div>
            </div>
            <div class="column is-4">
                <div class="content">
                    <a href="myannonces?id=<?php echo $user['id']?>" type="button" class="button">Voir mes annonces publiées</a>
                    <a href="addproducts.php" class="button"> Ajouter une annonce </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
        } catch (PDOException $error) {
            echo $error->message();
        }
    } else {
?>      
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-8">
                    <article class='message is-warning'>
                        <div class='message-header'>
                            <p>Vous ne pouvez pas accéder à votre profil sans vous connecter</p>
                        </div>
                    </article>
                    <p class="lead">
                        <a href="login.php" class="button link">Se connecter</a>
                    </p>
                </div>
            </div>
        </div>
<?php
    }
?>


<?php include('inc/footer.php'); ?>