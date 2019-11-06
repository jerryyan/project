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
$p = isset($_GET['p']) ? $_GET['p'] : 1;
$all_res = get_fetchAll_assoc($project, 'select * from login_history');
$count = count($all_res);
//每页显示条数
$page = 5;
$index = ($p - 1) * $page;
$sql = "select * from login_history limit $index,$page";
$history = get_fetchAll_assoc($project, $sql);
//var_dump($history);
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
                        <?php
                        foreach ($history as $v) {
                            $str = "<tr>";
                            $str .= "<td>{$v['id']}</td>";
                            $str .= "<td>{$v['name']}</td>";
                            $str .= "<td>{$v['atime']}</td>";
                            $str .= " <td>{$v['status']}</td>";
                            $str .= " <td>{$v['ip']}</td>";
                            $str .= " </tr>";
                        }
                        echo $str;
                        ?>

                    </tbody>
                </table>
            </div>
            <div id="demoaaa"></div>
        </div>
    </div>
</body>
<script src="./assert/jquery-3.3.1.min.js"></script>
<script src="./assert/bootstrap/js/bootstrap.min.js"></script>
<script src="./assert/layui/layui.js"></script>
<script>
    layui.use(['laypage'], function() {
        window.laypage = layui.laypage


        laypage.render({
            elem: 'demoaaa',
            limit: <?php echo $page; ?>,
            curr: <?php echo $p; ?>,
            count: <?php echo $count; ?>,
            jump: function(obj, first) {
                if (!first) {
                    location.href=127.0.0.5/doc/history.php
                    console.log(obj.curr);

                }
            }
        });
    });
</script>

</html>