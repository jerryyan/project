<?php

require_once 'config.php';
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$zjdd_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%' and dr=0 and media in ('百度','百度电话','QQ','网查','网电','网络电话','网转电','网转QQ') and ts >='{$startDate}' and ts<='{$endDate}'";
$gzma_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%' and dr=0 and  ts >='{$startDate}' and ts<='{$endDate}'";
$szyd_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where (department='肛肠外科' or department='肛肠科') and dr=0 and  media in ('百度','QQ','qq','手机网','百度商桥','网站后台预约','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','神马','搜狗','回访组回访','网络其它','360','个人微信') and ts >='{$startDate}' and ts<='{$endDate}'";
$gzdd_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%' and dr=0  and ts >='{$startDate}' and ts<='{$endDate}'";
$zjdd_yy_row = get_fetchAll_assoc($zjdd, $zjdd_sql);
$zjdd_yyNum = getAllNum($zjdd_yy_row, $date);

$gzma_yy_row = get_fetchAll_assoc($gzma, $gzma_sql);
$gzma_yyNum = getAllNum($gzma_yy_row, $date);

$szyd_yy_row = get_fetchAll_assoc($szyd, $szyd_sql);
$szyd_yyNum = getAllNum($szyd_yy_row, $date);

$gzdd_yy_row = get_fetchAll_assoc($gzdd, $gzdd_sql);
$gzdd_yyNum = getAllNum($gzdd_yy_row, $date);

$data = array();
$data['zjdd_yyNum'] = $zjdd_yyNum;
$data['gzma_yyNum'] = $gzma_yyNum;
$data['szyd_yyNum'] = $szyd_yyNum;
$data['gzdd_yyNum'] = $gzdd_yyNum;
echo json_encode($data);

