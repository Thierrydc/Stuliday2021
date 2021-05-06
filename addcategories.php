<?php include('inc/header.php'); ?>

<?php

    $alert= false;
    $categories = $connect->query('SELECT * FROM categories')->fetchAll();

    //Vérification intro : si le bouton est cliqué et si le formulaire est rempli
    if(isset($_POST['submit']) 
    && !empty($_POST['name'])){
        
        $name = strip_tags($_POST['name']);
           
        try {
               
               $sth = $connect->prepare(
                   "INSERT INTO categories (name) VALUES (:name)"
                );
               $sth->bindValue(':name', $name);
                $sth->execute();
                $alert = true; $type="success"; $message = "La catégorie a bien été ajoutée";
            } catch (PDOException $error) {
                echo "Erreur : " . $error->getMessage();
            }
     }
?>

<section id="addcategories">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <h1 class="block">Ajout d'une categorie</h1>
                    <?php require 'inc/alert.php' ?>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="inputName" required>Nom de la catégorie</label>
                            <input class="input" type="text" name="name" id="inputName" required>
                        </div>
                        <hr>
                        <div class="field">
                            <input class="button block" type="submit" name="submit" value="Ajouter la categorie">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('inc/footer.php'); ?>