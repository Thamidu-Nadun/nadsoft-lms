<div class="col-lg-6 m-b30">
    <div class="widget-box">
        <div class="wc-title">
            <h4>New Users</h4>
        </div>
        <div class="widget-inner">
            <div class="new-user-list">
                <ul>
                    <?php
                    $statement = $pdo->prepare('SELECT * FROM student;');
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach ($result as $row) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $status = $row['status'];
                        $image_url = $row['avatar'];

                        ?>
                        <li>
                            <span class="new-users-pic">
                                <img src="<?php echo $image_url; ?>" alt="" />
                            </span>
                            <span class="new-users-text">
                                <a href="/profile.php?id=<?php echo $email; ?>" class="new-users-name"><?php echo $name; ?> </a>
                                <span class="new-users-info"><?php echo $email; ?></span>
                            </span>
                            <span class="new-users-btn">
                                <a href="/profile.php?id=<?php echo $email; ?>" class="btn button-sm outline">Follow</a>
                            </span>
                        </li>
                        <?php
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>