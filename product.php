<?php include('inc/header.php'); ?>

<?php
try {
    //? J'insère la valeur de l'id de ma requête GET dans une variable qui va me servir à récupérer un produit depuis la BDD
    $id = $_GET['id'];

    //? Création de ma requête SQL. Vu que j'ai des colonnes qui font référence à d'autres tables, je dois ajouter des jointures sur category et author. Je rajoute aussi la condition WHERE products_id = {$id} afin de récupérer le produit souhaité
    $sth = $connect->query(
        "SELECT title, description, bedroom_number, surface, price, c.name as category
        FROM biens as b
        LEFT JOIN categories as c ON b.category_id = c.id
        WHERE b.id = {$id}
    ");

    //? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.
    $annonce = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $error->message();
}


?>

<!-- //? Ici pas besoin de boucle, puisque je ne récupère qu'un seul produit. -->
<section id="product">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-8">
                <div class="content">
                    <h1 class="block"><?php echo $annonce['title']; ?></h1>
                    <img class="block" src="./assets/img/maison.jpg" alt="photo de la maison">
                    <p>A propos : <?php echo $annonce['description']; ?></p>
                    <p>Nombre de chambres : <?php echo $annonce['bedroom_number']; ?></p>
                    <p>Surface en m2 : <?php echo $annonce['surface']; ?></p>
                    <p>Prix de la location à la semaine : <?php echo $annonce['price']; ?></p>
                    <p>Catégorie du bien : <?php echo $annonce['category']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('inc/footer.php'); ?>