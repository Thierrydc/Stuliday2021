<?php include('inc/header.php'); ?>

<?php
    //? J'insère la valeur de l'id de ma requête GET dans une variable qui va me servir à récupérer un produit depuis la BDD
    //? Création de ma requête SQL. Vu que j'ai des colonnes qui font référence à d'autres tables, je dois ajouter des jointures sur category et author. Je rajoute aussi la condition WHERE products_id = {$id} afin de récupérer le produit souhaité
    //? Le résultat de ma requête est affiché dans un tableau associatif à l'aide du chaînage de méthodes.


?>

<!-- //? Ici pas besoin de boucle, puisque je ne récupère qu'un seul produit. -->
<div id="product">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-4">
                <div class="content">
                    <h1 class="block"><?php echo $product['title']; ?></h1>
                    <p>A propos : <?php echo $product['description']; ?></p>
                    <p>Nombre de chambres : <?php echo $product['bedroom_number']; ?></p>
                    <p>Surface en m2 : <?php echo $product['surface']; ?></p>
                    <p>Prix de la location à la semaine : <?php echo $product['price']; ?></p>
                    <p>Catégorie du bien : <?php echo $product['category']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>