function getjzSource() {
    $.ajax({
        type: "post",
        dataType: "json",
        url: "getjzNum.php",
        success: function (data) {
            var zjdd_target = 30;
            var gzma_target = 50;
            //var gzdd_target = 40;
            var szyd_target = 80;
            var max_nums = [data.zjdd_jzNum.totalNum, data.gzma_jzNum.totalNum, data.szyd_jzNum.totalNum, zjdd_target, gzma_target, szyd_target];
            var maxInNum = Math.max.apply(Math, max_nums);
            var j = Math.ceil(maxInNum / 25) === 0 ? 10 : Math.ceil(maxInNum / 25);
            var long = j * 25;
            var strText = "";
            for (var i = 0; i <= long; i++) {
                if (i % j == 0) {
                    strText += "<li>" + i + "</li>";
                }
            }
            $(".bottomNum").html(strText);
            var type = getType();
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

            // console.log(da);
        }
    });
}