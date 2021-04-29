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

    $categories = $connect->query('SELECT * FROM categories')->fetchAll();

    //Vérification intro : si le bouton est cliqué et si le formulaire est rempli
    if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['category'])){
        
        //Initialisation des variables & assainissement
        $name = strip_tags($_POST['name']);
        $description = strip_tags($_POST['description']);
        $price = intval(strip_tags($_POST['price']));
        $category = strip_tags($_POST['category']);
        $user_id = $_SESSION['id'];

        //Vérification du prix positif
        if(is_int($price) && $price > 0) {
            //? Etape 4 : Enregistrement des données du formulaire via une requete préparée sql INSERT
            try {
               //? Préparation de la requête, je définis la requête à exécuter avec des valeurs génériques (des paramètres nommés).
               $sth = $connect->query("INSERT INTO products (name, description, price, category_id, author_id) VALUES (:name, :description, :price, :category, :author)");
               //? J'affecte chacun des paramètres nommés à leur valeur via un bindValue. Cette opération me protège des injections SQL (en + de l'assainissement des variables)
               $sth->bindValue(':name', $name);
               $sth->bindValue(':description', $description);
               $sth->bindValue(':price', $price);
               $sth->bindValue(':category', $category);
               $sth->bindValue(':author', $user_id);

               //? J'exécute ma requête SQL d'insertion avec execute()
                $sth->execute();
                echo "Votre article a bien été ajouté";
                //? Je redirige vers la page des produits.
                header('Location: products.php');
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

<div id="addproducts">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <h1 class="block">Ajout de produits</h1>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="inputName" required>Nom de l'article</label>
                            <input class="input" type="text" name="name" id="inputName" required>
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
                            <input class="button block" type="submit" name="submit" value="Ajouter l'article">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>