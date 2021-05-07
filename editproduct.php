<?php include('inc/header.php'); ?>

<?php
    
    $alert= false;
    $id = $_GET['id'];
    $categories = $connect->query('SELECT * FROM categories')->fetchAll();

    $sth = $connect->query(
        "SELECT b.*, u.name as username, c.name as category
        FROM biens AS b
        LEFT JOIN users AS u ON b.author_id = u.id 
        LEFT JOIN categories AS c ON b.category_id = c.id 
        WHERE b.id = {$id}");
    
    $location = $sth->fetch(PDO::FETCH_ASSOC);

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
        $photo = strip_tags($_POST['photo']);
        $user_id = $_SESSION['id'];

        //Vérification du prix positif
        if(is_int($price) && $price > 0) {

            // Vérification du fichier uploadé
            if(!empty($photo)) {
                if($photo['size'] > 0 && $photo['size'] <= 1000000) { //vérification de la taille du fichier
                    $valid_extensions = ['jpg', 'jpeg', 'png'];
                    $get_extension = strtolower(substr(strrchr($photo['name'], '.'), 1));
                    if(in_array($get_extension, $valid_extensions)) { //vérification extension du fichier
                        $photo_name = uniqid() . '_' . $photo['name'];
                        $upload_dir = "./public/uploads/";
                        $upload_name = $upload_dir . $photo_name;
                        $upload_result = move_uploaded_file($photo['tmp_name'], $upload_name);
                    }
                } else {
                    $photo_name = "";
                }
            }
            //? Etape 4 : Enregistrement des données du formulaire via une requete préparée sql INSERT
            try {
               //? Préparation de la requête, je définis la requête à exécuter avec des valeurs génériques (des paramètres nommés).
               $sth = $connect->prepare(
                   "UPDATE biens 
                   SET title=:title,description=:description,bedroom_number=:bedroom_number,surface=:surface,price=:price,category_id=:category,photo=:photo
                   WHERE id = :id");

               //? J'affecte chacun des paramètres nommés à leur valeur via un bindValue. Cette opération me protège des injections SQL (en + de l'assainissement des variables)
               $sth->bindValue(':title', $title);
               $sth->bindValue(':description', $description);
               $sth->bindValue(':bedroom_number', $bedroom_number);
               $sth->bindValue(':surface', $surface);
               $sth->bindValue(':price', $price);
               $sth->bindValue(':category', $category);
               $sth->bindValue(':id', $id);
               $sth->bindValue(':photo', $photo);

               //? J'exécute ma requête SQL d'insertion avec execute()
                $sth->execute();
                $alert = true; $type="success"; $message = "Votre annonce a bien été modifiée";
                header('Location:product.php?id=' . $id);
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

<section id="editproduct">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <h1 class="block">Modification d'une location</h1>
                    <?php require 'inc/alert.php' ?>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="inputTitle" required>Titre de votre annonce</label>
                            <input class="input" type="text" name="title" id="inputTitle" value="<?php echo $location['title']?>" required>
                        </div>
                        <div class="field">
                            <label for="inputDescription">Description du bien</label>
                            <textarea class="input" type="text" name="description" id="inputDescription" required><?php echo $location['description']?>"</textarea>
                        </div>
                        <div class="field">
                            <label for="InputBedroomsNumber">Nombre de chambres</label>
                            <input class="input" type="number" min="1" name="bedroom_number" id="InputBedroomsNumber" value="<?php echo $location['bedroom_number']?>" required></input>
                        </div>
                        <div class="field">
                            <label for="InputSurface">Surface en m2</label>
                            <input class="input" type="number" min="1" name="surface" id="InputSurface" value="<?php echo $location['surface']?>" required></input>
                        </div>
                        <div class="field">
                            <label for="inputPrice">Prix de la location à la semaine</label>
                            <input class="input" type="number" min="1" max="999999" name="price" id="inputPrice" value="<?php echo $location['price']?>" required>
                        </div>
                        <div class="field">
                            <label for="inputCategory">Catégorie du bien</label>
                            <select class="input" name="category" id="inputCategory" required>
                            <option value="<?php echo $location['id']; ?>"><?php echo $location['category'];?></option>
                            <?php
                                foreach ($categories as $category) {
                            ?>
                                <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        
                        <div id="photo" class="field">
                            <label for="inputPhoto">Photo du bien</label>
                            <div>
                                <img src="<?php echo (!empty($location['photo'])? "./public/uploads/".$location['photo'] : 'assets/img/pasdephoto.jpg')?>" alt="">
                                <div class="file has-name is-fullwidth">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="photo" id="inputPhoto" accept=".png, jpg, jpeg">
                                    <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file…
                                    </span>
                                    </span>
                                </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="field">
                            <input class="button block" type="submit" name="submit" value="Modifier l'annonce">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('inc/footer.php'); ?>