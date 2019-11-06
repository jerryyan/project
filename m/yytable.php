<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
        <link href="css/m.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/moment.min.js"></script>        
        <script src="/js/jquery.datetimepicker.js"></script>      
        <title>预约数据统计手机版</title>
    </head>

    <body>
        <div class="div2">
            <ul class="nav">
                <li><a href="index.php" >预约统计</a></li>
                <li><a href="jzchart.php">就诊统计</a></li>
                <li><a href="yytable.php"  class="current">预约排行</a></li>
                <li><a href="jztable.php">就诊排行</a></li>    
            </ul>
            <div class="title">
                <?php
                 require_once 'islogin.php';
                $weekarray = array("日", "一", "二", "三", "四", "五", "六");
                $year = date('Y');
                $month = date('m');
                $day = date('d');
                $strDate = $month . "月" . $day . "日 " . "( 周" . $weekarray[date('w')] . " ) ";
                echo $strDate;
                ?>咨询预约排行
            </div>
            <table width="560" border="0" cellspacing="2" cellpadding="0" class="content">
                    
            </table>
            <div class="time">
                <input readonly="" name="datetime" id="datetime" class="datetime" value="<?php echo date("Y-m-d"); ?>" placeholder="" type="text">
            </div>
        </div>
    </body>
    <script src="/js/mobile.js"></script>      
    <script>
        $(function () {
            $('#datetime').datetimepicker({
                lang: "ch", //语言选择中文
                format: "Y-m-d", //格式化日期
                timepicker: false, //关闭时间选项
                yearStart: 2013,
                yearEnd: 2020,
                onSelectDate: function (dateText) {
                    var datetime = dateText;
                    getyyAwrNum(datetime);
                }
            });
            getyyAwrNum();
            setInterval(getyyAwrNum, 20000);
        });
    </script>
</html>
