<?php include('inc/header.php'); ?>


<!------------------------------------------ SECTION USERS ----------------------------------------------->
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

    
<section class="users-table container">
    <div class="columns is-centered">
        <div class="column is-12">
            <div class="content">
                <h2>Users</h2>
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
                        <td><span class="button">Modify</span></td>
                        <td><span class="button">Delete</span></td>
                    </tr>
                <?php
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

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


<!------------------------------------------ SECTION BIENS ----------------------------------------------->
<?php
    $alert=false;
    if(!empty($_SESSION)) {
        try {
            $user_id = $_SESSION['id'];
            $sth = $connect->query("SELECT * FROM users WHERE id = {$user_id} AND role = 'ROLE_ADMIN'");
            // $isAdmin = $sth->fetch(PDO::FETCH_ASSOC);
            if($isAdmin = $sth->fetch(PDO::FETCH_ASSOC)) {
                $sth = $connect->query(
                    "SELECT b.id, title, photo, c.name as category, bedroom_number, surface, price
                    FROM biens as b
                    LEFT JOIN categories as c ON b.category_id=c.id
                    LEFT JOIN users as u ON b.author_id = u.id
                    ");
                $biens = $sth->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($biens);
?>


<section class="users-table container">
    <div class="columns is-centered">
        <div class="column is-12">
            <div class="content">
                <h2>Locations</h2>
                <table class="table is-striped">
                    <thead>
                        <tr>
                            <th># id</th>
                            <th>Title</th>
                            <th>Photo</th>
                            <th>Category</th>
                            <th>Bedroom number</th>
                            <th>Surface</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    foreach ($biens as $bien) {
                ?>
                    <tr>
                        <th><?php echo $bien['id']?></th>
                        <td><?php echo $bien['title']?></td>
                        <td><?php echo $bien['photo']?></td>
                        <td><?php echo $bien['category']?></td>
                        <td><?php echo $bien['bedroom_number']?></td>
                        <td><?php echo $bien['surface']?></td>
                        <td><?php echo $bien['price']?></td>
                        <td><span class="button">Modify</span></td>
                        <td><span class="button">Delete</span></td>
                    </tr>
                <?php
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

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