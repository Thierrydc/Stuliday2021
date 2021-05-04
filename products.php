<?php include('inc/header.php'); ?>

<?php
//! Affichage de tous les produits. Il faudra une requête SQL qui récupère tous les produits, et qui les affiche dans des cartes séparées.

try {
    //? Création de ma requête SQL. Vu que j'ai des colonne qui font référence à d'autres tables, je dois ajouter des jointures sur category et author.
    $sth = $connect->query(
    "SELECT b.id, title, photo, c.name as category, bedroom_number, surface, price
    FROM biens as b
    LEFT JOIN categories as c ON b.category_id=c.id
    LEFT JOIN users as u ON b.author_id = u.id
    ");

    //? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
    $locations = $sth->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $error) {
    echo $error->getMessage();
}

?>

<h1>Recherche annonces</h3>

<section id="products">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-flex is-flex-wrap-wrap">
                <!-- <div class=""> -->
                    <?php
                        foreach ($locations as $location) {
                    ?>
                    <div class="card content">
                        <a href="product.php?id=<?php echo $location['id'] ?>">
                            <div class="card-content">
                                <h5><?php echo $location['title'] ?></h5>
                                <img class="block" src="./assets/img/<?php echo $location['photo']?>" alt="photo de la maison">
                                <p>Catégorie du bien : <?php echo $location['category'] ?></p>
                                <p>Nombre de chambres : <?php echo $location['bedroom_number'] ?></p>
                                <p>Surface en m2 : <?php echo $location['surface'] ?>m2</p>
                                <p>Prix de la location à la semaine : <?php echo $location['price'] ?>€</p>
                            </div>
                        </a>
                    </div>

                    <?php
                        }
                    ?>
                    
                <!-- </div> -->
            </div>
        </div>
    </div>
</section>

<?php include('inc/footer.php'); ?>