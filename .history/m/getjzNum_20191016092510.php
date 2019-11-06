<?php

require_once '../config.php';
if (!empty($_POST['datetime'])) {
    $date = $_POST['datetime'];
}
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$zjdd_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and  awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
//$gzma_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$nndd_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where (rdepartment not like '%未预约%' and rdepartment not like '%耳鼻喉科%') and a.dr=0 and isappointment=1 and rsourceType !='自然门诊' and rsymptom !='体检'  and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$szyd_sql = " select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId LEFT JOIN Info_Appointment_Group as c on b.awr=c.userCode where rdepartment like '%肛%' and  gn not like '%胃肠%' and a.dr=0 and rmedia in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$szty_sql = " select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId LEFT JOIN Info_Appointment_Group as c on b.awr=c.userCode where  a.dr=0 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$szydwc_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  not like '%未预约%' and a.dr=0 and  gn like '%胃肠%' and rmedia in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and awr is not null and  a.ts >'{$startDate}' and a.ts <='{$endDate}'";
$gzdd_sql = "select a.ts,convert(varchar(10),a.ts,108) as tstime from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and  awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'";

$zjdd_jz_row = get_fetchAll_assoc($zjdd, $zjdd_sql);
$zjdd_jzNum = getAllNum($zjdd_jz_row, $date);

$nndd_jz_row = get_fetchAll_assoc($nndd, $nndd_sql);
$nndd_jzNum = getAllNum($nndd_jz_row, $date);

$szyd_jz_row = get_fetchAll_assoc($szyd, $szyd_sql);
$szyd_jzNum = getAllNum($szyd_jz_row, $date);

$szty_jz_row = get_fetchAll_assoc($szyd, $szyd_sql);
$szyd_jzNum = getAllNum($szyd_jz_row, $date);

$szydwc_jz_row = get_fetchAll_assoc($szyd, $szydwc_sql);
$szydwc_jzNum = getAllNum($szydwc_jz_row, $date);

$gzdd_jz_row = get_fetchAll_assoc($gzdd, $gzdd_sql);
$gzdd_jzNum = getAllNum($gzdd_jz_row, $date);

$data = array();
$data['zjdd_jzNum'] = $zjdd_jzNum;
$data['nndd_jzNum'] = $nndd_jzNum;
$data['szyd_jzNum'] = $szyd_jzNum;
$data['szydwc_jzNum'] = $szydwc_jzNum;
$data['gzdd_jzNum'] = $gzdd_jzNum;
echo json_encode($data);


