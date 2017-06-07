<?php
try{
    $conn = new PDO("mysql:host=localhost;dbname=cart", 'root', '');
}catch (PDOException $exception){
    echo $exception->getMessage();
}