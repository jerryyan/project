<?php
//require_once 'islogin.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <link href="css/d.css" rel="stylesheet" type="text/css" />      
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/moment.min.js"></script>        
        <script src="/js/jquery.datetimepicker.js"></script>      
        <script type="text/javascript" src="/js/time.js"></script> 
        <title>预约数据统计手机版</title>
        <style>

        </style>
    </head>

    <body> 
        <div class="div1">
            <?php $type = !empty($_GET['type']) ? $_GET['type'] : 'szyd'; ?>
            <div class="time">
                <select  class="year" id="birth_year" onchange="setDays(this, birth_month, birth_day);">                   
                </select>
                —
                <select  class="month" id="birth_month" onchange="setDays(birth_year, this, birth_day);">                  
                </select>
                —
                <select  class="day" id="birth_day">                   
                </select>
                <select name="" class="select" onchange="self.location.href = options[selectedIndex].value">
                    <option value="index.php">四院预约</option>
                    <option value="jzchart.php" >四院就诊</option>
                    <option value="detail.php?type=szyd"  <?php if ($type == 'szyd') echo "selected"; ?>>远大</option>
                    <option value="detail.php?type=gzdd" <?php if ($type == 'gzdd') echo "selected"; ?>>东大</option>
                    <!--<option value="detail.php?type=gzma" <?php if ($type == 'gzma') echo "selected"; ?>>民安</option>-->
                    <option value="detail.php?type=zjdd" <?php if ($type == 'zjdd') echo "selected"; ?>>湛江</option>                   
                </select>
                </select>
            </div>     
            <div class="title">        
                <span>
                    <?php
                    $typetext = array("szyd" => '远大', "zjdd" => '湛江', 'gzdd' => "东大", 'gzma' => '民安');
                    $weekarray = array("日", "一", "二", "三", "四", "五", "六");
                    $year = date('Y');
                    $month = date('m');
                    $day = date('d');
                    $strDate = $month . "月" . $day . "日 " . "( 周" . $weekarray[date('w')] . " ) ";
                    echo $strDate;
                    ?></span><?php echo $typetext[$type]; ?>详情
            </div>
            <ul class="num">

            </ul>
            <div class="tab">
                <div style="text-align:center;font-size: 30px;font-weight: bold;"> 预约详情</div>
                <div class="yy_content" style="overflow:hidden;"></div>
                <div style="text-align:center;font-size: 30px;font-weight: bold;"> 就诊详情</div>
                <div class="jz_content"></div>
            </div>

        </div>

        <div class="div2 clear">    
        </div>
    </body>
    <script src="/js/mobile.js"></script>      
    <script>
                    $(function () {
                        getdetail("");
                        setInterval(setdetail, 40000);
                        function setdetail() {
                            var y = $(".year option:selected").text();
                            var m = $(".month option:selected").text();
                            var d = $(".day option:selected").text();
                            var datetime = y + "-" + m + "-" + d;
                            getdetail(datetime);

                        }

                        $(".year,.month,.day").change(function () {
                            var y = $(".year option:selected").text();
                            var m = $(".month option:selected").text();
                            var d = $(".day option:selected").text();
                            var datetime = y + "-" + m + "-" + d;
                            getdetail(datetime);
                           
                        });
                        //获取的数据
                        function getdetail(datetime) {
                            if (datetime != undefined && datetime != "") {
                                var nowdate = getNowDate(datetime);
                                $(".title span").text(nowdate);
                                datetime = moment(datetime).format('YYYY-MM-DD');
                            }
                            $.ajax({
                                type: "post",
                                data: {datetime: datetime, type: "gdmaxq"},
                                dataType: "json",
                                url: "getdetail.php",
                                success: function (data) {
                                    var yydata = data['yyNum'];
                                    var jzdata = data['jzNum'];
                                    var str = '<table width="84%" border="0" cellspacing="2" cellpadding="0" class="content">';
                                    str += "<tr> <td>患者编号</td><td>科室</td><td>媒体</td><td>患者姓名</td><td>性别</td><td>电话</td><td>咨询员</td><td>录入时间</td></tr>";
                                    for (var i = 0; i < yydata.length; i++) {
                                        str += "<tr> <td>" + yydata[i].anumber + "</td><td>" + yydata[i].department + "</td><td>" + yydata[i].media + "</td><td>" + yydata[i].aname + "</td><td>" + yydata[i].sex + "</td><td>" + yydata[i].tel + "</td><td>" + yydata[i].awr + "</td><td>" + yydata[i].tstime + "</td></tr>";
                                    }
                                    str += "</table>";
                                    $(".yy_content").html(str);
                                    
                                          var jzstr = '<table width="84%" border="0" cellspacing="2" cellpadding="0" class="content">';
                                    jzstr += "<tr><td>是否预约</td> <td>患者编号</td><td>科室</td><td>媒体</td><td>患者姓名</td><td>性别</td><td>电话</td><td>咨询员</td><td>录入时间</td></tr>";
                                    for (var i = 0; i < jzdata.length; i++) {
                                        jzstr += "<tr> <td>" + jzdata[i].department + "</td><td>" + jzdata[i].rnumber + "</td><td>" + jzdata[i].rdepartment + "</td><td>" + jzdata[i].rmedia + "</td><td>" + jzdata[i].rname + "</td><td>" + jzdata[i].rsex + "</td><td>" + jzdata[i].rtel + "</td><td>" + jzdata[i].awr + "</td><td>" + jzdata[i].tstime + "</td></tr>";
                                    }
                                    jzstr += "</table>";
                                    $(".jz_content").html(jzstr);
                                }
                            });
                        }
                    });
    </script>
</html>
