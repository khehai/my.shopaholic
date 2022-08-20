<?php
// Подключаем sql базу данных
$link = mysqli_connect("localhost", "root", "");

if($link === false) {
    die("Error: Could not connect ". mysqli_connect_error());
}

// echo "Connet created succesfully";


// Система кодирования и сортировки
$sql = <<<EOT
    SET NAMES utf8mb4;
    DROP DATABASE IF EXISTS shopaholic;
    DROP SCHEMA IF EXISTS shopaholic;
    CREATE SCHEMA shopaholic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EOT;

if(mysqli_multi_query($link, $sql)){
    echo "Schema created successfully";
}else{
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($link);
}

mysqli_close($link); 
