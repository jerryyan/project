<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录界面</title>
    <link rel="stylesheet" href="./assert/css/login.css">
</head>
<?php
session_start();
$lifeTime = 24 * 3600;
session_set_cookie_params($lifeTime);
require_once '../config.php';
$doctors = array(
    "深圳天元" => "jc0012",
    "王翠英" => "XH123456",
    "楚立军" => "c6321",
    "门诊" => 'ydgc6003',   
    "李玉霞" => 'yx296',
    "江清华" => 'jqh89',
    "宋丽丽" => "s00163",
    "刘振秀" => "zx620",
    "赵云" => "zy523",
    "张基林" => "z9525",
    "蹇香春" => "jxc15",
    "段正保" => "dzb35",
    "金庆淑" => "7sjxsg",
    "admin" => "ydgc6003"
);

if (!empty($_POST)) {
    $name = $_POST['name'];
    $pwd = $_POST['pwd'];
    if ($_POST['pwd'] == $doctors[$name]) {
        $_SESSION['doctor'] = $name;
        $atime = date("Y-m-d H:i:s");
        $ip = getClientIp();
        $sql = "insert into  login_history (name,atime,status,ip) VALUES('$name','$atime','登录','$ip')";
        $row = insert($project, $sql);
        header('Location:index.php');
        exit();
    }
}

?>

<body>
    <article class="htmleaf-container">
        <header class="htmleaf-header" style="height: 100px;">
            <div class="htmleaf-links">

            </div>
        </header>
        <form action="login.php" method="post" id="form1">
            <div class="panel-lite">
                <div class="thumbur">
                    <div class="icon-lock"></div>
                </div>
                <h4>用户登录</h4>
                <div class="form-group">
                    <input required="required" class="form-control" name="name" />
                    <label class="form-label">用户名 </label>
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" required="required" class="form-control" />
                    <label class="form-label">密　码</label>
                    <!-- </div><a href="#">忘记密码 ? </a> -->
                    <button id="btn" class="floating-btn"><i class="icon-arrow"></i></button>
                </div>
            </div>
        </form>
    </article>

</body>
<script src="./assert/jquery-3.3.1.min.js"></script>
<!--<script>
        $(function () {
            $('#btn').on('click',function(){
                location.href="./index.html"
            })
        })
    </script>-->

</html>