<?php
// redirect to any page
function redirect($seconds = 6, $url){
    echo "<h1 class='alert-danger text-center'>You will redirect to home page After $seconds Seconds</h1>";
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
        $url = $_SERVER['HTTP_REFERER'];
    }else{
        $url = 'index.php';
    }
    header("refresh:$seconds; url=$url");
    exit();
}


// Get Data From Gategories Table
function getCat(){
    global $conn;
    $cat = $conn->prepare("SELECT * FROM cat WHERE status = 1 ORDER BY id ASC");
    $cat->execute();
    $rows = $cat->fetchAll();
    return  $rows;
}
// Get from Products table
function getProd($cat_id){
    global $conn;
    $prod = $conn->prepare("SELECT * FROM products WHERE $cat_id = ?");
    $prod->execute(array($cat_id = $_GET['id']));
    $prodRows = $prod->fetchAll();
    return $prodRows;
}