<?php include('inc/header.php'); ?>

    <div id="profil">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-4">
                    <div id="content">
                        <!-- //* Affichage des infos username et role récupérées depuis la BDD -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



    //! Récupérer toutes les infos relatives à l'utilisateur connecté depuis la base de données. En ce moment dans le token de session on possède l'id de l'utilisateur, son username et son email. Il faut éventuellement récupérer tout le reste depuis la base de données.
    //? 1. On insère l'id de session dans une variable qui va servir pour une requête SQL
    //? 2. On réalise une requête SQL de récupération de données (SELECT) qui utilise l'id de l'utilisateur connecté pour récupérer toutes sa ligne dans la BDD
    //? 3. On effectue la requête via PDO sur la base de données.
    //? 4. On récupère les données avec un fetch, en précisant que l'on souhaite obtenir les données sous forme de tableau associatif (PDO::FETCH_ASSOC)

<?php include('inc/footer.php'); ?>