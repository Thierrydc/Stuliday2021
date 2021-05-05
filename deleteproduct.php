<?php include('inc/config.php'); ?>

<?php

$alert=false;
$productId = $_GET['id'];
if(!empty($_SESSION)) {
    try {
        $user_id = $_SESSION['id'];
        $sth = $connect->query("SELECT id, author_id FROM biens WHERE id='{$productId}' ");
        $product = $sth->fetch(PDO::FETCH_ASSOC);

        $isAuthor = $user_id == $product['author_id'];
        $isAdmin = $connect->query("SELECT role FROM users WHERE id={$user_id} AND role='ROLE_ADMIN'")->fetchColumn();
        
        if($isAdmin OR $isAuthor) {
            // $connect->query("DELETE FROM biens WHERE id={$productId}");
            $alert = true; $type = "success"; $message = "L'annonce à bien été supprimée";
        } else {
            $alert = true; $type = "danger"; $message = "Vous n'avez pas l'autorisation de suppression !";
        }

    } catch (PDOException $error) {
        echo "Erreur : " . $error->getMessage();
    }

}
?>

<?php require 'inc/alert.php' ?>