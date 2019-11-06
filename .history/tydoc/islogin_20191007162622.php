<?php
session_start();
require_once '../config.php';
$names = array(
    "深圳天元",

    "admin"
);

$re = in_array($_SESSION['doctor'], $names);
if (!$re) {
    header('Location:login.php');
    exit();
}
