<?php include('inc/header.php'); ?>

<?php
    
    $alert= false;
    $id = $_GET['id'];

    $sth = $connect->query("SELECT * FROM categories WHERE id = {$id}");
    $category = $sth->fetch(PDO::FETCH_ASSOC);
    
    if(isset($_POST['submit']) && !empty($_POST['name'])){
        
        $name = strip_tags($_POST['name']);

        try {
            $sth = $connect->prepare(
                "UPDATE categories SET name=:name WHERE id = :id");
            $sth->bindValue(':name', $name);
            $sth->bindValue(':id', $id);

            $sth->execute();
            $alert = true; $type="success"; $message = "Votre annonce a bien été modifiée";
            header('Location:admin.php');
        } catch (PDOException $error) {
            echo "Erreur : " . $error->getMessage();
        }
    }
?>

<section id="editcategory">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <h1 class="block">Modification d'une catégorie</h1>
                    <?php require 'inc/alert.php' ?>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="inputName" required>Nom de la catégorie</label>
                            <input class="input" type="text" name="name" id="inputName" value="<?php echo $category['name']?>" required>
                        </div>
                        <hr>
                        <div class="field">
                            <input class="button block" type="submit" name="submit" value="Modifier la catégorie">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('inc/footer.php'); ?>