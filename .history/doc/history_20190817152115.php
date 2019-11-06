<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>状态记录</title>
    <link rel="stylesheet" href="./assert/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assert/layui/css/layui.css">
    <style>
        thead tr th {
            min-width: 100px;
        }
    </style>
</head>
<?php
require_once 'islogin.php';
$p = $_GET['p'];
$all_res=get_fetchAll_assoc($project,'select * from login_history');
$count = db('swt_file')->count();
//每页显示条数
$page = 10;
$index = ($p - 1) * $page;
$sql = "select * from login_history limit $index,$page";
$history = get_fetchAll_assoc($project,$sql);

?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="overflow: scroll;">
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>序号</th>
                            <th>账号</th>
                            <th>操作时间</th>
                            <th>状态</th>
                            <th>登录IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                        <tr>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="demoaaa"></div>
        </div>
    </div>
</body>
<script src="./assert/jquery.js"></script>
<script src="./assert/bootstrap/js/bootstrap.min.js"></script>
<script src="./assert/layui/layui.js"></script>
<script>
    layui.use(['laypage'], function() {
        window.laypage = layui.laypage


        laypage.render({
            elem: 'demoaaa',
            limit: 10,
            curr: 15,
            count: 15,
            jump: function(obj, first) {
                if (!first) {
                    // current = obj.curr
                    // fund(obj.curr)
                    console.log(obj.curr);

                }
            }
        });
    });
</script>

</html>