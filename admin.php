<?php include('inc/header.php'); ?>

<?php
    $alert=false;
    if(!empty($_SESSION['name'])) {
        try {
            $user_id = $_SESSION['id'];
            $isAdmin = $connect->query("SELECT * FROM users WHERE id = {$user_id} AND role = 'ROLE_ADMIN'")->fetch(PDO::FETCH_ASSOC);

            if($isAdmin) {
                $users = $connect->query("SELECT * FROM users WHERE id != '{$user_id}'")->fetchAll(PDO::FETCH_ASSOC);

                $sth = $connect->query(
                    "SELECT b.id, title, photo, c.name as category, bedroom_number, surface, price
                    FROM biens as b
                    LEFT JOIN categories as c ON b.category_id=c.id
                    LEFT JOIN users as u ON b.author_id = u.id
                    ");
                $biens = $sth->fetchAll(PDO::FETCH_ASSOC);
                $categories = $connect->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="admin">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <div class="content">
                    <?php require 'inc/alert.php' ?>
                    <!--------------------  SECTION USERS -------------------->
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
                                            <td>
                                                <form action="delete.php" method="post">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                                                    <input type="hidden" name="table" value="users">
                                                    <input type="submit" class="button" value="delete" name="delete">
                                                </form>
                                            </td>
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

                    <!--------------------  SECTION LOCATIONS -------------------->
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
                                            <td><a href="editproduct.php?id=<?php echo $bien['id']; ?>" class="button">Modify</a></td>
                                            <!-- <td><a href="deleteproduct.php?id=<?php echo $bien['id']; ?>" class="button">Delete</a></td> -->
                                            <td>
                                                <form action="delete.php" method="post">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $bien['id'] ?>">
                                                    <input type="hidden" name="table" value="biens">
                                                    <input type="submit" class="button" value="delete" name="delete">
                                                </form>
                                            </td>
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
                    
                    <!--------------------  SECTION CATEGORIES -------------------->
                    <section class="users-table container">
                        <div class="columns is-centered">
                            <div class="column is-12">
                                <div class="content">
                                    <h2>Categories</h2><a href="addcategories.php" class="button">Add</a>
                                    <table class="table is-striped">
                                        <thead>
                                            <tr>
                                                <th># id</th>
                                                <th>Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                        foreach ($categories as $category) {
                                    ?>
                                        <tr>
                                            <th><?php echo $category['id']?></th>
                                            <td><?php echo $category['name']?></td>
                                            <td><a href="editcategory.php?id=<?php echo $category['id'] ?>" class="button">Modify</a></td>
                                            <td>
                                                <form action="delete.php" method="post">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $category['id'] ?>">
                                                    <input type="hidden" name="table" value="categories">
                                                    <input type="submit" class="button" value="delete" name="delete">
                                                </form>
                                            </td>
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

                </div>
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