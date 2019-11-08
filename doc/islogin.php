<?php
session_start();
require_once '../config.php';
$names = array(
    "庄二春",
    "楚立军",
    "江清华",
    "李玉霞",
    "蹇香春",
    "张全复",
    "赵云" ,
    "刘伟琢",
    "吴孙萍",
    "孙秀艳" ,
    "蹇香春",
    "段正保",
    "金庆淑",
    "门诊" ,
    "admin" 
);

$re = in_array($_SESSION['doctor'], $names);
if (!$re) {
    header('Location:login.php');
    exit();
}
