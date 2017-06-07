<?php
ob_start();
session_start();
require 'includes/init.php';
?>
<div class="container text-center">

    <h1><?php echo str_replace('-', ' ', strtoupper($_GET['name'])) ?></h1>

    <div class="row">
        <?php
            $products = getProd('prod_cat');
            foreach ($products as $product){
                echo "<div class='col-sm-3'>";
                echo "<div class='thumbnail'>";
                echo "<img src='images/avatar.png'>";
                echo "<div class='caption'>";
                echo "<h3>" . strtoupper($product['prod_name']) . "</h3>";
                echo $product['prod_desc'];
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        ?>

    </div>

</div>

<?php
    require 'includes/theme/footer.php';
    ob_end_flush();
?>
