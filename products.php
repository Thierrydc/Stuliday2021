<?php include('inc/header.php'); ?>

<?php
//! Affichage de tous les produits. Il faudra une requête SQL qui récupère tous les produits, et qui les affiche dans des cartes séparées.

//? Création de ma requête SQL. Vu que j'ai des colonne qui font référence à d'autres tables, je dois ajouter des jointures sur category et author.
$sth = $connect->query(
    "SELECT title, c.name as category, bedroom_number, surface, price
    FROM biens as b 
    LEFT JOIN categories as c ON b.category_id=c.id
    LEFT JOIN users as u ON b.author_id = u.id
    ");

//? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
$locations = $sth->fetchAll(PDO::FETCH_ASSOC);
// var_dump($locations);
?>


<div id="products">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-4">
                <div class="content">
                    <?php
                        foreach ($locations as $location) {
                    ?>
                            <div class="card">
                            <h5><?php echo $location['title'] ?></h5>
                            <p>Catégorie du bien : <?php echo $location['category'] ?></p>
                            <p>Nombre de chambres : <?php echo $location['bedroom_number'] ?></p>
                            <p>Surface en m2 : <?php echo $location['surface'] ?>m2</p>
                            <p>Prix de la location à la semaine : <?php echo $location['price'] ?>€</p>
                            </div>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>