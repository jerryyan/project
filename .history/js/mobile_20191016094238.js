
//设置预约数据
function setyySource() {
    var y = $(".year option:selected").text();
    var m = $(".month option:selected").text();
    var d = $(".day option:selected").text();
    var datetime = y + "-" + m + "-" + d;
    // alert(datetime);
    getyySource(datetime);
}

//设置就诊数据
function setjzSource() {
    var y = $(".year option:selected").text();
    var m = $(".month option:selected").text();
    var d = $(".day option:selected").text();
    var datetime = y + "-" + m + "-" + d;
    getjzSource(datetime);
}

////设置预约排行
//function setyyAwrNum() {
//    var y = $(".year option:selected").text();
//    var m = $(".month option:selected").text();
//    var d = $(".day option:selected").text();
//    var datetime = y + "-" + m + "-" + d;
//    getyyAwrNum(datetime);
//}

//设置就诊排行
//function setjzAwrNum() {
//    var y = $(".year option:selected").text();
//    var m = $(".month option:selected").text();
//    var d = $(".day option:selected").text();
//    var datetime = y + "-" + m + "-" + d;
//    getjzAwrNum(datetime);
//}

//获取预约的数据
function getyySource(datetime) {
    if (datetime != undefined) {
        var nowdate = getNowDate(datetime);
        $(".title").text(nowdate + "四院预约量");
        datetime = moment(datetime).format('YYYY-MM-DD');
    }
    $.ajax({
        type: "post",
        data: {datetime: datetime},
        dataType: "json",
        url: "getyyNum.php",
        success: function (data) {
            var zjdd_target = 7;
            var nndd_target = 17;
            var gzdd_target = 32;
            var szyd_target = 34;
            var szty_target = 25;
            var szydwc_target = 10;
            var max_nums = [data.zjdd_yyNum.totalNum, data.nndd_yyNum.totalNum, data.szyd_yyNum.totalNum, data.gzdd_yyNum.totalNum, zjdd_target, nndd_target, szyd_target, gzdd_target, szydwc_target];
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
            var type = getType();
            //设置天元的预约数据
            $(".ty_1 span").text("全天 ：" + data.szty_yyNum.totalNum);
            $(".ty_2 span").text(type + data.szty_yyNum.workNum);
            $(".ty_3 span").text("目标 ：" + szty_target);
            var tydd_total_height = GetPercent(data.szty_yyNum.totalNum, long);
            var tydd_work_height = GetPercent(data.szty_yyNum.workNum, long);
            var tydd_target_height = GetPercent(szty_target, long);
            $(".ty_3").css("height", tydd_target_height);
            $(".ty_1").css("height", tydd_total_height);
            $(".ty_2").css("height", tydd_work_height);

            //设置湛江的预约数据
            $(".zj_1 span").text("全天 ：" + data.zjdd_yyNum.totalNum);
            $(".zj_2 span").text(type + data.zjdd_yyNum.workNum);
            $(".zj_3 span").text("目标 ：" + zjdd_target);
            var zjdd_total_height = GetPercent(data.zjdd_yyNum.totalNum, long);
            var zjdd_work_height = GetPercent(data.zjdd_yyNum.workNum, long);
            var zjdd_target_height = GetPercent(zjdd_target, long);
            $(".zj_3").css("height", zjdd_target_height);
            $(".zj_1").css("height", zjdd_total_height);
            $(".zj_2").css("height", zjdd_work_height);

            //设置南宁的预约数据
            $(".ma_1 span").text("全天 ：" + data.nndd_yyNum.totalNum);
            $(".ma_2 span").text(type + data.nndd_yyNum.workNum);
            $(".ma_3 span").text("目标 ：" + nndd_target);
            var nndd_total_height = GetPercent(data.nndd_yyNum.totalNum, long);
            var nndd_work_height = GetPercent(data.nndd_yyNum.workNum, long);
            var nndd_target_height = GetPercent(nndd_target, long);
            $(".ma_3").css("height", nndd_target_height);
            $(".ma_1").css("height", nndd_total_height);
            $(".ma_2").css("height", nndd_work_height);


            $(".yc_1 span").text("全天 ：" + data.szydwc_yyNum.totalNum);
            $(".yc_2 span").text(type + data.szydwc_yyNum.workNum);
            $(".yc_3 span").text("目标 ：" + szydwc_target);
            var szydwc_total_height = GetPercent(data.szydwc_yyNum.totalNum, long);
            var szydwc_work_height = GetPercent(data.szydwc_yyNum.workNum, long);
            var szydwc_target_height = GetPercent(szydwc_target, long);
            $(".yc_3").css("height", szydwc_target_height);
            $(".yc_1").css("height", szydwc_total_height);
            $(".yc_2").css("height", szydwc_work_height);

            //设置远大的预约数据
            $(".yd_1 span").text("全天 ：" + data.szyd_yyNum.totalNum);
            $(".yd_2 span").text(type + data.szyd_yyNum.workNum);
            $(".yd_3 span").text("目标 ：" + szyd_target);
            var szyd_total_height = GetPercent(data.szyd_yyNum.totalNum, long);
            var szyd_work_height = GetPercent(data.szyd_yyNum.workNum, long);
            var szyd_target_height = GetPercent(szyd_target, long);
            $(".yd_3").css("height", szyd_target_height);
            $(".yd_1").css("height", szyd_total_height);
            $(".yd_2").css("height", szyd_work_height);

            //设置广州东大的预约数据
            $(".dd_1 span").text("全天 ：" + data.gzdd_yyNum.totalNum);
            $(".dd_2 span").text(type + data.gzdd_yyNum.workNum);
            $(".dd_3 span").text("目标 ：" + gzdd_target);
            var gzdd_total_height = GetPercent(data.gzdd_yyNum.totalNum, long);
            var gzdd_work_height = GetPercent(data.gzdd_yyNum.workNum, long);
            var gzdd_target_height = GetPercent(gzdd_target, long);
            $(".dd_3").css("height", gzdd_target_height);
            $(".dd_1").css("height", gzdd_total_height);
            $(".dd_2").css("height", gzdd_work_height);
        }
    });
}


//获取就诊的数据
function getjzSource(datetime) {
    if (datetime != undefined) {
        var nowdate = getNowDate(datetime);
        $(".title").text(nowdate + "四院就诊量");
        datetime = moment(datetime).format('YYYY-MM-DD');
    }
    $.ajax({
        type: "post",
        data: {datetime: datetime},
        dataType: "json",
        url: "getjzNum.php",
        success: function (data) {
            var zjdd_target = 4;
            var nndd_target = 10;
            var gzdd_target = 14;
            var tydd_target = 13;
            var szyd_target = 20;
             var szydwc_target = 8;
            var max_nums = [data.zjdd_jzNum.totalNum, data.nndd_jzNum.totalNum, data.szyd_jzNum.totalNum, data.gzdd_jzNum.totalNum, zjdd_target, nndd_target, szyd_target, gzdd_target,szydwc_target];
            var maxInNum = Math.max.apply(Math, max_nums);
            var j = Math.ceil(maxInNum / 19);
            var long = j * 19;
            var strText = "";
            //生成预约的纵坐标
            var strText = "";
            for (var i = long; i >= 0; i--) {
                if (i % j == 0) {
                    strText += "<li>" + i + "</li>";
                }
            }
            $(".num").html(strText);
            var type = getType();
            //设置天元的就诊数据
            $(".ty_1 span").text("全天 ：" + data.szty_jzNum.totalNum);
            $(".ty_2 span").text(type + data.szty_jzNum.workNum);
            $(".ty_3 span").text("目标 ：" + tydd_target);
            var tydd_total_height = GetPercent(data.szty_jzNum.totalNum, long);
            var tydd_work_height = GetPercent(data.szty_jzNum.workNum, long);
            var tydd_target_height = GetPercent(tydd_target, long);
            $(".ty_3").css("height", tydd_target_height);
            $(".ty_1").css("height", tydd_total_height);
            $(".ty_2").css("height", tydd_work_height);
            //设置湛江的就诊数据
            $(". _1 span").text("全天 ：" + data.zjdd_jzNum.totalNum);
            $(". _2 span").text(type + data.zjdd_jzNum.workNum);
            $(". _3 span").text("目标 ：" + tydd_target);
            var tydd_total_height = GetPercent(data.zjdd_jzNum.totalNum, long);
            var tydd_work_height = GetPercent(data.zjdd_jzNum.workNum, long);
            var tydd_target_height = GetPercent(tydd_target, long);
            $(".ty_3").css("height", tydd_target_height);
            $(".ty_1").css("height", tydd_total_height);
            $(".ty_2").css("height", tydd_work_height);

            //设置南宁的就诊数据
            $(".ma_1 span").text("全天 ：" + data.nndd_jzNum.totalNum);
            $(".ma_2 span").text(type + data.nndd_jzNum.workNum);
            $(".ma_3 span").text("目标 ：" + nndd_target);
            var nndd_total_height = GetPercent(data.nndd_jzNum.totalNum, long);
            var nndd_work_height = GetPercent(data.nndd_jzNum.workNum, long);
            var nndd_target_height = GetPercent(nndd_target, long);
            $(".ma_3").css("height", nndd_target_height);
            $(".ma_1").css("height", nndd_total_height);
            $(".ma_2").css("height", nndd_work_height);

            //设置深圳远大肛肠的就诊数据
            $(".yd_1 span").text("全天 ：" + data.szyd_jzNum.totalNum);
            $(".yd_2 span").text(type + data.szyd_jzNum.workNum);
            $(".yd_3 span").text("目标 ：" + szyd_target);
            var szyd_total_height = GetPercent(data.szyd_jzNum.totalNum, long);
            var szyd_work_height = GetPercent(data.szyd_jzNum.workNum, long);
            var szyd_target_height = GetPercent(szyd_target, long);
            $(".yd_3").css("height", szyd_target_height);
            $(".yd_1").css("height", szyd_total_height);
            $(".yd_2").css("height", szyd_work_height);
            
                      //设置深圳远大胃肠的就诊数据
            $(".yc_1 span").text("全天 ：" + data.szydwc_jzNum.totalNum);
            $(".yc_2 span").text(type + data.szydwc_jzNum.workNum);
            $(".yc_3 span").text("目标 ：" + szydwc_target);
            var szydwc_total_height = GetPercent(data.szydwc_jzNum.totalNum, long);
            var szydwc_work_height = GetPercent(data.szydwc_jzNum.workNum, long);
            var szydwc_target_height = GetPercent(szydwc_target, long);
            $(".yc_3").css("height", szydwc_target_height);
            $(".yc_1").css("height", szydwc_total_height);
            $(".yc_2").css("height", szydwc_work_height);

            //设置广州东大的就诊数据
            $(".dd_1 span").text("全天 ：" + data.gzdd_jzNum.totalNum);
            $(".dd_2 span").text(type + data.gzdd_jzNum.workNum);
            $(".dd_3 span").text("目标 ：" + gzdd_target);
            var gzdd_total_height = GetPercent(data.gzdd_jzNum.totalNum, long);
            var gzdd_work_height = GetPercent(data.gzdd_jzNum.workNum, long);
            var gzdd_target_height = GetPercent(gzdd_target, long);
            $(".dd_3").css("height", gzdd_target_height);
            $(".dd_1").css("height", gzdd_total_height);
            $(".dd_2").css("height", gzdd_work_height);
        }
    });
}

//获取预约咨询人排行
function getyyAwrNum(datetime) {
    if (datetime != undefined) {
        var nowdate = getNowDate(datetime);
        $(".title").text(nowdate + "咨询预约排行");
        datetime = moment(datetime).format('YYYY-MM-DD');
    }
    $.ajax({
        type: "post",
        data: {datetime: datetime},
        dataType: "json",
        url: "getyyAwrNum.php",
        success: function (data) {
            var str = "";
            len = Math.ceil(data.length / 10);
            str += "<tr style='color:#666'><td width='100'>名次</td><td width='150'>姓名</td><td width='150'>所属组</td><td width='150'>预约</td></tr>";
            for (var i = 0; i < data.length; i++) {
                str += "<tr><td>" + eval(i + 1) + "</td><td>" + data[i].awr + "</td><td>" + data[i].gp + "</td><td>" + data[i].nums + "</td></tr>";
            }
            $(".content").html(str);
        }
    });
}

//获取预约咨询人排行
function getjzAwrNum(datetime) {
    if (datetime != undefined) {
        var nowdate = getNowDate(datetime);
        $(".title").text(nowdate + "咨询就诊排行");
        datetime = moment(datetime).format('YYYY-MM-DD');
    }
    $.ajax({
        type: "post",
        data: {datetime: datetime},
        dataType: "json",
        url: "getjzAwrNum.php",
        success: function (data) {
            var str = "";
            len = Math.ceil(data.length / 10);
            str += "<tr style='color:#666'><td width='100'>名次</td><td width='150'>姓名</td><td width='150'>所属组</td><td width='150'>预约</td></tr>";
            for (var i = 0; i < data.length; i++) {
                str += "<tr><td>" + eval(i + 1) + "</td><td>" + data[i].awr + "</td><td>" + data[i].gp + "</td><td>" + data[i].nums + "</td></tr>";
            }
            $(".content").html(str);
        }
    });
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

//计算两个整数的百分比值 
function GetPercent(num, total) {
    num = parseFloat(num);
    total = parseFloat(total);
    if (isNaN(num) || isNaN(total)) {
        return "-";
    }
    return total <= 0 ? "0%" : (Math.round(num / total * 10000) / 100.00 + "%");
}

function getNowDate(datetime) {
    var md = moment(datetime).format('MM月DD日');
    var weekarray = ["日", "一", "二", "三", "四", "五", "六"];
    var w = moment(datetime).format('d');
    var strDate = md + " ( 周" + weekarray[w] + " ) ";
    return strDate;
}
