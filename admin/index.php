<?php
session_start();
if (isset($_SESSION['username'])){
    header('Location: home.php');
    exit();
}
$noNav = '';
require 'includes/init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $email = $_POST['username'];
    $pass = $_POST['password'];
    $hashPass = sha1($pass);
    $smtn = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? AND password = ? AND user_group = 1");
    $smtn->execute(array($user, $email, $hashPass));
    $ftch = $smtn->fetch();
    $row = $smtn->rowCount();
    if ($row > 0){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['id'] = $ftch['id'];
        header('Location: home.php');
        exit();
    }else{
        echo '<p class="text-center alert-danger error-login">User name OR Password incorrect</p>';
    }
}
?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <h1 class="text-center">CONTROL PANEL</h1>
    <input class="form-control input-lg" type="text" name="username" placeholder="Type user name OR email">
    <input class="form-control input-lg" type="password" name="password" placeholder="Type password">
    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login" name="submit">
</form>
