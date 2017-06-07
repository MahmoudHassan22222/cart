<?php
$title = 'Control Panel';
session_start();
if (isset($_SESSION['username'])){
    require 'includes/init.php';

    // Query from table users
    $stmnt = $conn->prepare("SELECT COUNT(id) FROM users");
    $stmnt->execute();
    $counts_client = $stmnt->fetch();
    // Query from table categories
    $stmnt = $conn->prepare("SELECT COUNT(id) FROM cat");
    $stmnt->execute();
    $counts_cat = $stmnt->fetch();
    // Query from table products
    $stmnt = $conn->prepare("SELECT COUNT(id) FROM products");
    $stmnt->execute();
    $counts_product = $stmnt->fetch();
}else{
    header('Location: index.php');
}
?>
<h1 class="text-center">Home Page Panel</h1>
<div class="hpage container">
    <div class="row">
        <div class="col-ms-12 col-lg-4">
            <div class="clients-count all-counts">
                <p class="text-right">CLIENTS</p>
                <i class="fa fa-users"></i>
                <span class="counts"><?php echo $counts_client['COUNT(id)'] ?></span>
            </div>
        </div>

        <div class="col-ms-12 col-lg-4">
            <div class="cats-count all-counts">
                <p class="text-right">CATEGORIES</p>
                <i class="fa fa-th-list"></i>
                <span class="counts"><?php echo $counts_cat['COUNT(id)'] ?></span>
            </div>
        </div>

        <div class="col-ms-12 col-lg-4">
            <div class="products-count all-counts">
                <p class="text-right">PRODUCTS</p>
                <i class="fa fa-bath"></i>
                <span class="counts"><?php echo $counts_product['COUNT(id)'] ?></span>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary p-cat">
                <div class="panel-heading">LAST 10 CATEGORIES</div>
                <div CLASS="panel-body">
                    <?php
                        $stmnt = $conn->prepare("SELECT * FROM cat ORDER BY id DESC LIMIT 10");
                        $stmnt->execute();
                        $rows = $stmnt->fetchAll();
                        foreach ($rows as $row){
                            echo '<p>';
                                echo $row['cat_name'];
                            echo '</p>';
                        }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-danger p-users">
                <div class="panel-heading">LAST 10 CLIENTS</div>
                <div CLASS="panel-body">
                    <?php
                    $stmnt = $conn->prepare("SELECT * FROM users WHERE user_group = 0 ORDER BY id DESC LIMIT 10");
                    $stmnt->execute();
                    $rows = $stmnt->fetchAll();
                    foreach ($rows as $row){
                        echo '<p>';
                        echo $row['username'];
                        echo '</p>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'includes/theme/footer.php'; ?>