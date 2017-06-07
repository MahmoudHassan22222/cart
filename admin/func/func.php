<?php
// Page Title
function pageTitle(){
    global $title;
    if (isset($title)){
        echo $title;
    }else{
        echo 'Default';
    }
}
// redirect to any page
function redirect($seconds = 6, $url){
    echo "<div class='alert-danger text-center'>You will redirect to home page After $seconds Seconds</div>";
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
        $url = $_SERVER['HTTP_REFERER'];
    }else{
        $url = 'index.php';
    }
    header("refresh:$seconds; url=$url");
    exit();
}