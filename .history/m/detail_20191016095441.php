<?php
require_once 'islogin.php';
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
                    <option value="detail.php?type=szty"  <?php if ($type == 'szty') echo "selected"; ?>>远大</option>
                    <option value="detail.php?type=gzdd" <?php if ($type == 'gzdd') echo "selected"; ?>>东大</option>
                    <option value="detail.php?type=zjdd" <?php if ($type == 'zjdd') echo "selected"; ?>>湛江</option> 
                    <option value="detail.php?type=nngc" <?php if ($type == 'nngc') echo "selected"; ?>>南宁肛肠</option>  
                    <option value="detail.php?type=nnwc" <?php if ($type == 'nnwc') echo "selected"; ?>>南宁胃肠</option>  
                     <option value="detail.php?type=szydwc" <?php if ($type == 'szydwc') echo "selected"; ?>>远大胃肠</option>        
                </select>               
            </div>     
            <div class="title">        
                <span>
                    <?php
                    $typetext = array("szyd" => '远大', "zjdd" => '湛江', 'gzdd' => "东大", 'gzma' => '民安','nngc' => '南肛','nnwc' => '南胃',"szydwc" => '远大胃肠');
                    $weekarray = array("日", "一", "二", "三", "四", "五", "六");
                    $year = date('Y');
                    $month = date('m');
                    $day = date('d');
                    $strDate = $month . "月" . $day . "日 " . "( 周" . $weekarray[date('w')] . " ) ";
                    echo $strDate;
                    ?></span><?php echo $typetext[$type]; ?>各班详情
            </div>
            <ul class="num">

            </ul>
            <div class="table">

                <div class="bb">
                    <div class="bb_1"><span></span></div>
                    <div class="bb_2"><span></span></div>
                </div>
                <div class="wb">
                    <div class="wb_1"><span></span></div>
                    <div class="wb_2"><span></span></div>
                </div>
                <div class="dy">
                    <div class="dy_1"><span></span></div>
                    <div class="dy_2"><span></span></div>
                </div>
            </div>
            <div class="logo">
                <ul class="xiangxi">
                    <li>白 班</li>
                    <li>晚 班</li>
                    <li>大 夜</li>
                </ul>
            </div>
        </div>
        <input type="hidden" value="<?php echo $type; ?>" id="type">
        <div class="div2 clear">    
        </div>
    </body>
    <script src="/js/mobile.js"></script>      
    <script>
                    $(function () {
                        var type = $("#type").val();
                        getdetail("", type);
                        getmedia("", type);
                        setInterval(setdetail, 40000);
                        function setdetail() {
                            var y = $(".year option:selected").text();
                            var m = $(".month option:selected").text();
                            var d = $(".day option:selected").text();
                            var datetime = y + "-" + m + "-" + d;
                            getdetail(datetime, type);
                            getmedia(datetime, type);
                        }

                        $(".year,.month,.day").change(function () {
                            var y = $(".year option:selected").text();
                            var m = $(".month option:selected").text();
                            var d = $(".day option:selected").text();
                            var datetime = y + "-" + m + "-" + d;
                            getdetail(datetime, type);
                            getmedia(datetime, type);
                        });

                        //获取的数据
                        function getdetail(datetime, type) {
                            if (datetime != undefined && datetime != "") {
                                var nowdate = getNowDate(datetime);
                                $(".title span").text(nowdate);
                                datetime = moment(datetime).format('YYYY-MM-DD');
                            }
                            $.ajax({
                                type: "post",
                                data: {datetime: datetime, type: type},
                                dataType: "json",
                                url: "getdetail.php",
                                success: function (data) {                               
                                    var max_nums = [data.yyNum.zaoNum, data.jzNum.zaoNum, data.yyNum.wanNum, data.jzNum.wanNum, data.yyNum.dayeNum, data.jzNum.dayeNum];
                                    var maxInNum = Math.max.apply(Math, max_nums);
                                    var j = Math.ceil(maxInNum / 19);
                                    var long = j * 19;
                                    //生成预约的纵坐标
                                    var strText = "";
                                    for (var i = long; i >= 0; i--) {
                                        if (i % j == 0) {
                                            strText += "<li>" + i + "</li>";
                                        }
                                    }
                                    $(".num").html(strText);
                                    $(".bb_1 span").text("预约 ：" + data.yyNum.zaoNum);
                                    $(".bb_2 span").text("到诊 ：" + data.jzNum.zaoNum);
                                    var by_height = GetPercent(data.yyNum.zaoNum, long);
                                    var bj_height = GetPercent(data.jzNum.zaoNum, long);
                                    $(".bb_1").css("height", by_height);
                                    $(".bb_2").css("height", bj_height);

                                    $(".wb_1 span").text("预约 ：" + data.yyNum.wanNum);
                                    $(".wb_2 span").text("到诊 ：" + data.jzNum.wanNum);
                                    var wy_height = GetPercent(data.yyNum.wanNum, long);
                                    var wj_height = GetPercent(data.jzNum.wanNum, long);
                                    $(".wb_1").css("height", wy_height);
                                    $(".wb_2").css("height", wj_height);

                                    $(".dy_1 span").text("预约 ：" + data.yyNum.dayeNum);
                                    $(".dy_2 span").text("到诊 ：" + data.jzNum.dayeNum);
                                    var dyy_height = GetPercent(data.yyNum.dayeNum, long);
                                    var dyj_height = GetPercent(data.jzNum.dayeNum, long);
                                    $(".dy_1").css("height", dyy_height);
                                    $(".dy_2").css("height", dyj_height);
                                }
                            });
                        }

                        //media
                        function getmedia(datetime, type) {
                            if (datetime != undefined && datetime != "") {
                                var nowdate = getNowDate(datetime);
                                $(".title span").text(nowdate);
                                datetime = moment(datetime).format('YYYY-MM-DD');
                            }
                            $.ajax({
                                type: "post",
                                data: {datetime: datetime, type: type},
                                dataType: "json",
                                url: "getmedia.php",
                                success: function (data) {
                                    var len = data.length;
                                    var str = "<table width='84%' border='0' cellspacing='2' cellpadding='0'><tr style='color:#666'><td width='30%'></td><td width='40%'>预约</td><td width='40%'>就诊</td></tr>";
                                    for (var i = 0; i <= len - 1; i++) {
                                        str += "<tr><td>" + data[i].media + "</td><td>" + data[i].yy + "</td><td>" + data[i].jz + "</td></tr>";
                                    }
                                    str += "</table>";
                                    $(".div2").html(str);
                                }
                            });
                        }
                    });
    </script>
</html>
