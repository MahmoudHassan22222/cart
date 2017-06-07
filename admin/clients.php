<?php
session_start();
if (isset($_SESSION['username'])){
    require 'includes/init.php';

    $clients = '';
    if (isset($_GET['user'])){
        $clients = $_GET['user'];
    }else{
        $clients = 'Manage';
    }

    // Add - Edit - Delete - Manage Clients
    if ($clients == 'Add'){?>
        <form class="form-clients cat-add" action="?user=Insert" method="POST" enctype="multipart/form-data">
            <h1 class="text-center">ADD NEW CLIENT</h1>
            <input class="form-control" type="text" name="username" placeholder="User Name must be 6 CHAR or more">
            <input class="form-control" type="password" name="password" placeholder="Password must be 8 CHAR or more">
            <input class="form-control" type="email" name="email" placeholder="Valid your email">
            <input class="form-control" type="text" name="name" placeholder="First and last Name">
            <input type="file" class="form-control input-lg" name="avatars">
            <input class="btn btn-primary btn-block btn-lg" type="submit" name="submit" value="Add New Client">
        </form>
    <?php }elseif ($clients == 'Insert'){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $mail = $_POST['email'];
            $name = $_POST['name'];
            $hashPass = sha1($pass);

            // Upload files
            $avatar_f = $_FILES['avatars'];
            $avatar_name = $_FILES['avatars']['name'];
            $avatar_type = $_FILES['avatars']['type'];
            $avatar_tmp = $_FILES['avatars']['tmp_name'];
            $avatar_size = $_FILES['avatars']['size'];

            // Ext Files
            $extFiles = array("jpg2", "jpeg", "png", "txt");
            $checkExt = strtolower(end(explode('.', $avatar_name)));
            // Check if Ext Allow or no
            if (in_array($checkExt, $extFiles)) {
                $fileRandomName = rand(1, 100000000) . '_' . $avatar_name;
                move_uploaded_file($avatar_tmp, "uploads\avatars\\" . $fileRandomName);

                // Validate Forms

                // Insert into user table

                $stmnt = $conn->prepare("INSERT INTO users SET username = :xuser, password = :xpass, fullname = :xname, email = :xmail, avatars = :xavt");
                $stmnt->execute(array(
                    ':xuser' => $user,
                    ':xpass' => $hashPass,
                    ':xname' => $name,
                    ':xmail' => $mail,
                    ':xavt'  => $fileRandomName
                ));
                $rows = $stmnt->rowCount();
                if ($rows > 0) {
                    echo '<h3 class="alert-success text-center">Added Client Successful</h3>';
                    redirect(3, 'back');
                }
            }else{
                echo 'This Ext File not allowed';
            }



    }elseif ($clients == 'Edit'){

        $clients_id = '';
        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $clients_id = $_GET['id'];
        }else{
            $clients_id = 0;
        }
         // Query User Table
        $stmnt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmnt->execute(array($clients_id));
        $fetchss = $stmnt->fetchAll();
?>
        <form class="cat-edit" action="?user=Update" method="post">
        <?php
        foreach ($fetchss as $fetch){}

            ?>
            <h1 class="text-center">EDIT CLIENT</h1>
            <input type="hidden" name="id" value="<?php echo $clients_id ?>">
            <input class="form-control input-lg" type="text" name="username" value="<?php echo $fetch['username'] ?>">
            <input class="form-control input-lg" type="password" name="oldPassword" autocomplete="new-password">
            <input class="form-control input-lg" type="hidden" name="newPassword" value="<?php echo $fetch['password'] ?>">
            <input class="form-control input-lg" type="text" name="name" value="<?php echo $fetch['fullname'] ?>">
            <input class="form-control input-lg" type="email" name="email" value="<?php echo $fetch['email'] ?>">
            <input class="btn btn-danger btn-block btn-lg" type="submit" name="submit" value="UPDATE">
        </form>
    <?php }elseif ($clients == 'Update'){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $user = $_POST['username'];
            $oldpass = $_POST['oldPassword'];
            $newpass = $_POST['newPassword'];
            $name = $_POST['name'];
            $mail = $_POST['email'];

            $pass = '';
            if (empty($oldpass)){
                $pass = $newpass;
            }else{
                $pass = sha1($oldpass);
            }

            // Validation Form


                // Update users table

                $stmnt = $conn->prepare("UPDATE users SET 
                              username = :xusername, password = :xpassword, fullname = :xfullname, email = :xemail WHERE id = :xid");
                $stmnt->execute(array(
                    ':xusername' => $user,
                    ':xpassword' => $pass,
                    ':xfullname' => $name,
                    ':xemail' => $mail,
                    ':xid' => $id
                ));
                $count = $stmnt->rowCount();
                echo $count;
            }
        }

    }elseif ($clients == 'Delete'){
        $clients_id = '';
        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $clients_id = $_GET['id'];
        }else{
            $clients_id = 0;
        }
        $stmnt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmnt->execute(array($clients_id));
        $rowCount = $stmnt->rowCount();
        echo $rowCount;
    }elseif ($clients == 'Active'){
        $clients_id = '';
        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $clients_id = $_GET['id'];
        }else{
            $clients_id = 0;
        }
        // update active user
        $stmnt = $conn->prepare("UPDATE users SET activated = 1 WHERE id = ?");
        $stmnt->execute(array($clients_id));
        $rowCount = $stmnt->rowCount();
        if ($rowCount > 0){
            echo '<h2 class="alert-success text-center">Client has Activated</h2>';
            redirect(3, 'back');
        }
    }elseif ($clients == 'Manage'){
        $stmnt = $conn->prepare("SELECT * FROM users");
        $stmnt->execute();
        $ftch = $stmnt->fetchAll();

        ?>
        <div class="container">
            <h1 CLASS="text-center">CLIENTS MANAGEMENT</h1>
            <a class="btn btn-primary btn-lg btn-add" href="?user=Add">ADD NEW CLIENT</a>
            <table class="table table-bordered text-center table-responsive mng">
                <tr class="frow">
                    <td>User Name</td>
                    <td>Full Name</td>
                    <td>Email</td>
                    <td>Edit && Delete</td>
                </tr>
                <?php
                foreach ($ftch as $ftchs){
                    echo '<tr>';
                        echo "<td><a href='clients.php?user=Edit&id=" . $ftchs['id'] . "'>" . $ftchs['username'] . "</td></a>";
                        echo '<td>';
                            echo $ftchs['fullname'];
                        echo '</td>';
                        echo '<td>';
                            echo $ftchs['email'];
                        echo '</td>';
                        // Actions
                        echo '<td>';
                            echo '<a class="btn btn-primary" href="?user=Edit&id= ' . $ftchs['id'] . '">EDIT</a>';
                            echo '<a class="btn btn-danger" href="?user=Delete&id= ' . $ftchs['id'] . '">DELETE</a>';
                            // Active user
                            if ($ftchs['activated'] == 0){
                                echo '<a class="btn btn-success" href="?user=Active&id= ' . $ftchs['id'] . '">ACTIVE</a>';
                            }
                        echo '</td>';
                    echo '</tr>';
                }
                ?>

            </table>
        </div>
   <?php }

    require 'includes/theme/footer.php';
    ob_end_flush();


}else{
    header('location: index.php');
}