<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cart admin</title>

    <!-- Bootstrap -->
    <link href="theme/css/bootstrap.min.css" rel="stylesheet">

    <!-- font-awesome -->
    <link rel="stylesheet" href="theme/css/font-awesome.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="theme/css/style.css">

    <!-- Fonts Google -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">MATGRY</a>
            <?php
                if (isset($_SESSION['user'])){
                    echo "<ul class='nav navbar-nav navbar-left nav_profile'>";
                    $users = $conn->prepare("SELECT * FROM users WHERE username = :xusers");
                    $users->execute(array(
                            ':xusers' => $_SESSION['user']
                    ));
                    $u_rows = $users->fetch();
                    if (empty($u_rows['avatars'])){
                        echo "<img src='images/avatar.png'>";
                    }else{
                        echo "<img src='admin/uploads/avatars/" . $u_rows['avatars'] . "'>";
                    }
                    echo "<li><a><span class='profile_usr'>" ."Welcome " . strtoupper($_SESSION['user']) . "</span></a></li>";
                    echo "</ul>";
                    echo '<a href="profile.php">Profile</a>';
                    echo "<span><a href='logout.php'>logout</a></a></span>";
                }else{
                    echo '<a class="pull-right login-page btn btn-primary" href="login.php">Login</a>';
                }
            ?>


        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php
                    foreach (getCat() as $data){
                        echo '<li><a href="categories.php?id=' . $data['id'] . '&name=' . str_replace(' ', '-', $data['cat_name']) . '">' . $data['cat_name'] . '</a></li>';
                    }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
