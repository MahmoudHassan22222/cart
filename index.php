<?php
// Session Start
session_start();
require 'includes/init.php';
?>
<div class="container">
    <div class="lastAndPanel">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">LAST PRODUCTS</div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            $ads = $conn->prepare("SELECT * FROM products ORDER BY date_created DESC LIMIT 9");
                            $ads->execute(array());
                            $ads_rows = $ads->fetchAll();
                            foreach ($ads_rows as $row){
                                echo "<div class='col-sm-4'>";
                                echo "<div class='thumbnail'>";
                                if (empty($row['images'])){
                                    echo "<img src='images/avatar.png'>";
                                }else{
                                    echo "<img src='admin/uploads/prod_images/" . $row['images'] . "'>";
                                }
                                echo "<div class='caption'>";
                                    echo "<h3><a href='products.php?id=" . $row['id'] . "'>" . strtoupper($row['prod_name']) . "</a></h3>";

                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="lastAndPanel">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Accessories</div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            $ads = $conn->prepare("SELECT * FROM products WHERE prod_cat = 14 ORDER BY date_created DESC LIMIT 3");
                            $ads->execute(array());
                            $ads_rows = $ads->fetchAll();
                            foreach ($ads_rows as $row){
                                echo "<div class='col-sm-4'>";
                                echo "<div class='thumbnail'>";
                                echo "<img src='images/avatar.png'>";
                                echo "<div class='caption'>";
                                echo "<h3>" . strtoupper($row['prod_name']) . "</h3>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="lastAndPanel">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">Mobiles</div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            $ads = $conn->prepare("SELECT * FROM products WHERE prod_cat = 11 ORDER BY date_created DESC LIMIT 3");
                            $ads->execute(array());
                            $ads_rows = $ads->fetchAll();
                            foreach ($ads_rows as $row){
                                echo "<div class='col-sm-4'>";
                                echo "<div class='thumbnail'>";
                                echo "<img src='images/avatar.png'>";
                                echo "<div class='caption'>";
                                echo "<h3>" . strtoupper($row['prod_name']) . "</h3>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
require 'includes/theme/footer.php';
?>
