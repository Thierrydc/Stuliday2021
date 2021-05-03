<?php include('inc/header.php'); ?>

<?php
    $alert = false;
    if(!empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['submit'])){
        
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        
        try{
            $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
            $resultMail = $connect->query($sqlMail);
            $user = $resultMail->fetch(PDO::FETCH_ASSOC);
            
            if($user){
                $dbpassword = $user['password'];
                if(password_verify($password, $dbpassword)){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['name'] = $user['name'];

                    $alert = true; $type = "success"; $message = "Vous êtes désormais connecté";
                    unset($_POST);
                    header('Location: profile.php');
                } else {
                    $alert = true; $type = "warning"; $message = "Le mot de passe est erroné !";
                    unset($_POST);
                }
            }else{
                $alert = true; $type = "warning"; $message = "Ce compte n'existe pas !";
                unset($_POST);
            }
        } catch(PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }

    /** 
     * ! Etapes logiques de l'inscription
     * 
     * // TODO Vérification intro
     * 
     * //  TODO : Initialisation variables
     * 
     * // TODO Verification email : Nécessaire et intéressant, pas sûr qu'on le mette en place pour l'instant
     * 
     * // TODO Vérification email dans la BDD : Pour que l'email ne soit pas existant
     * 
     * // TODO Vérification username dans la BDD : Pour que l'username ne soit pas existant
     * 
     * // TODO Vérification mdp : Concordance password
     * 
     * // TODO Hashage du mdp : Crypter le mot de passe
     * 
     * // TODO Enregistrement données utilisateur
     * 
     * // TODO Assainissement des variables
     * 
     * // TODO Message d'erreur
     */

?>
</p>


<section id="login">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-6">
                <div class="content">
                    <h1 class="block">Se connecter</h1>
                    <?php require 'inc/alert.php' ?>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="InputEmail">Adresse mail</label>
                            <input class="input" type="email" name="email" id="InputEmail" required>
                        </div>
                        <div class="field">
                            <label for="InputPassword">Entrez votre mot de passe</label>
                            <input class="input" type="password" name="password" id="InputPassword" required>
                        </div>
                        <input class="button" type="submit" name="submit" value="Se connecter">
                    </form>
                    <hr>
                    <div id="signin">
                        <p>Vous ne possédez pas de compte ? <a href="./signin.php">Inscrivez-vous ici </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<?php include('inc/footer.php'); ?>