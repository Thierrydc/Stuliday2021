<?php include('inc/header.php'); ?>

<?php

$alert=false;
$table = $_POST['table'];
$itemId = $_POST['id'];
$token = $_POST['csrf_token'];

if(isset($_POST['delete']) && $_POST['csrf_token'] == $token) {
    try {
        $user_id = $_SESSION['id'];
        $sth = $connect->query("SELECT id, author_id FROM biens WHERE id='{$itemId}' ");
        $product = $sth->fetch(PDO::FETCH_ASSOC);
        
        $isAuthor = $user_id == $product['author_id'];
        $isAdmin = $connect->query("SELECT COUNT(role) FROM users WHERE id={$user_id} AND role='ROLE_ADMIN'")->fetchColumn();

        if($isAdmin) {
            $sth = $connect->prepare("DELETE FROM {$table} WHERE id={$itemId}");
            // $sth->execute();
            $alert = true; $type = "success"; $message = "L'entité a bien été supprimée";
        } elseif($isAuthor) {
            $sth->prepare("DELETE FROM biens WHERE id={$itemId}");
            // $sth->execute();
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