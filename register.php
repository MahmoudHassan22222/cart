<?php
session_start();
if (isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}
require 'includes/init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $mail = $_POST['email'];
    $name = $_POST['name'];
    $hashPass = sha1($pass);
    // Insert into user table
    $stmnt = $conn->prepare("INSERT INTO users SET username = :xuser, password = :xpass, fullname = :xname, email = :xmail");
    $stmnt->execute(array(
        ':xuser' => $user,
        ':xpass' => $hashPass,
        ':xname' => $name,
        ':xmail' => $mail
    ));
    $rows = $stmnt->rowCount();
    if ($rows > 0) {
        echo '<h3 class="alert-success text-center">Added Client Successful</h3>';
        $_SESSION['user'] = $user;
        //print_r($_SESSION);
        header('refresh:3, index.php');
    }
}
    ?>
<form class="form-clients login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <h1 class="text-center">ADD NEW CLIENT</h1>
    <input class="form-control input-lg" type="text" name="username" placeholder="User Name">
    <input class="form-control input-lg" type="password" name="password" placeholder="Type password">
    <input class="form-control input-lg" type="email" name="email" placeholder="Type your email">
    <input class="form-control input-lg" type="text" name="name" placeholder="First and last Name">
    <input class="btn btn-primary btn-block btn-lg" type="submit" name="submit" value="SIGN UP">
</form>
