<?php
//$lifeTime = 24 * 3600;
//session_set_cookie_params($lifeTime);
session_start();
if (!empty($_POST)) {
    if ($_POST['name'] == 'admin' && $_POST['pwd'] == 'yd9131@') {
        $_SESSION['name'] = 'admin';
        header('Location:index.php');
        exit();
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
        <title>登录</title>      
    
        <style>
            input{
                display: block;
                width: 60%;                
                font-size: 16px;
                height: 43px;
                padding: 0;
                text-indent: 5px;              
            }
            input[type='submit']{
                text-align: center;
            } 
        </style>
    </head>

    <body>
        <form action="login.php" method="post" id="form1">
            <input id="use"  type="text" name="name" value="" placeholder="请输入用户名"/><br/>
            <input id="pwd" type="password"  name="pwd" placeholder="请输入密码"/><br/>
            <input  type="submit" name="submit" value="登录"/>
        </form>
    </body>  
</html>
