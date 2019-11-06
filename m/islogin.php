<?php
session_start();
if ($_SESSION['name'] != 'admin') {
    header('Location:login.php');
    exit();
}

