<?php
session_start();
require_once '../config.php';
$names = array(
    "路俊超",
    '王翠英',
    "楚立军",
    "门诊",
    "吴孙萍",
    "李玉霞",
    "江清华",
    "宋丽丽",
    "刘振秀",
    "赵云",
    "张基林",
    "蹇香春",
    "段正保",
    "金庆淑",
    "admin"
);

$re = in_array($_SESSION['doctor'], $names);
if (!$re) {
    header('Location:login.php');
    exit();
}
