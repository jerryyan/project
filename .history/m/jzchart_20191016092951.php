<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
        <link href="css/m.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/moment.min.js"></script>        
        <script type="text/javascript" src="/js/time.js"></script>  
        <title>预约数据统计手机版</title>
    </head>

    <body>
        <div class="div1">
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
                    <option value="jzchart.php"  selected>四院就诊</option>
                    <option value="detail.php?type=szyd" >远大</option>
                    <option value="detail.php?type=szyd" >远大</option>
                    <option value="detail.php?type=gzdd" >东大</option>
                    <!--<option value="detail.php?type=gzma" >民安</option>-->
                    <option value="detail.php?type=zjdd" >湛江</option>    
                    <option value="detail.php?type=nngc" >南宁肛肠</option>  
                    <option value="detail.php?type=nnwc" >南宁胃肠</option>  
                    <option value="detail.php?type=szydwc" >远大胃肠</option>        
                </select>
            </div>    

            <div class="title"> 
                <?php
                require_once 'islogin.php';
                $weekarray = array("日", "一", "二", "三", "四", "五", "六");
                $year = date('Y');
                $month = date('m');
                $day = date('d');
                $strDate = $month . "月" . $day . "日 " . "( 周" . $weekarray[date('w')] . " ) ";
                echo $strDate;
                ?>四院就诊量
            </div>

            <ul class="num">              
            </ul>
            <div class="table">
                <div class="yd">
                    <div class="yd_1"><span></span></div>
                    <div class="yd_2"><span></span></div>
                    <div class="yd_3"><span></span></div>
                </div>
                <div class="yc">
                    <div class="yc_1"><span></span></div>
                    <div class="yc_2"><span></span></div>
                    <div class="yc_3"><span></span></div>
                </div>
                <div class="dd">
                    <div class="dd_1"><span></span></div>
                    <div class="dd_2"><span></span></div>
                    <div class="dd_3"><span></span></div>
                </div>
                <div class="ma">
                    <div class="ma_1"><span></span></div>
                    <div class="ma_2"><span></span></div>
                    <div class="ma_3"><span></span></div>
                </div>
                <div class="zj">
                    <div class="zj_1"><span></span></div>
                    <div class="zj_2"><span></span></div>
                    <div class="zj_3"><span></span></div>
                </div>
                <!-- <div class="ty">
                    <div class="ty_1"><span></span></div>
                    <div class="ty_2"><span></span></div>
                    <div class="ty_3"><span></span></div>
                </div> -->
            </div>
            <div class="logo">
                <ul>
                    <li><img src="/images/logo_yd.jpg">远大<br>肛肠</li>
                    <li><img src="/images/logo_yd.jpg">远大<br>胃肠</li>
                    <li><img src="/images/logo_dd.jpg">东大</li>
                    <li><img src="/images/logo_nn.jpg">南宁</li>
                    <li><img src="/images/logo_zj.jpg">湛江</li>
                    <li><img src="/images/logo_zj.jpg">天元</li>
                </ul>
            </div>
        </div>
    </body>
    <script src="/js/mobile.js"></script>      
    <script>
                    $(function () {
                        $(".year,.month,.day").change(function () {
                            var y = $(".year option:selected").text();
                            var m = $(".month option:selected").text();
                            var d = $(".day option:selected").text();
                            var datetime = y + "-" + m + "-" + d;
                            getjzSource(datetime);
                        });
                        getjzSource();
                        setInterval(setjzSource, 40000);
                    });
    </script>
</html>
