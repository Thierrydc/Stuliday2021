<?php include('inc/header.php'); ?>

<p style="color:red; font-size:20px; font-weigh:bold">

<?php
    $alert = false;
    // Vérification intro
    if(!empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2']) && !empty($_POST['username']) &&  isset($_POST['submit'])){
        // Initialisation variables
        $email = htmlspecialchars($_POST['email']);
        $password1 = htmlspecialchars($_POST['password1']);
        $password2 = htmlspecialchars($_POST['password2']);
        $username = htmlspecialchars($_POST['username']);
        
        try {
            // filtre format d'email
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){  
                // Vérification email dans la BDD : Pour que l'email ne soit pas existant
                $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
                $resultMail = $connect->query($sqlMail);
                $countMail = $resultMail->fetchColumn();
                if(!$countMail){  
                    // Vérification username dans la BDD : Pour que l'username ne soit pas existant
                    $sqlUsername = "SELECT * FROM users WHERE name = '{$username}'";
                    $resultUsername = $connect->query($sqlUsername);
                    $countUsername = $resultUsername->fetchColumn();
                    if(!$countUsername){
                        // Vérification mdp : Concordance password
                        if($password1 === $password2){
                            // Hashage du mdp : Crypter le mot de passe
                            $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                            // Enregistrement données utilisateur
                            $sth = $connect->prepare("INSERT INTO users (email,name,password) VALUES (:email,:username,:password)");
                            // Assainissement des variables
                            $sth->bindValue(':email', $email);
                            $sth->bindValue(':username', $username);
                            $sth->bindValue(':password', $hashedPassword);
                            $sth->execute();
                            $alert = true; $type = "success"; $message = "L'utilisateur a bien été enregistré !";
                            // Ajout des messages d'erreur
                        } else {
                            $alert = true; $type = "warning"; $message = "Les mots de passe ne sont pas concordants !";
                            unset($_POST);
                        }
                    } else {
                        $alert = true; $type = "warning"; $message = "Ce nom d'utilisateur existe déja !";
                        unset($_POST);
                    }
                }else{
                    $alert = true; $type = "warning"; $message = "Un compte existe déja pour cette adresse mail !";
                    unset($_POST);
                }
            } else {
                $alert = true; $type = "warning"; $message = "L'adresse email saisie n'est pas valide !";
                unset($_POST);
            }
            
        } catch (PDOException $error) {
            echo 'Error: ' . $error->getMessage();
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

    // var_dump($email,$password1, $password2, $username);
?>
</p>


<div id="signin">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-4">
                <div class="content">
                    <h1 class="block">S'inscrire</h1>
                    <?php require 'inc/alert.php' ?>
                    <form action="#" method="post">
                        <div class="field">
                            <label for="InputEmail">Adresse mail</label>
                            <input class="input" type="text" name="email" id="InputEmail" required>
                        </div>
                        <div class="field">
                            <label for="InputUsername">Nom d'utilisateur</label>
                            <input class="input" type="text" name="username" id="InputUsername" required>
                        </div>
                        <div class="field">
                            <label for="InputPassword">Choisissez un mot de passe</label>
                            <input class="input" type="password" name="password1" id="InputPassword" required>
                        </div>
                        <div class="field">
                            <label for="InputPassword2">Entrez votre mot de passe de nouveau</label>
                            <input class="input" type="password" name="password2" id="InputPassword2" required>
                        </div>
                        <div class="field">
                            <input class="button block" type="submit" name="submit" value="S'inscrire">
                        </div>
                    </form>
                    <hr>
                    <div id="login">
                        <p>Déja inscrits ?<a href="./login.php">Connectez-vous ici</a></p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>




    
<?php include('inc/footer.php'); ?>