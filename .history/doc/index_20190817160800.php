<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>医生挂号查询</title>
    <link rel="stylesheet" href="./assert/layui/css/layui.css">
    <link rel="stylesheet" href="./assert/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assert/css/index.css">
    <script src="./assert/rem.js"></script>
</head>
<?php
require_once 'islogin.php';
?>

<body class="baseSize">
    <header>

    </header>
    <section>
        <div class="row">
            <div class="col-xs-6" style="display: flex;">
                <div class="baseSize" style="width: 30px;text-align: right;line-height: 34px;">起始:</div>
                <input type="text" class="layui-input startDate" id="date1" style="width:78%;height: 34px;">
            </div>
            <div class="col-xs-6" style="display: flex;">
                <div class="baseSize" style="flex: 1;text-align: right;line-height: 34px;">终止:</div>
                <input type="text" class="layui-input endDate" id="date2" style="width:78%;height: 34px;">
            </div>
            <div class="col-xs-6">
                <input type="text" class="form-control name" placeholder="患者姓名:">
            </div>
            <div class="col-xs-6">
                <input type="text" class="form-control tel" placeholder="患者电话:">
            </div>
            <div class="col-xs-6">
                <div class="form-group" style="margin-bottom: 0;">
                    <select id="fang" class="form-control input-xs">
                        <option value="1">今天</option>
                        <option value="2">昨天</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <button type="button" id="sub" class="btn btn-primary">查询</button>
                <button type="button" id="out" class="btn btn-primary">退出</button>

                <span style="margin-left: 2px;" class="tyuio"></span>
            </div>
            <?php if($_SESSION['doctor'] =='admin'){ ?php

            }
                <div class="col-xs-12">
                <button type="button" class="btn btn-primary" onclick="location.href='/doc/history.php'">登录记录</button>
            </div>
            ?>
        
            <div style="overflow: auto;" class="tab col-xs-12">
                <table class="table" style="text-align: center">
                    <thead>
                        <tr>
                            <th style="min-width: 80px;text-align: center;">到诊时间</th>
                            <th style="min-width: 80px;text-align: center;">咨询员</th>
                            <th style="min-width: 80px;text-align: center;">门诊号</th>
                            <th style="min-width: 80px;text-align: center;">患者姓名</th>
                            <th style="min-width: 80px;text-align: center;">电话</th>
                            <th style="min-width: 80px;text-align: center;">是否预约</th>
                            <th style="min-width: 80px;text-align: center;">媒体</th>
                            <th style="min-width: 150px;text-align: center;">症状</th>
                            <th style="min-width: 80px;text-align: center;">科室</th>
                            <!-- <th style="min-width: 80px;text-align: center;">对话</th> -->
                        </tr>
                    </thead>
                    <tbody class="zqj">
                        <!--                        <tr onclick="showKuan()" style="height: 40px;">
                                    <td>Tanmay</td>
                                    <td>Bangalore</td>
                                    <td>560001</td>
                                    <td>Tanmay</td>
                                    <td>Bangalore</td>
                                    <td>560001</td>
                                    <td>Tanmay</td>
                                    <td>Bangalore</td>
                                    <td>560001</td>
                                </tr>-->
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</body>
<script src="./assert/jquery-3.3.1.min.js"></script>
<script src="./assert/bootstrap/js/bootstrap.min.js"></script>
<script src="./assert/layui/layui.js"></script>
<script src="./assert/template-web.js"></script>
<!-- 对话模板 -->
<script type="text/html" id="duihua">
{{each list value}}
<section>
    <div class="row">
        <div class="col-xs-12 disFle">
            <div class="checkbox" style="margin-top: 5px;margin-bottom: 0;">
                <label>
                    <input {{if value.isAppointment=="1"}} checked {{else}}checkbox {{/if}} type="checkbox" disabled>有预约
                </label>
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">编号</div>
            <div class="bor1">
                {{value.rNumber}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">诊号</div>
            <div class="bor1">
                {{value.OutpatientNumber}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">姓名</div>
            <div class="bor1">
                {{value.rname}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">电话</div>
            <div class="bor1">
                {{value.rTel}}
            </div>
        </div>

        <div class="col-xs-6 disFle">
            <div class="lh30">性别</div>
            <div class="bor1">
                {{value.rSex}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">年龄</div>
            <div class="bor1">
                {{value.rAge}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">科室</div>
            <div class="bor1">
                {{value.rDepartment}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">症状</div>
            <div class="bor1">
                {{value.rSymptom}}
            </div>
        </div>

        <div class="col-xs-6 disFle">
            <div class="lh30">医生</div>
            <div class="bor1">
                {{value.rDoctor}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">媒体</div>
            <div class="bor1">
                {{value.rMedia}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">地址</div>
            <div class="bor1">
                {{value.rAddress}}
            </div>
        </div>
        <div class="col-xs-6 disFle">
            <div class="lh30">日期</div>
            <div class="bor1" style="text-indent: 0em;white-space: nowrap;">
                {{value.ts}}
            </div>
        </div>
    </div>
    <span style="margin-left: 15px;font-weight: 700;font-size: 18px;margin-top: 30px;">特殊情况</span>
    <div class="area">
        {{value.aspecial}}
    </div>
    <span style="margin-left: 15px;font-weight: 700;font-size: 18px;margin-top: 30px;">预约对话</span>
    <div class="area">
        {{value.remark}}
    </div>
</section>
{{/each}}
</script>
<!-- 模板渲染 -->
<script type="text/html" id="tac">
{{each list value}}
<tr onclick="showKuan({{value.RegisterId}})" style="height: 40px;">
    <td>{{value.ts}}</td>
    <td>{{value.awr}}</td>
    <td>{{value.OutpatientNumber}}</td>
    <td>{{value.rname}}</td>
    <td>{{value.rTel}}</td>
    <td>{{value.ysyy}}</td>
    <td>{{value.rMedia}}</td>
    <td>{{value.rSymptom}}</td>
    <td>{{value.rDepartment}}</td>
</tr>
{{/each}}
</script>
<script>
    layui.use(['layer', 'laydate'], function() {
        window.laydate = layui.laydate
        window.layer = layui.layer;
        timer('date1')
        timer('date2')
        $('#fang').change(function() {
            var zhi = $(this).val()
            // console.log(new Date(asx()));

            if (zhi == '1') {
                timer('date1')
                timer('date2')
            } else if (zhi == '2') {
                timer('date1', new Date(asx()))
                timer('date2', new Date(asx()))
            }
        })
        $('#sub').click(function() {
            sdf()
        })
        var afg = new Date().toISOString().split('T')[0]
        sdf(afg)

        function timer(id, tim) {
            laydate.render({
                elem: `#${id}`,
                type: 'date',
                format: 'yyyy-MM-dd',
                value: tim || new Date()
            });
        }



        function asx() {
            var now = new Date();
            now = new Date(now.getTime() - 86400000);
            var year = now.getFullYear(),
                month = (now.getMonth() + 1).toString(),
                day = now.getDate().toString();
            if (month.length == 1) {
                month = '0' + month;
            }
            if (day.length == 1) {
                day = '0' + day;
            }
            var dates = (year + '-' + month + '-' + day);
            return dates
        }

        function qwe(vao) {
            var vas = vao.split('/')
            var zuihou = ''
            for (var i = 0; i < vas.length; i++) {
                zuihou += vas[i] + '-'
            }
            zuihou = zuihou.substr(0, zuihou.length - 1);
            return zuihou
        }

        function sdf(aa) {
            // console.log(qwe($('.startDate').val()));
            var data = {
                startDate: aa || qwe($('.startDate').val()),
                endDate: aa || qwe($('.endDate').val()),
                name: $('.name').val(),
                tel: $('.tel').val(),
            }
            $.ajax({
                type: "post",
                url: "./getjzNum.php",
                data: data,
                dataType: "json",
                success: function(response) {

                    for (var i = 0; i < response.length; i++) {
                        response[i].rTel = replacePos(response[i].rTel)
                    }
                    $('.tyuio').text(`共${response.length}条`)
                    var html = template('tac', {
                        list: response
                    })
                    $('.zqj').html(html)
                }
            });
        }
    });
    showKuan()

    function showKuan(id) {
        $.ajax({
            type: "post",
            url: "./getDetail.php",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                response.rTel = replacePos(response.rTel + '')
                // console.log(response);
                var arr = [response]
                var html = template('duihua', {
                    list: arr
                })
                layer.open({
                    type: 1,
                    title: false,
                    area: ['95%', '90%'],
                    offset: 'auto',
                    content: html,
                    success: function(layero, index) {
                        console.log(11111);
                    }
                });
            }
        });
    }
    $("#out").click(function() {
        window.location.href = "./out.php";
    });

    function replacePos(obj) {
        var str = obj.substr(3, 4)
        var zuihou = obj.replace(str, '****')
        return zuihou
    }
</script>

</html>