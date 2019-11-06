 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
<?php
session_start();
$lifeTime = 24 * 3600 * 365;
session_set_cookie_params($lifeTime);
if ($_POST['name'] == 'admin' && $_POST['pwd'] == '123') {
    $_SESSION['name'] = 'admin';
    header('Location:index.php');
} else {
   // header('Location:login.php');
   var_dump($_POST);
}


