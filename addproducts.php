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
    $alert= false;
    $categories = $connect->query('SELECT * FROM categories')->fetchAll();

    //Vérification intro : si le bouton est cliqué et si le formulaire est rempli
    if(isset($_POST['submit']) 
    && !empty($_POST['title']) 
    && !empty($_POST['surface']) 
    && !empty($_POST['description']) 
    && !empty($_POST['price']) 
    && !empty($_POST['category']) 
    && !empty($_POST['bedroom_number'])){
        
        //Initialisation des variables & assainissement
        $title = strip_tags($_POST['title']);
        $description = strip_tags($_POST['description']);
        $surface = intval(strip_tags($_POST['surface']));
        $price = intval(strip_tags($_POST['price']));
        $category = strip_tags($_POST['category']);
        $bedroom_number = intval(strip_tags($_POST['bedroom_number']));
        $user_id = $_SESSION['id'];

        //Vérification du prix positif
        if(is_int($price) && $price > 0) {
            //? Etape 4 : Enregistrement des données du formulaire via une requete préparée sql INSERT
            try {
               //? Préparation de la requête, je définis la requête à exécuter avec des valeurs génériques (des paramètres nommés).
               $sth = $connect->prepare(
                   "INSERT INTO biens (title, description, bedroom_number, surface, price, category_id, author_id) VALUES (:title, :description, :bedroom_number, :surface, :price, :category, :author)"
                );
               //? J'affecte chacun des paramètres nommés à leur valeur via un bindValue. Cette opération me protège des injections SQL (en + de l'assainissement des variables)
               $sth->bindValue(':title', $title);
               $sth->bindValue(':description', $description);
               $sth->bindValue(':bedroom_number', $bedroom_number);
               $sth->bindValue(':surface', $surface);
               $sth->bindValue(':price', $price);
               $sth->bindValue(':category', $category);
               $sth->bindValue(':author', $user_id);

               //? J'exécute ma requête SQL d'insertion avec execute()
                $sth->execute();
                $alert = true; $type="success"; $message = "Votre annonce a bien été ajoutée";
            } catch (PDOException $error) {
                echo "Erreur : " . $error->getMessage();
            }
        }
     }
?>
<!--
//? Préparation de la requête, je définis la requête à exécuter avec des valeurs génériques (des paramètres nommés).
//? J'affecte chacun des paramètres nommés à leur valeur via un bindValue. Cette opération me protège des injections SQL (en + de l'assainissement des variables)
//? J'exécute ma requête SQL d'insertion avec execute()
//? Je redirige vers la page des produits.
-->

<section id="addproducts">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <h1 class="block">Ajout d'une location</h1>
                    <?php require 'inc/alert.php' ?>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="inputTitle" required>Titre de votre annonce</label>
                            <input class="input" type="text" name="title" id="inputTitle" required>
                        </div>
                        <div class="field">
                            <label for="inputDescription">Description du bien</label>
                            <textarea class="input" type="text" name="description" id="inputDescription" required></textarea>
                        </div>
                        <div class="field">
                            <label for="InputBedroomsNumber">Nombre de chambres</label>
                            <input class="input" type="number" min="1" name="bedroom_number" id="InputBedroomsNumber" required></input>
                        </div>
                        <div class="field">
                            <label for="InputSurface">Surface en m2</label>
                            <input class="input" type="number" min="1" name="surface" id="InputSurface" required></input>
                        </div>
                        <div class="field">
                            <label for="inputPrice">Prix de la location à la semaine</label>
                            <input class="input" type="number" min="1" max="999999" name="price" id="inputPrice" required>
                        </div>
                        <div class="field">
                            <label for="inputCategory">Catégorie du bien</label>
                            <select class="input" name="category" id="inputCategory" required>
                            <?php
                                foreach ($categories as $category) {
                            ?>
                                <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <hr>
                        <div class="field">
                            <input class="button block" type="submit" name="submit" value="Ajouter l'annonce">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('inc/footer.php'); ?>