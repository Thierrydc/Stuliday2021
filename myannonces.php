<?php include('inc/header.php'); ?>

<?php
    $alert=false;
    if(!empty($_SESSION)) {
        try {
            $user_id = $_SESSION['id'];
            $isUser = $connect->query("SELECT * FROM users WHERE id = {$user_id}")->fetchcolumn();

            if($isUser) {
                $sth = $connect->query(
                    "SELECT b.id, title, photo, c.name as category, bedroom_number, surface, price
                    FROM biens as b
                    LEFT JOIN categories as c ON b.category_id=c.id
                    LEFT JOIN users as u ON b.author_id = u.id
                    WHERE b.author_id = {$user_id}
                    ");
                $biens = $sth->fetchAll(PDO::FETCH_ASSOC);
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
                        <td><a href="editproduct.php?id=<?php echo $bien['id']; ?>" class="button">Modify</a></td>
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