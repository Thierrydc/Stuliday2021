<?php include('inc/header.php'); ?>

<?php
    $alert=false;
    if(!empty($_SESSION)) {
        try {
            $user_id = $_SESSION['id'];
            $sth = $connect->query("SELECT * FROM users WHERE id = {$user_id} AND role = 'ROLE_ADMIN'");
            // $isAdmin = $sth->fetch(PDO::FETCH_ASSOC);
            if($isAdmin = $sth->fetch(PDO::FETCH_ASSOC)) {
                $sth = $connect->query("SELECT * FROM users WHERE id != '{$user_id}'");
                $users = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
            
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-12">
                        <div class="content">
                            <table class="table is-striped">
                                <thead>
                                    <tr>
                                        <th># id</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                                foreach ($users as $user) {
                            ?>
                                <tr>
                                    <th><?php echo $user['id'] ?></th>
                                    <td><?php echo $user['name'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['role'] ?></td>
                                    <td>Modifier</td>
                                    <td>Supprimer</td>
                                </tr>
                            <?php
                                }
                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<?php
            } else {
                require 'inc/404.php';
            }

        } catch (PDOException $error) {
            $error=true; $type="danger"; $message = $error->message();
        }

    } else {
        require 'inc/404.php';
    }

?>