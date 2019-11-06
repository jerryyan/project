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
        /* thead tr th {
            min-width: 100px;
        } */
    </style>
</head>
<?php
require_once 'islogin.php';
$p = isset($_GET['p']) ? $_GET['p'] : 1;
$all_res = get_fetchAll_assoc($project, 'select * from login_history');
$count = count($all_res);
//每页显示条数
$page = 10;
$index = ($p - 1) * $page;
$sql = "select * from login_history order by atime desc limit $index,$page ";
$history = get_fetchAll_assoc($project, $sql);
//var_dump($history);
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" onclick="location.href='/doc/index.php'">返回首页</button>
                <button type="button" class="btn btn-primary" id="imports">导出记录</button>
                <!-- <a class="btn btn-primary" href="/doc/export.php" target="_blank">导出记录</a> -->
            </div>
            <div class="col-md-6">
                <input type="text" class="layui-input" id="dataTime1" placeholder="yyyy-MM-dd">
            </div>
            <div class="col-md-6">
                <input type="text" class="layui-input" id="dataTime2" placeholder="yyyy-MM-dd">
            </div>
            <div class="col-md-12" style="overflow: scroll;">
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">序号</th>
                            <th style="text-align: center;">账号</th>
                            <th style="text-align: center;">操作时间</th>
                            <th style="text-align: center;">状态</th>
                            <th style="text-align: center;">登录IP</th>
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
                            echo $str;
                        }
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
    layui.use(['laypage', 'laydate'], function() {
        var laypage = layui.laypage
        var laydate = layui.laydate

        laydate.render({
            elem: '#dataTime1',
            value: new Date()
        });
        laydate.render({
            elem: '#dataTime2',
            value: new Date()
        });
        laypage.render({
            elem: 'demoaaa',
            limit: <?php echo $page; ?>,
            curr: <?php echo $p; ?>,
            count: <?php echo $count; ?>,
            jump: function(obj, first) {
                if (!first) {
                    location.href = "/doc/history.php?p=" + obj.curr;
                    console.log(obj.curr);

                }
            }
        });
    });
    $('#')
</script>

</html>