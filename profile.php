<?php
session_start();
require 'includes/init.php';
if (isset($_SESSION['user'])){?>
    <h1 class="text-center">MY PROFILE</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary informations">
                    <div class="panel-heading">Information</div>
                    <div class="panel-body">
                        <?php
                            $info = $conn->prepare("SELECT * FROM users WHERE username = ?");
                            $info->execute(array($_SESSION['user']));
                            $info_rows = $info->fetch();
                        echo "<h3>" . $info_rows['username'] . "</h3>";
                        echo "<h3>" . $info_rows['fullname'] . "</h3>";
                        echo "<h3>" . $info_rows['email'] . "</h3>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-success">
                    <div class="panel-heading">Information</div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            $ads = $conn->prepare("SELECT * FROM products WHERE prod_user = ? ORDER BY date_created DESC LIMIT 3");
                            $ads->execute(array($info_rows['id']));
                            $ads_rows = $ads->fetchAll();
                            foreach ($ads_rows as $row){
                                echo "<div class='col-sm-4'>";
                                echo "<div class='thumbnail'>";
                                echo "<img src='images/avatar.png'>";
                                echo "<div class='caption'>";
                                echo "<h3>" . strtoupper($row['prod_name']) . "</h3>";
                                echo $row['prod_desc'];
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

<?php }else{
    header('Location: login.php');
}