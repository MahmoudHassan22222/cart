<?php
session_start();
if (isset($_SESSION['user'])){
    header('Location: index.php');
    exit();
}
require 'includes/init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashPass = sha1($password);
    $smtn = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $smtn->execute(array($username, $hashPass));
    $row = $smtn->rowCount();
    if ($row > 0){
        $_SESSION['user'] = $_POST['user'];
        header('Location: index.php');
        exit();
    }else{
        echo '<p class="text-center alert-danger error-login">User name OR Password incorrect</p>';
    }
}
?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <h1 class="text-center">LOGIN PANEL</h1>
    <input class="form-control input-lg" type="text" name="user" placeholder="Type user name">
    <input class="form-control input-lg" type="password" name="pass" placeholder="Type password">
    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login" name="submit">
    <h3>New User <span><a href="register.php">SIGN UP</a></span></h3>
</form>
