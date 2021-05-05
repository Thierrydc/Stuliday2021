<?php include('inc/header.php'); ?>

<?php

$alert=false;
$productId = $_POST['id'];
$token = $_POST['csrf_token'];
if(isset($_POST['delete']) && $_POST['csrf_token'] == $token) {
    try {
        $user_id = $_SESSION['id'];
        $sth = $connect->query("SELECT id, author_id FROM biens WHERE id='{$productId}' ");
        $product = $sth->fetch(PDO::FETCH_ASSOC);
        
        $isAuthor = $user_id == $product['author_id'];
        $isAdmin = $connect->query("SELECT role FROM users WHERE id={$user_id} AND role='ROLE_ADMIN'")->fetchColumn();

        if($isAdmin OR $isAuthor) {
            // $connect->query("DELETE FROM biens WHERE id={$productId}");
            $alert = true; $type = "success"; $message = "L'annonce a bien été supprimée";
        } else {
            $alert = true; $type = "danger"; $message = "Vous n'avez pas l'autorisation de suppression !";
        }

    } catch (PDOException $error) {
        $alert=true; $type="warning"; $error->getMessage();
    }

}
?>

<section id="addproducts">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <?php require 'inc/alert.php' ?>
                </div>
            </div>
        </div>
    </div>
</section>