<?php

require_once '../config.php';
if (!empty($_POST['datetime'])) {
    $date = $_POST['datetime'];
}
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$data = array();
if ($_POST['type'] == 'zjdd') {
    $zjdd_yy_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%' and dr=0   and ts >='{$startDate}' and ts<='{$endDate}'";
    $zjdd_yy_row = get_fetchAll_assoc($zjdd, $zjdd_yy_sql);
    $zjdd_yyNum = getAllNum($zjdd_yy_row, $date);
    $zjdd_jz_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $zjdd_jz_row = get_fetchAll_assoc($zjdd, $zjdd_jz_sql);
    $zjdd_jzNum = getAllNum($zjdd_jz_row, $date);
    $data['yyNum'] = $zjdd_yyNum;
    $data['jzNum'] = $zjdd_jzNum;
} elseif ($_POST['type'] == 'gzma') {
    $gzma_yy_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%' and dr=0  and ts >='{$startDate}' and ts<='{$endDate}'";
    $gzma_yy_row = get_fetchAll_assoc($gzma, $gzma_yy_sql);
    $gzma_yyNum = getAllNum($gzma_yy_row, $date);
    $gzma_jz_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $gzma_jz_row = get_fetchAll_assoc($gzma, $gzma_jz_sql);
    $gzma_jzNum = getAllNum($gzma_jz_row, $date);
    $data['yyNum'] = $gzma_yyNum;
    $data['jzNum'] = $gzma_jzNum;
} elseif ($_POST['type'] == 'szyd') {
    $szyd_yy_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where (department='肛肠外科' or department='肛肠科') and dr=0  and  media in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and gn not in ('胃肠组','胃肠大夜班') and ts >='{$startDate}' and ts<='{$endDate}'";
    $szyd_yy_row = get_fetchAll_assoc($szyd, $szyd_yy_sql);
    $szyd_yyNum = getAllNum($szyd_yy_row, $date);
    $szyd_jz_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId  LEFT JOIN Info_Appointment_Group as c on b.awr=c.userCode where rdepartment like '肛%' and a.dr=0 and rmedia in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and groupName not in ('胃肠组','胃肠大夜班') and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $szyd_jz_row = get_fetchAll_assoc($szyd, $szyd_jz_sql);
    $szyd_jzNum = getAllNum($szyd_jz_row, $date);
    $data['yyNum'] = $szyd_yyNum;
    $data['jzNum'] = $szyd_jzNum;
} elseif ($_POST['type'] == 'gzdd') {
    $gzdd_yy_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department not like '%未预约%'  and dr=0 and ts >='{$startDate}' and ts<='{$endDate}'";
    $gzdd_yy_row = get_fetchAll_assoc($gzdd, $gzdd_yy_sql);
    $gzdd_yyNum = getAllNum($gzdd_yy_row, $date);
    $gzdd_jz_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $gzdd_jz_row = get_fetchAll_assoc($gzdd, $gzdd_jz_sql);
    $gzdd_jzNum = getAllNum($gzdd_jz_row, $date);
    $data['yyNum'] = $gzdd_yyNum;
    $data['jzNum'] = $gzdd_jzNum;
} elseif ($_POST['type'] == 'gdmaxq') {
    $gzdd_yy_sql = "select anumber,aname,sex,tel,department,media,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where dr=0 and ts >='{$startDate}' and ts<='{$endDate}' order by anumber";
    $gzdd_yy_row = get_fetchAll_assoc($gzma, $gzdd_yy_sql);
    $gzdd_jz_sql = "select department,isappointment,rnumber,rname,rmedia,rsex,rtel,rdepartment,awr,a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where  a.dr=0 and  a.ts >'{$startDate}' and a.ts <='{$endDate}' order by isappointment desc,rnumber asc";
    $gzdd_jz_row = get_fetchAll_assoc($gzma, $gzdd_jz_sql);
    $data['yyNum'] = $gzdd_yy_row;
    $data['jzNum'] = $gzdd_jz_row;
} elseif ($_POST['type'] == 'szydwc') {
    $szyd_yy_sql = "select gn,department,ts,awr,convert(varchar(10),ts,108) as tstime from info_appointment where department like '%肛%' and  gn not like '%胃肠%' and dr=0 and media in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and ts >='{$startDate}' and ts<='{$endDate}'";
    $szyd_yy_row = get_fetchAll_assoc($szyd, $szyd_yy_sql);
    $szyd_yyNum = getAllNum($szyd_yy_row, $date);
    $szyd_yyNum['dayeNum'] = $szyd_yyNum['dayeNum'];
    $szyd_jz_sql = "select gn,a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  not like '%未预约%' and a.dr=0 and  gn like '%胃肠%' and rmedia in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $szyd_jz_row = get_fetchAll_assoc($szyd, $szyd_jz_sql);
    $szyd_jzNum = getAllNum($szyd_jz_row, $date);
    $szyd_jzNum['dayeNum'] = $szyd_jzNum['dayeNum'];
    $data['yyNum'] = $szyd_yyNum;
    $data['jzNum'] = $szyd_jzNum;
} elseif ($_POST['type'] == 'nngc') {
    $nngc_yy_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime  from info_appointment where (department not in ('未预约','耳鼻喉科')  and sourceType !='自然门诊' and symptom !='体检' ) and gn like '%肛肠%'  and ts >='{$startDate}' and ts<='{$endDate}'";
    $nngc_yy_row = get_fetchAll_assoc($nndd, $nngc_yy_sql);
    $nngc_yyNum = getAllNum($nngc_yy_row, $date);
    $nngc_jz_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime  from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not in ('未预约','耳鼻喉科')and a.dr=0 and isappointment=1 and rsourceType !='自然门诊' and rsymptom !='体检'  and gn like '%肛肠%'    and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $nngc_jz_row = get_fetchAll_assoc($nndd, $nngc_jz_sql);
    $nngc_jzNum = getAllNum($nngc_jz_row, $date);
    $data['yyNum'] = $nngc_yyNum;
    $data['jzNum'] = $nngc_jzNum;
} elseif ($_POST['type'] == 'nnwc') {
    $nnwc_yy_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime  from info_appointment where department not in ('未预约','耳鼻喉科') and dr=0  and sourceType !='自然门诊' and symptom !='体检'  and gn like '%胃肠%' and ts >='{$startDate}' and ts<='{$endDate}'";
    $nnwc_yy_row = get_fetchAll_assoc($nndd, $nnwc_yy_sql);
    $nnwc_yyNum = getAllNum($nnwc_yy_row, $date);
    $nnwc_jz_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime  from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and rsourceType !='自然门诊' and rsymptom !='体检' and gn like '%胃肠%' and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $nnwc_jz_row = get_fetchAll_assoc($nndd, $nnwc_jz_sql);
    $nnwc_jzNum = getAllNum($nnwc_jz_row, $date);
    $data['yyNum'] = $nnwc_yyNum;
    $data['jzNum'] = $nnwc_jzNum;
} elseif ($_POST['type'] == 'szty') {
    $nnwc_yy_sql = "select department,ts,awr,convert(varchar(10),ts,108) as tstime  from info_appointment where department not like '%未预约%' and dr=0  and ts >='{$startDate}' and ts<='{$endDate}'";
    $nnwc_yy_row = get_fetchAll_assoc($nndd, $nnwc_yy_sql);
    $nnwc_yyNum = getAllNum($nnwc_yy_row, $date);
    $nnwc_jz_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime  from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
    $nnwc_jzNum = getAllNum($nnwc_jz_row, $date);
    $data['yyNum'] = $nnwc_yyNum;
    $data['jzNum'] = $nnwc_jzNum;
}
echo json_encode($data);
