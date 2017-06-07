<?php
session_start();
$title = 'Categories Management';
if (isset($_SESSION['username'])){
    require 'includes/init.php';

    $cat = '';
    if (isset($_GET['cat'])){
        $cat = $_GET['cat'];
    }else{
        $cat = 'Manage';
    }

    // Add - Edit - Delete Categories

    if ($cat == 'Add'){ ?>
        <form class="text-center cat-add" action="?cat=Insert" method="POST">
            <h1>ADD CATEGORY</h1>
            <input class="form-control input-lg" type="text" name="cat-name" placeholder="Category Name">
            <input class="form-control input-lg" type="text" name="cat-desc" placeholder="Description of Category">
            <div class="status">
                <label id="showorhide">Show OR Hide</label>
                <input type="checkbox" name="status-box">
            </div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Add Category">
        </form>
    <?php }elseif ($cat == 'Insert'){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $catName = $_POST['cat-name'];
            $catDesc = $_POST['cat-desc'];
            $catCheck = $_POST['status-box'];
            $checked = "";
            if (isset($_POST['status-box'])){
                if ($_POST['status-box'] === 'on'){
                    $checked = 1;
                }
            }else{
                $checked = 0;
            }


            $stmnt = $conn->prepare("INSERT INTO cat SET cat_name = :zcat, cat_desc = :zdesc, status = :zstatus");
            $stmnt->execute(array(
                ':zcat' => $catName,
                ':zdesc' => $catDesc,
                ':zstatus' => $checked
            ));
            $row = $stmnt->rowCount();
            echo '<h3 class="alert-success text-center">';
                echo $catName . ' is registered';
            echo '</h3>';
            redirect(3, 'back');
        }
    }elseif ($cat == 'Edit'){

        $catId = '';
        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $catId = $_GET['id'];
        }else{
            $catId = 0;
        }
        $stmnt = $conn->prepare("SELECT * FROM cat WHERE id = ?");
        $stmnt->execute(array($catId));
        $row = $stmnt->fetchAll();
        $count = $stmnt->rowCount();
        if ($count > 0){?>
            <form class="cat-edit" action="?cat=Update" method="post">
            <?php
            foreach ($row as $rows){}
            ?>
            <h1 class="text-center">Edit Category</h1>
            <input class="form-control input-lg" type="hidden" name="id" value="<?php echo $catId ?>">
            <input class="form-control input-lg" type="text" name="cname" value="<?php echo $rows['cat_name']?>">
            <input class="form-control input-lg" type="text" name="cdescr" value="<?php echo $rows['cat_desc']?>">
                <div class="status">
                    <input id="showorhide" type="checkbox" name="status-check" value="<?php if ($rows['status'] == 1){echo '<input type="checkbox" name="status-check" checked="checked">'; }else{'<input type="checkbox" name="status-check">';} ?>">
                    <label for="showorhide">Show</label>
                </div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Edit Category">
            </form>
       <?php }else{
            header('location: index.php');
        }


        ?>

    <?php }elseif ($cat == 'Update'){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo '<h1 class="text-center">UPDATE CATEGORY</h1>';
            $catuId = $_POST['id'];
            $catUname = $_POST['cname'];
            $catDsc = $_POST['cdescr'];
            $chkValue = "";
            if (isset($_POST['status-check'])) {
                if ($_POST['status-check'] === "on"){
                    $chkValue = 0;
                }else{
                    $chkValue = 1;
                }

            }

            $stmnt = $conn->prepare("UPDATE cat SET cat_name = :ccname, cat_desc = :ccdesc, status = :ccstatus WHERE id = :ccid");
            $stmnt->execute(array(
                    ':ccname' => $catUname,
                    ':ccdesc' => $catDsc,
                    ':ccstatus' => $chkValue,
                    ':ccid' => $catuId

            ));
            $rowCount = $stmnt->rowCount();
            if ($rowCount > 0){
                echo '<h3 class="alert-success text-center">Update Done</h3>';
                redirect($seconds = 3, 'categories.php');
            }
        }
    }elseif ($cat == 'Delete'){
        $catId = '';
        if (isset($_GET['id']) && is_numeric($_GET['id'])){
            $catId = $_GET['id'];
        }else{
            $catId = 0;
        }
        $stmnt = $conn->prepare("DELETE FROM cat WHERE id = ?");
        $stmnt->execute(array($catId));
        $counts = $stmnt->rowCount();
        if ($counts > 0){
            echo '<h2 class="alert-warning text-center">Deleted Done</h2>';
            redirect(3, 'categories.php');
        }
    }elseif($cat == 'Manage'){

        $stmnt = $conn->prepare("SELECT * FROM cat");
        $stmnt->execute();
        $ftch = $stmnt->fetchAll();

        ?>
            <div class="container">
                <h1 CLASS="text-center">CATEGORIES MANAGEMENT</h1>
                <a class="btn btn-primary btn-lg btn-add" href="?cat=Add">ADD NEW CATEGORY</a>
                <table class="table table-bordered text-center table-responsive mng">
                    <tr class="frow">
                        <td>Category Name</td>
                        <td>Category Description</td>
                        <td>Edit && Delete</td>
                    </tr>
                    <?php
                        foreach ($ftch as $ftchs){
                            echo '<tr>';
                                echo '<td>';
                                    echo $ftchs['cat_name'];
                                echo '</td>';
                                echo '<td>';
                                    echo $ftchs['cat_desc'];
                                echo '</td>';
                                // Actions
                                echo '<td>';
                                    echo '<a class="btn btn-primary" href="?cat=Edit&id= ' . $ftchs['id'] . '">EDIT</a>';
                                    echo '<a class="btn btn-danger" href="?cat=Delete&id= ' . $ftchs['id'] . '">DELETE</a>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>

                </table>
            </div>
    <?php }


}else{
    header('location: index.php');
    exit();
}