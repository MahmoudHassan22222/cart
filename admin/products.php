<?php
session_start();
if (isset($_SESSION['username'])){
    require 'includes/init.php';

    //

    $product = '';
    if (isset($_GET['prod'])){
        $product = $_GET['prod'];
    }else{
        $product = 'Manage';
    }
    // pages products
    if ($product == 'Add'){?>
        <form class="cat-add" action="?prod=Insert" method="post" enctype="multipart/form-data">
            <h1 class="text-center">ADD PRODUCT</h1>
            <input class="form-control input-lg" type="text" name="productName" placeholder="Product Name">
            <textarea class="form-control" name="productDesc" placeholder="Type Description about product"></textarea>
            <select class="form-control input-lg" name="usr-prod">
                <?php
                $stmnt = $conn->prepare("SELECT * FROM users");
                $stmnt->execute();
                $row = $stmnt->fetchAll();
                foreach ($row as $rows){
                    echo "<option value='" . $rows['id'] . "'>" . $rows['username'] . "</option>";
                }
                ?>
            </select>
            <select class="form-control input-lg" name="cat-prod">
                    <?php
                        $stmnt = $conn->prepare("SELECT * FROM cat");
                        $stmnt->execute();
                        $row = $stmnt->fetchAll();
                        foreach ($row as $rows){
                            echo "<option value='" . $rows['id'] . "'>" . $rows['cat_name'] . "</option>";
                        }
                    ?>
            </select>
            <input type="file" class="form-control" name="images2">
            <input type="submit" class="btn btn-primary btn-lg btn-block" value="ADD PRODUCT">
        </form>
    <?php }elseif ($product == 'Insert'){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $prodname = $_POST['productName'];
            $prodesc = $_POST['productDesc'];
            $usrprod = $_POST['usr-prod'];
            $catprod = $_POST['cat-prod'];

            // Upload Files
            $images_ads = $_FILES['images2'];
            $prod_images_name = $_FILES['images2']['name'];
            $prod_images_type = $_FILES['images2']['type'];
            $prod_images_tmp = $_FILES['images2']['tmp_name'];
            $prod_images_size = $_FILES['images2']['size'];

            // Ext. Files
            $ext_files = array("jpeg", "jpg", "gif", "png", "zip", "txt");
            $checkExt = strtolower(end(explode('.', $prod_images_name)));


            if (in_array($checkExt, $ext_files)) {
                $rndm = rand(1, 100000) . '_' . $prod_images_name;
                move_uploaded_file($prod_images_tmp, "uploads\prod_images\\" . $rndm);

                // Insert into products table
                $stmnt = $conn->prepare("INSERT INTO products SET 
                                    prod_name = :vname, prod_desc = :vdesc, prod_user = :vuser, prod_cat = :vcat, date_created = now(), images = :zimg");
                $stmnt->execute(array(
                    ':vname' => $prodname,
                    ':vdesc' => $prodesc,
                    ':vuser' => $usrprod,
                    ':vcat' => $catprod,
                    ':zimg' => $rndm
                ));
                $row = $stmnt->rowCount();
                if ($row > 0) {
                    echo "<h1 class='text-center alert-success'>Product added successful</h1>";
                    redirect(3, 'back');
                }
            }else{echo 'no';}
        }
    }elseif ($product == 'Edit'){

        $product_id = '';
        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $product_id = $_GET['id'];
        }else{
            $product_id = 0;
        }
        $stmnt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmnt->execute(array($product_id));
        $row = $stmnt->fetch();


        ?>
        <form class="cat-add" action="?prod=Edit" method="post">
            <h1 class="text-center">Edit PRODUCT</h1>
            <input type="hidden" name="id" value="<?php echo $product_id ?>">
            <input class="form-control input-lg" type="text" name="pname" value="<?php echo $row['prod_name'] ?>">
            <textarea class="form-control" name="pdesc" value="<?php echo $rows['prod_desc'] ?>"></textarea>
            <select class="form-control input-lg" name="puser">
                <?php
                $stmnt = $conn->prepare("SELECT * FROM users");
                $stmnt->execute();
                $row = $stmnt->fetchAll();
                foreach ($row as $rows){
                    echo "<option value='" . $rows['id'] . "'>" . $rows['username'] . "</option>";
                }
                ?>
            </select>
            <select class="form-control input-lg" name="pcat">
                <?php
                $stmnt = $conn->prepare("SELECT * FROM cat");
                $stmnt->execute();
                $row = $stmnt->fetchAll();
                foreach ($row as $rows){
                    echo "<option value='" . $rows['id'] . "'>" . $rows['cat_name'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" class="btn btn-primary btn-lg btn-block" value="UPDATE PRODUCT">
        </form>
    <?php }elseif($product == 'Manage'){
$stmnt = $conn->prepare("SELECT products.*, users.username, cat.cat_name FROM products INNER JOIN (users, cat) ON (products.prod_user = users.id AND products.prod_cat = cat.id);");
$stmnt->execute();
$ftch = $stmnt->fetchAll();

?>
<div class="container">
    <h1 CLASS="text-center">PRODUCTS MANAGEMENT</h1>
    <a class="btn btn-primary btn-lg btn-add" href="?prod=Add">ADD NEW PRODUCT</a>
    <table class="table table-bordered text-center table-responsive mng">
        <tr class="frow">
            <td>Product Name</td>
            <td>Product Image</td>
            <td>User Name</td>
            <td>Category</td>
        </tr>
        <?php
        foreach ($ftch as $ftchs){
            echo '<tr>';
            echo "<td>" . $ftchs['prod_name'] . "</td>";
            echo '<td>';
            if (empty($ftchs['images'])){
                echo "<img src='../images/avatar.png'>";
            }else{
                echo "<img src='uploads/prod_images/" . $ftchs['images'] . "'>";
            }
            echo '</td>';
            echo '<td>';
            echo $ftchs['username'];
            echo '</td>';
            // Actions
            echo '<td>';
            echo $ftchs['cat_name'];
            echo '</td>';
            echo '</tr>';
        }
        ?>

    </table>
</div>
   <?php }



}else{
    header('location: index.php');
}