<?php include('inc/header.php'); ?>

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