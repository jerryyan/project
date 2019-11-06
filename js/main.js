$(function () {
    var len;
    var t = 30000;
    var yyAwrId, jzAwrId, yyTimeId, jzTimeId;
    window.onload = func1;
   // setInterval(getjzNew, 26000);
    //每隔t秒轮换setyySource和setjzSource
   // $(window).unload(function () {
   //     $.ajax({
    //        type: "post",
    //        dataType: "json",
    //        url: "getjzNew.php?action=d",
     //       success: function (e) {
     //           //  console.log(e);
     //       }
      //  });
   // });

    function func1() {
        $(".mytable").css("display", "none");
        setyySource();
        $(".mychart").css("display", "block");
        setTimeout(func2, t);
    }
    function func2() {
        setjzSource();
        setTimeout(awr1, t);
    }

    function awr1() {
        clearInterval(jzTimeId);
        clearTimeout(jzAwrId);
        $(".mychart").css("display", "none");
        getyyAwrNum();
        $(".mytable").css("display", "block");
        var i = 0;
        awr1lh(i);
        var time = t * len;
        setTimeout(awr2, time);
    }
    function awr2() {
        clearTimeout(yyAwrId);
        getjzAwrNum();
        var j = 0;
        awr2lh(j);
        var time = t * len;
        setTimeout(func1, time);
    }
//轮换预约的div
    function awr1lh(i)
    {
        if (i === len)
        {
            i = 0;
        }
        show(2 * i);
        i++;
        yyAwrId = setTimeout(function () {
            awr1lh(i);
        }, t);
    }
//轮换就诊的div
    function awr2lh(j)
    {
        if (j === len)
        {
            j = 0;
        }
        show(2 * j);
        j++;
        jzAwrId = setTimeout(function () {
            awr2lh(j);
        }, t);
    }



//每隔5s拉取一些数据
    function  setyySource() {
        getyySource();
        clearInterval(jzTimeId);
        yyTimeId = setInterval(getyySource, 5000);
    }
    function  setjzSource() {
        getjzSource();
        clearInterval(yyTimeId);
        jzTimeId = setInterval(getjzSource, 5000);
    }
    //隐藏其他div显示选择的div
    function show(i) {
        $("table").css("display", "none");
        $(".tb" + i).css("display", "block");
        $(".tb" + eval(i + 1)).css("display", "block");
    }
    function getyyAwrNum() {
        $.ajax({
            type: "post",
            dataType: "json",
            async: false,
            url: "getyyAwrNum.php",
            success: function (data) {
                var nowdate = getNowDate();
                $(".table_title").text(nowdate + "咨询预约排行");
                var str = "";
                var j = 0;
                len = Math.ceil(data.length / 10);
                for (var i = 0; i < data.length; i++) {
                    if (i % 5 === 0) {
                        if (i >= 10) {
                            str += "<table style='display:none;' class='tb" + j++ + "' width='560' border='0' cellspacing='2' cellpadding='0'> <tr style='color:#666'><td width='100'>名次</td><td width='150'>姓名</td><td width='150'>所属组</td><td width='150'>预约</td></tr>";
                        } else {
                            str += "<table  class='tb" + j++ + "' width='560' border='0' cellspacing='2' cellpadding='0'> <tr style='color:#666'><td width='100'>名次</td><td width='150'>姓名</td><td width='150'>所属组</td><td width='150'>预约</td></tr>";
                        }
                    }
                    str += "<tr><td>" + eval(i + 1) + "</td><td>" + data[i].awr + "</td><td>" + data[i].gp + "</td><td>" + data[i].nums + "</td></tr>";
                }
                $(".content").html(str);
            }
        });
    }

    function getjzAwrNum() {
        $.ajax({
            type: "post",
            dataType: "json",
            async: false,
            url: "getjzAwrNum.php",
            success: function (data) {
                var nowdate = getNowDate();
                $(".table_title").text(nowdate + "咨询就诊排行");
                var str = "";
                var j = 0;
                len = Math.ceil(data.length / 10);
                for (var i = 0; i < data.length; i++) {
                    if (i % 5 === 0) {
                        if (i >= 10) {
                            str += "<table style='display:none;' class='tb" + j++ + "' width='560' border='0' cellspacing='2' cellpadding='0'> <tr style='color:#666'><td width='100'>名次</td><td width='150'>姓名</td><td width='150'>所属组</td><td width='150'>预约</td></tr>";
                        } else {
                            str += "<table  class='tb" + j++ + "' width='560' border='0' cellspacing='2' cellpadding='0'> <tr style='color:#666'><td width='100'>名次</td><td width='150'>姓名</td><td width='150'>所属组</td><td width='150'>预约</td></tr>";
                        }
                    }
                    str += "<tr><td>" + eval(i + 1) + "</td><td>" + data[i].awr + "</td><td>" + data[i].gp + "</td><td>" + data[i].nums + "</td></tr>";
                }
                $(".content").html(str);
            }
        });
    }

//获取就诊的数据
    function getjzSource() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "getjzNum.php",
            success: function (data) {
                var zjdd_target = 4;
                var gzma_target = 10;
                var gzdd_target = 14;
                var szyd_target = 20;
                var max_nums = [data.zjdd_jzNum.totalNum, data.gzma_jzNum.totalNum, data.szyd_jzNum.totalNum, data.gzdd_jzNum.totalNum, zjdd_target, gzma_target, szyd_target, gzdd_target];
                var maxInNum = Math.max.apply(Math, max_nums);
                var j = Math.ceil(maxInNum / 27) === 0 ? 10 : Math.ceil(maxInNum / 27);
                var long = j * 27;
                var strText = "";
                //生成就诊的横坐标
                for (var i = 0; i <= long; i++) {
                    if (i % j == 0) {
                        strText += "<li>" + i + "</li>";
                    }
                }
                var nowdate = getNowDate();
                $(".chart_title").text(nowdate + "四院就诊量");
                $(".dd_3").css("background", 'rgba(0,0,0,0.25)');
                $(".yd_3").css("background", 'rgba(0,0,0,0.25)');
                $(".ma_3").css("background", 'rgba(0,0,0,0.25)');
                $(".zj_3").css("background", 'rgba(0,0,0,0.25)');
                $(".bottomNum").html(strText);
                var todayTime = moment().format('HH:mm:ss');
                $(".bottomNum").append("<li style='color:red;'>" + todayTime + "</li>");
                var type = getType();
                //设置湛江的就诊数据
                $(".zj_1_span").text("全天 ：" + data.zjdd_jzNum.totalNum);
                $(".zj_2_span").text(type + data.zjdd_jzNum.workNum);
                $(".zj_3 span").text("目标 ：" + zjdd_target);
                var zjdd_total_width = GetPercent(data.zjdd_jzNum.totalNum, long);
                var zjdd_work_width = GetPercent(data.zjdd_jzNum.workNum, long);
                var zjdd_target_width = GetPercent(zjdd_target, long);
                if (zjdd_target > data.zjdd_jzNum.totalNum) {
                    var width = GetPercent(zjdd_target - data.zjdd_jzNum.totalNum, long);
                    $(".zj_3").css("width", width);
                    $(".zj_1").css("width", zjdd_total_width);
                } else {
                    var width = GetPercent(data.zjdd_jzNum.totalNum - zjdd_target, long);
                    $(".zj_3").css("width", width);
                    $(".zj_3").css("background", 'rgb(0,97,139)');
                    $(".zj_1").css("width", zjdd_target_width);
                }
                $(".zj_2").css("width", zjdd_work_width);

                //设置民安的就诊数据
                $(".ma_1_span").text("全天 ：" + data.gzma_jzNum.totalNum);
                $(".ma_2_span").text(type + data.gzma_jzNum.workNum);
                $(".ma_3 span").text("目标 ：" + gzma_target);
                var gzma_total_width = GetPercent(data.gzma_jzNum.totalNum, long);
                var gzma_work_width = GetPercent(data.gzma_jzNum.workNum, long);
                var gzma_target_width = GetPercent(gzma_target, long);
                if (gzma_target > data.gzma_jzNum.totalNum) {
                    var width = GetPercent(gzma_target - data.gzma_jzNum.totalNum, long);
                    $(".ma_3").css("width", width);
                    $(".ma_1").css("width", gzma_total_width);
                } else {
                    var width = GetPercent(data.gzma_jzNum.totalNum - gzma_target, long);
                    $(".ma_3").css("width", width);
                    $(".ma_3").css("background", 'rgb(0,97,139)');
                    $(".ma_1").css("width", gzma_target_width);
                }
                $(".ma_2").css("width", gzma_work_width);

                //设置深圳远大的就诊数据
                $(".yd_1_span").text("全天 ：" + data.szyd_jzNum.totalNum);
                $(".yd_2_span").text(type + data.szyd_jzNum.workNum);
                $(".yd_3 span").text("目标 ：" + szyd_target);
                var szyd_total_width = GetPercent(data.szyd_jzNum.totalNum, long);
                var szyd_work_width = GetPercent(data.szyd_jzNum.workNum, long);
                var szyd_target_width = GetPercent(szyd_target, long);
                if (szyd_target > data.szyd_jzNum.totalNum) {
                    var width = GetPercent(szyd_target - data.szyd_jzNum.totalNum, long);
                    $(".yd_3").css("width", width);
                    $(".yd_1").css("width", szyd_total_width);
                } else {
                    var width = GetPercent(data.szyd_jzNum.totalNum - szyd_target, long);
                    $(".yd_3").css("width", width);
                    $(".yd_3").css("background", 'rgb(0,97,139)');
                    $(".yd_1").css("width", szyd_target_width);
                }
                $(".yd_2").css("width", szyd_work_width);

                //设置广州东大的就诊数据
                $(".dd_1_span").text("全天 ：" + data.gzdd_jzNum.totalNum);
                $(".dd_2_span").text(type + data.gzdd_jzNum.workNum);
                $(".dd_3 span").text("目标 ：" + gzdd_target);
                var gzdd_total_width = GetPercent(data.gzdd_jzNum.totalNum, long);
                var gzdd_work_width = GetPercent(data.gzdd_jzNum.workNum, long);
                var gzdd_target_width = GetPercent(gzdd_target, long);
                if (gzdd_target > data.gzdd_jzNum.totalNum) {
                    var width = GetPercent(gzdd_target - data.gzdd_jzNum.totalNum, long);
                    $(".dd_3").css("width", width);
                    $(".dd_1").css("width", gzdd_total_width);
                } else {
                    var width = GetPercent(data.gzdd_jzNum.totalNum - gzdd_target, long);
                    $(".dd_3").css("width", width);
                    $(".dd_3").css("background", 'rgb(0,97,139)');
                    $(".dd_1").css("width", gzdd_target_width);
                }
                $(".dd_2").css("width", gzdd_work_width);
            }
        });
    }

//获取预约的数据
    function getyySource() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "getyyNum.php",
            success: function (data) {
                var zjdd_target = 7;
                var gzma_target = 17;
                var gzdd_target = 24;
                var szyd_target = 34;
                var max_nums = [data.zjdd_yyNum.totalNum, data.gzma_yyNum.totalNum, data.szyd_yyNum.totalNum, data.gzdd_yyNum.totalNum, zjdd_target, gzma_target, szyd_target, gzdd_target];
                var maxInNum = Math.max.apply(Math, max_nums);
                var j = Math.ceil(maxInNum / 27) === 0 ? 10 : Math.ceil(maxInNum / 27);
                var long = j * 27;
                //生成预约的横坐标
                var strText = "";
                for (var i = 0; i <= long; i++) {
                    if (i % j == 0) {
                        strText += "<li>" + i + "</li>";
                    }
                }
                var nowdate = getNowDate();
                $(".chart_title").text(nowdate + "四院预约量");
                $(".dd_3").css("background", 'rgba(0,0,0,0.25)');
                $(".yd_3").css("background", 'rgba(0,0,0,0.25)');
                $(".ma_3").css("background", 'rgba(0,0,0,0.25)');
                $(".zj_3").css("background", 'rgba(0,0,0,0.25)');
                $(".bottomNum").html(strText);
                var todayTime = moment().format('HH:mm:ss');
                $(".bottomNum").append("<li style='color:red;'>" + todayTime + "</li>");
                var type = getType();
                //设置湛江的预约数据
                $(".zj_1_span").text("全天 ：" + data.zjdd_yyNum.totalNum);
                $(".zj_2_span").text(type + data.zjdd_yyNum.workNum);
                $(".zj_3 span").text("目标 ：" + zjdd_target);
                var zjdd_total_width = GetPercent(data.zjdd_yyNum.totalNum, long);
                var zjdd_work_width = GetPercent(data.zjdd_yyNum.workNum, long);
                var zjdd_target_width = GetPercent(zjdd_target, long);
                if (zjdd_target > data.zjdd_yyNum.totalNum) {
                    var width = GetPercent(zjdd_target - data.zjdd_yyNum.totalNum, long);
                    $(".zj_3").css("width", width);
                    $(".zj_1").css("width", zjdd_total_width);
                } else {
                    var width = GetPercent(data.zjdd_yyNum.totalNum - zjdd_target, long);
                    $(".zj_3").css("width", width);
                    $(".zj_3").css("background", 'rgb(0,97,139)');
                    $(".zj_1").css("width", zjdd_target_width);
                }
                $(".zj_2").css("width", zjdd_work_width);

                //设置民安的预约数据
                $(".ma_1_span").text("全天 ：" + data.gzma_yyNum.totalNum);
                $(".ma_2_span").text(type + data.gzma_yyNum.workNum);
                $(".ma_3 span").text("目标 ：" + gzma_target);
                var gzma_total_width = GetPercent(data.gzma_yyNum.totalNum, long);
                var gzma_work_width = GetPercent(data.gzma_yyNum.workNum, long);
                var gzma_target_width = GetPercent(gzma_target, long);
                if (gzma_target > data.gzma_yyNum.totalNum) {
                    var width = GetPercent(gzma_target - data.gzma_yyNum.totalNum, long);
                    $(".ma_3").css("width", width);
                    $(".ma_1").css("width", gzma_total_width);
                } else {
                    var width = GetPercent(data.gzma_yyNum.totalNum - gzma_target, long);
                    $(".ma_3").css("width", width);
                    $(".ma_3").css("background", 'rgb(0,97,139)');
                    $(".ma_1").css("width", gzma_target_width);
                }
                $(".ma_2").css("width", gzma_work_width);

                //设置民安的预约数据
                $(".yd_1_span").text("全天 ：" + data.szyd_yyNum.totalNum);
                $(".yd_2_span").text(type + data.szyd_yyNum.workNum);
                $(".yd_3 span").text("目标 ：" + szyd_target);
                var szyd_total_width = GetPercent(data.szyd_yyNum.totalNum, long);
                var szyd_work_width = GetPercent(data.szyd_yyNum.workNum, long);
                var szyd_target_width = GetPercent(szyd_target, long);
                if (szyd_target > data.szyd_yyNum.totalNum) {
                    var width = GetPercent(szyd_target - data.szyd_yyNum.totalNum, long);
                    $(".yd_3").css("width", width);
                    $(".yd_1").css("width", szyd_total_width);
                } else {
                    var width = GetPercent(data.szyd_yyNum.totalNum - szyd_target, long);
                    $(".yd_3").css("width", width);
                    $(".yd_3").css("background", 'rgb(0,97,139)');
                    $(".yd_1").css("width", szyd_target_width);
                }
                $(".yd_2").css("width", szyd_work_width);

                //设置广州东大的预约数据
                $(".dd_1_span").text("全天 ：" + data.gzdd_yyNum.totalNum);
                $(".dd_2_span").text(type + data.gzdd_yyNum.workNum);
                $(".dd_3 span").text("目标 ：" + gzdd_target);
                var gzdd_total_width = GetPercent(data.gzdd_yyNum.totalNum, long);
                var gzdd_work_width = GetPercent(data.gzdd_yyNum.workNum, long);
                var gzdd_target_width = GetPercent(gzdd_target, long);
                if (gzdd_target > data.gzdd_yyNum.totalNum) {
                    var width = GetPercent(gzdd_target - data.gzdd_yyNum.totalNum, long);
                    $(".dd_3").css("width", width);
                    $(".dd_1").css("width", gzdd_total_width);
                } else {
                    var width = GetPercent(data.gzdd_yyNum.totalNum - gzdd_target, long);
                    $(".dd_3").css("width", width);
                    $(".dd_3").css("background", 'rgb(0,97,139)');
                    $(".dd_1").css("width", gzdd_target_width);
                }
                $(".dd_2").css("width", gzdd_work_width);
            }
        });
    }

///计算两个整数的百分比值 
    function GetPercent(num, total) {
        num = parseFloat(num);
        total = parseFloat(total);
        if (isNaN(num) || isNaN(total)) {
            return "-";
        }
        return total <= 0 ? "0%" : (Math.round(num / total * 10000) / 100.00 + "%");
    }

    function  getType() {
        var str = "";
        var dayeStart = "00:00:00";
        var zaoStart = "08:00:00";
        var wanStart = "16:00:00";
        var wanEnd = "24:00:00";
        var nowdate = moment().format('HH:mm:ss');
        if (nowdate >= dayeStart && nowdate < zaoStart) {
            str = "大夜 ：";
        }
        if (nowdate >= zaoStart && nowdate < wanStart) {
            str = "早班 ：";
        }
        if (nowdate >= wanStart && nowdate < wanEnd) {
            str = "晚班 ：";
        }
        return str;
    }


    function showFix(str, i)
    {
        if (i >= str.length)
        {
            return;
        }
        $(".fixed").html(str[i]);
        $(".fixed").css("display", "block");
        $('#chatAudio')[0].play();
        setTimeout(hideFix, 10000);
        i++;
        setTimeout(function () {
            showFix(str, i);
        }, 13000);
    }
    function hideFix() {
        $(".fixed").css("display", "none");
        $(".fixed").html();
    }

    //获取最新的就诊人数据
    function getjzNew() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "getjzNew.php?action=s",
            success: function (data) {
                if (data.length > 0) {
                    var str = [];
                    for (var i = 0; i < data.length; i++) {
                        str[i] = "<div><p>恭喜" + data[i].awr + "预约的患者" + data[i].rname + "</p><p>已于今天" + data[i].tstime + "到院就诊！</p></div>";
                    }
                    if (str.length > 1) {
                        showFix(str, 0);
                    } else {
                        $(".fixed").html(str[0]);
                        $(".fixed").css("display", "block");
                        $('#chatAudio')[0].play();
                        setTimeout(hideFix, 10000);
                    }
                }
            }
        });
    }

    function getNowDate() {
        var ymd = moment().format('YYYY年MM月DD日');
        var weekarray = ["日", "一", "二", "三", "四", "五", "六"];
        var w = moment().format('d');
        var strDate = ymd + " ( 周" + weekarray[w] + " ) ";
        return strDate;
    }
});
