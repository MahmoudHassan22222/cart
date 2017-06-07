<?php
session_start();
require 'includes/init.php';
$products_id = $_GET['id'];
$ads = $conn->prepare("SELECT * FROM products WHERE id = :vid");
$ads->execute(array(
    ':vid' => $products_id
));
$ads_rows = $ads->fetch();
?>
<div class="container text-center">
    <h1><?php echo $ads_rows['prod_name'] ?></h1>
    <?php
    echo "<img src='admin/uploads/prod_images/" . $ads_rows['images'] . "'>";
    ?>
    <p><?php echo $ads_rows['prod_desc'] ?></p>
</div>
