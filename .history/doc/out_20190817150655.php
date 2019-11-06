<?php
session_start();
$name=$_SERVER['']
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();

$atime = date("Y-m-d H:i:s");
$ip = getClientIp();
$sql = "insert into  login_history (name,atime,status,ip) VALUES('$name','$atime','下线','$ip')";
$row = insert($project, $sql);
header('Location:login.php');
