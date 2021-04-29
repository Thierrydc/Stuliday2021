<?php include('inc/header.php'); ?>

<?php
    /**
     * ! Créer un nouvel article à partir du formulaire.
     * 
     * TODO : Vérification intro : si le bouton est cliqué et si le formulaire est rempli
     * 
     * TODO : Initialisation des variables & assainissement
     * 
     * TODO : Vérification du prix positif
     * 
     * TODO : Enregistrement des données
     */

?>

<div id="addproducts">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <h1 class="block">Ajout de produits</h1>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="inputName" required>Nom de l'article</label>
                            <input class="input" type="text" name="Name" id="inputName">
                        </div>
                        <div class="field">
                            <label for="inputDescription">Description de l'article</label>
                            <textarea class="input" name="description" id="inputDescription" required></textarea>
                        </div>
                        <div class="field">
                            <label for="inputPrice">Prix de l'article</label>
                            <input class="input" type="number" min="1" max="999999" name="price" id="inputPrice" required>
                        </div>
                        <div class="field">
                            <label for="inputCategory">Catégorie de l'article</label>
                            <select class="input" name="category" id="inputCategory" required></select>
                        </div>
                        <hr>
                        <div class="field">
                            <input class="button block" type="submit" name="submit" value="Ajouter l'article">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>