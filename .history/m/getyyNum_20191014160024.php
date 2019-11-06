<?php

require_once '../config.php';
if (!empty($_POST['datetime'])) {
    $date = $_POST['datetime'];
}
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$zjdd_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%' and dr=0 and ts >='{$startDate}' and ts<='{$endDate}'";
$nndd_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where (department not like '%未预约%' and department not like '%耳鼻喉科%') and  dr=0 and sourceType !='自然门诊' and symptom !='体检'  and ts >='{$startDate}' and ts<='{$endDate}'";
//设置湛江的预约数据
$(".zj_1 span").text("全天 ：" + data.zjdd_yyNum.totalNum);
$(".zj_2 span").text(type + data.zjdd_yyNum.workNum);
$(".zj_3 span").text("目标 ：" + zjdd_target);
var zjdd_total_height = GetPercent(data.zjdd_yyNum.totalNum, long);
var zjdd_work_height = GetPercent(data.zjdd_yyNum.workNum, long);
var zjdd_target_height = GetPercent(zjdd_target, long);
$(".zj_3").css("height", zjdd_target_height);
$(".zj_1").css("height", zjdd_total_height);
$(".zj_2").css("height", zjdd_work_height);$szydwc_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department  not like '%未预约%' and dr=0 and  gn like '%胃肠%' and media in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and ts >='{$startDate}' and ts<='{$endDate}'";
$gzdd_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%' and dr=0  and ts >='{$startDate}' and ts<='{$endDate}'";
$zjdd_yy_row = get_fetchAll_assoc($zjdd, $zjdd_sql);
$zjdd_yyNum = getAllNum($zjdd_yy_row, $date);

$nndd_yy_row = get_fetchAll_assoc($nndd, $nndd_sql);
$nndd_yyNum = getAllNum($nndd_yy_row, $date);

$szyd_yy_row = get_fetchAll_assoc($szyd, $szyd_sql);
$szyd_yyNum = getAllNum($szyd_yy_row, $date);

$szydwc_yy_row = get_fetchAll_assoc($szyd, $szydwc_sql);
$szydwc_yyNum = getAllNum($szydwc_yy_row, $date);

$gzdd_yy_row = get_fetchAll_assoc($gzdd, $gzdd_sql);
$gzdd_yyNum = getAllNum($gzdd_yy_row, $date);

$data = array();
$data['zjdd_yyNum'] = $zjdd_yyNum;
$data['nndd_yyNum'] = $nndd_yyNum;
$data['szyd_yyNum'] = $szyd_yyNum;
$data['szydwc_yyNum'] = $szydwc_yyNum;
$data['gzdd_yyNum'] = $gzdd_yyNum;
echo json_encode($data);

