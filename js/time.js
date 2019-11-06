$(document).ready(function () {
    var myDate = new Date();
    var year = myDate.getFullYear();//获取完整的年份(4位,1970-????)
    var month = myDate.getMonth();//获取当前月份(0-11,0代表1月)
    var day = myDate.getDate();//获取当前日(1-31)
    var i = 0;
    // 添加年份
    for (i = 2016; i <= 2026; i++) {
        addOption(birth_year, i, i);
        if (i == year) {
            birth_year.options[year - 2016].selected = true;
        }
    }
    // 添加月份
    for (i = 1; i <= 12; i++) {
        if (i < 10) {
            i = '0' + i;
        }
        addOption(birth_month, i, i);
        if (i == month + 1) {
            birth_month.options[month].selected = true;
        }
    }
    // 添加天份，先默认31天
    for (i = 1; i <= 31; i++) {
        if (i < 10) {
            i = '0' + i;
        }
        addOption(birth_day, i, i);
        if (i == day) {
            birth_day.options[day - 1].selected = true;
        }
    }
    //$("#birth_month"). birth_year  birth_day
});


// 设置每个月份的天数
function setDays(year, month, day) {
    var monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var yea = year.options[year.selectedIndex].text;
    var mon = month.options[month.selectedIndex].text;
    var num = monthDays[mon - 1];
    if (mon == 2 && isLeapYear(yea)) {
        num++;
    }
    for (var j = day.options.length - 1; j >= num; j--) {
        day.remove(j);
    }
    for (var i = day.options.length+1; i <= num; i++) {
        addOption(birth_day, i, i);
    }

}

// 判断是否闰年
function isLeapYear(year)
{
    return (year % 4 == 0 || (year % 100 == 0 && year % 400 == 0));
}

// 向select尾部添加option
function addOption(selectbox, text, value) {
    var option = document.createElement("option");
    option.text = text;
    option.value = value;
    selectbox.options.add(option);
}