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
            <a class="navbar-brand" href="index.php">CONTROL PANEL</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">HOME <span class="sr-only">(current)</span></a></li>
                <li><a href="categories.php">CATEGORIES</a></li>
                <li><a href="clients.php">CLIENTS</a></li>
                <li><a href="products.php">PRODUCTS</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="btn btn-danger home-site" target="_blank" href="../index.php">Visit Shop</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="clients.php?user=Edit&id=<?php echo $_SESSION['id']; ?>">Profile</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>