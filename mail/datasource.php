<?php

require_once '../config.php';
date_default_timezone_set("Asia/Shanghai");
$nowDate = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime("-1 day"));
$month = date("Y-m");
$smonth = date("Y-m", strtotime("-1 month", strtotime("first day of this month")));

$str_yy_gc="department like '%肛%' and  gn not like '%胃肠%' and dr=0 and rmedia in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话')";
$str_jz_gc="rdepartment like '%肛%' and  gn not like '%胃肠%' and a.dr=0 and rmedia in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话')";
$str_yy_wc="department  not like '%未预约%' and dr=0 and  gn like '%胃肠%' and media in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话')";
$str_jz_wc="rdepartment  not like '%未预约%' and a.dr=0 and  gn like '%胃肠%' and rmedia in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话')";
//预约到今天
$szyd_gc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and media !='报纸' and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$szyd_wc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') and media !='报纸' and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$yyl_sql = "select COUNT(*) as number from info_appointment where (department='肛肠外科' or department='肛肠科') and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$zjdd_yyl_row = get_fetchAll_row($zjdd, $yyl_sql);
//$gzma_yyl_row = get_fetchAll_row($gzma, $yyl_sql);
$szyd_yyl_row = get_fetchAll_row($szyd, $szyd_gc_sql);
$gzdd_yyl_row = get_fetchAll_row($gzdd, $yyl_sql);
$szyd_yyl_wc_row = get_fetchAll_row($szyd, $szyd_wc_sql);

$nndd_gc="(department not in ('未预约','耳鼻喉科')  and sourceType !='自然门诊' and symptom !='体检' ) and gn like '%肛肠%'";
$nndd_wc="(department not in ('未预约','耳鼻喉科')  and sourceType !='自然门诊' and symptom !='体检' ) and gn like '%胃肠%'";
        

$nndd_gc_yyl_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$nndd_wc_yyl_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$nndd_gc_yyl_row = get_fetchAll_row($nndd, $nndd_gc_yyl_sql);
$nndd_wc_yyl_row = get_fetchAll_row($nndd, $nndd_wc_yyl_sql);

//预约到今天（纯网）
$zjdd_cw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
//$gzma_cw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$szyd_cw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组'  and dr=0 and  media in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and  convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$gzdd_cw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$zjdd_cw_row = get_fetchAll_row($zjdd, $zjdd_cw_sql);
//$gzma_cw_row = get_fetchAll_row($gzma, $gzma_cw_sql);
$szyd_cw_row = get_fetchAll_row($szyd, $szyd_cw_sql);
$gzdd_cw_row = get_fetchAll_row($gzdd, $gzdd_cw_sql);
$nndd_gc_cw_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$nndd_wc_cw_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and convert(varchar(10),deperiodstart,25) <='{$nowDate}' and convert(varchar(10),deperiodend,25) >='{$nowDate}'";
$nndd_gc_cw_row = get_fetchAll_row($nndd, $nndd_gc_cw_sql);
$nndd_wc_cw_row = get_fetchAll_row($nndd, $nndd_wc_cw_sql);

//今天大夜班预约
$yydy_gc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and media !='报纸' and dr=0 and ts >='" . $nowDate . " 00:00:00' and ts <'" . $nowDate . " 08:00:00'";
$yydy_wc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn='胃肠大夜班' and media !='报纸' and dr=0 and convert(varchar(10),ts,25) ='{$nowDate}'";
$yydy_sql = "select COUNT(*) as number from info_appointment where (department='肛肠外科' or department='肛肠科') and ts >='" . $nowDate . " 00:00:00' and ts <'" . $nowDate . " 08:00:00'";
$zjdd_yydy_row = get_fetchAll_row($zjdd, $yydy_sql);
//$gzma_yydy_row = get_fetchAll_row($gzma, $yydy_sql);
$szyd_yydy_row = get_fetchAll_row($szyd, $yydy_gc_sql);
$szyd_yydy_wc_row = get_fetchAll_row($szyd, $yydy_wc_sql);
$gzdd_yydy_row = get_fetchAll_row($gzdd, $yydy_sql);
$nndd_gc_yydy_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and ts >='" . $nowDate . " 00:00:00' and ts <'" . $nowDate . " 08:00:00'";
$nndd_wc_yydy_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and ts >='" . $nowDate . " 00:00:00' and ts <'" . $nowDate . " 08:00:00'";
$nndd_gc_yydy_row = get_fetchAll_row($nndd, $nndd_gc_yydy_sql);
$nndd_wc_yydy_row = get_fetchAll_row($nndd, $nndd_wc_yydy_sql);

//昨日预约到今天
$yyy_gc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and media !='报纸' and dr=0  and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$nowDate}'";
$yyy_wc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') and media !='报纸' and dr=0  and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$nowDate}'";
$yyy_sql = "select COUNT(*) as number from info_appointment where (department='肛肠外科' or department='肛肠科') and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$nowDate}'";
$zjdd_yyy_row = get_fetchAll_row($zjdd, $yyy_sql);
//$gzma_yyy_row = get_fetchAll_row($gzma, $yyy_sql);
$szyd_yyy_row = get_fetchAll_row($szyd, $yyy_gc_sql);
$szyd_yyy_wc_row = get_fetchAll_row($szyd, $yyy_wc_sql);
$gzdd_yyy_row = get_fetchAll_row($gzdd, $yyy_sql);
$nndd_gc_yyy_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$nowDate}'";
$nndd_wc_yyy_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$nowDate}'";
$nndd_gc_yyy_row = get_fetchAll_row($nndd, $nndd_gc_yyy_sql);
$nndd_wc_yyy_row = get_fetchAll_row($nndd, $nndd_wc_yyy_sql);


//昨日预约
$lrl_gc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and media !='报纸' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$lrl_wc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') and media !='报纸' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$lrl_sql = "select COUNT(*) as number from info_appointment where (department='肛肠外科' or department='肛肠科') and convert(varchar(10),ts,25) ='{$yesterday}'";
$zjdd_lrl_row = get_fetchAll_row($zjdd, $lrl_sql);
//$gzma_lrl_row = get_fetchAll_row($gzma, $lrl_sql);
$szyd_lrl_row = get_fetchAll_row($szyd, $lrl_gc_sql);
$szyd_lrl_wc_row = get_fetchAll_row($szyd, $lrl_wc_sql);
$gzdd_lrl_row = get_fetchAll_row($gzdd, $lrl_sql);
$nndd_gc_lrl_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$nndd_wc_lrl_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$nndd_gc_lrl_row = get_fetchAll_row($nndd, $nndd_gc_lrl_sql);
$nndd_wc_lrl_row = get_fetchAll_row($nndd, $nndd_wc_lrl_sql);

//昨日预约（纯网）
$zjdd_lcw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
//$gzma_lcw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$szyd_lcw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and dr=0 and  media in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and  convert(varchar(10),ts,25) ='{$yesterday}'";
$gzdd_lcw_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$zjdd_lcw_row = get_fetchAll_row($zjdd, $zjdd_lcw_sql);
//$gzma_lcw_row = get_fetchAll_row($gzma, $gzma_lcw_sql);
$szyd_lcw_row = get_fetchAll_row($szyd, $szyd_lcw_sql);
$gzdd_lcw_row = get_fetchAll_row($gzdd, $gzdd_lcw_sql);
$nndd_gc_lcw_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$nndd_wc_lcw_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}'";
$nndd_gc_lcw_row = get_fetchAll_row($nndd, $nndd_gc_lcw_sql);
$nndd_wc_lcw_row = get_fetchAll_row($nndd, $nndd_wc_lcw_sql);



//昨日预约到昨日
$zrdzr_gc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and media !='报纸' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$zrdzr_wc_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') and media !='报纸' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$zrdzr_sql = "select COUNT(*) as number from info_appointment where (department='肛肠外科' or department='肛肠科') and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$zjdd_zrdzr_row = get_fetchAll_row($zjdd, $zrdzr_sql);
//$gzma_zrdzr_row = get_fetchAll_row($gzma, $zrdzr_sql);
$szyd_zrdzr_row = get_fetchAll_row($szyd, $zrdzr_gc_sql);
$szyd_zrdzr_wc_row = get_fetchAll_row($szyd, $zrdzr_wc_sql);
$gzdd_zrdzr_row = get_fetchAll_row($gzdd, $zrdzr_sql);
$nndd_gc_zrdzr_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$nndd_wc_zrdzr_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$nndd_gc_zrdzr_row = get_fetchAll_row($nndd, $nndd_gc_zrdzr_sql);
$nndd_wc_zrdzr_row = get_fetchAll_row($nndd, $nndd_wc_zrdzr_sql);


//昨日预约到昨日(纯网)
$zjdd_zrdzr_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
//$gzma_zrdzr_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$szyd_zrdzr_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and  gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and  dr=0 and  media in ('360','82348232','QQ','qq','百度','百度糯米','百度商桥','个人微信','回访组回访','快排','神马','搜狗','网络电话','网络其它','网站后台预约','手机网','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','胃肠电话') and  convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$gzdd_zrdzr_sql = "select COUNT(*) as number from info_appointment where department not like '%未预约%' and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$zjdd_zrdzrcw_row = get_fetchAll_row($zjdd, $zjdd_zrdzr_sql);
//$gzma_zrdzrcw_row = get_fetchAll_row($gzma, $gzma_zrdzr_sql);
$szyd_zrdzrcw_row = get_fetchAll_row($szyd, $szyd_zrdzr_sql);
$gzdd_zrdzrcw_row = get_fetchAll_row($gzdd, $gzdd_zrdzr_sql);
$nndd_gc_zrdzrcw_sql = "select COUNT(*) as number from info_appointment where $nndd_gc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$nndd_wc_zrdzrcw_sql = "select COUNT(*) as number from info_appointment where $nndd_wc and dr=0 and convert(varchar(10),ts,25) ='{$yesterday}' and convert(varchar(10),deperiodstart,25) ='{$yesterday}'";
$nndd_gc_zrdzrcw_row = get_fetchAll_row($nndd, $nndd_gc_zrdzrcw_sql);
$nndd_wc_zrdzrcw_row = get_fetchAll_row($nndd, $nndd_wc_zrdzrcw_sql);

//昨日预约昨日就诊
$jz_gc_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and gn!='胃肠组' and  gn!='胃肠大夜班' and gn!='胃肠1组' and gn!='胃肠2组' and rmedia!='报纸' and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$jz_wc_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and gn in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') and rmedia!='报纸' and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$jz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0  and awr is not null and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$zjdd_jz_row = get_fetchAll_row($zjdd, $jz_sql);
//$gzma_jz_row = get_fetchAll_row($gzma, $jz_sql);
$szyd_jz_row = get_fetchAll_row($szyd, $jz_gc_sql);
$szyd_jz_wc_row = get_fetchAll_row($szyd, $jz_wc_sql);
$gzdd_jz_row = get_fetchAll_row($gzdd, $jz_sql);
$nndd_gc_jz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_gc  and a.dr=0 and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$nndd_wc_jz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_wc  and a.dr=0 and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$nndd_gc_jz_row = get_fetchAll_row($nndd, $nndd_gc_jz_sql);
$nndd_wc_jz_row = get_fetchAll_row($nndd, $nndd_wc_jz_sql);


//昨日预约昨日就诊(纯网)
$zjdd_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
//$gzma_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$szyd_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and ".$str_jz_gc." and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$gzdd_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";

$zjdd_jzcw_row = get_fetchAll_row($zjdd, $zjdd_sql);
//$gzma_jzcw_row = get_fetchAll_row($gzma, $gzma_sql);
$szyd_jzcw_row = get_fetchAll_row($szyd, $szyd_sql);
$gzdd_jzcw_row = get_fetchAll_row($gzdd, $gzdd_sql);
$nndd_gc_jzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_gc and a.dr=0  and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$nndd_wc_jzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_wc and a.dr=0  and convert(varchar(10),a.ts,25) ='{$yesterday}' and convert(varchar(10),b.ts,25) ='{$yesterday}'";
$nndd_gc_jzcw_row = get_fetchAll_row($nndd, $nndd_gc_jzcw_sql);
$nndd_wc_jzcw_row = get_fetchAll_row($nndd, $nndd_wc_jzcw_sql);

//昨日就诊(纯网)
$zjdd_yjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(10),a.ts,25) ='{$yesterday}'";
//$gzma_yjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$szyd_yjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and ".$str_jz_gc." and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$szyd_yjz_wc_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and ".$str_jz_wc." and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$gzdd_yjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and convert(varchar(10),a.ts,25) ='{$yesterday}'";

$zjdd_yjzcw_row = get_fetchAll_row($zjdd, $zjdd_yjz_sql);
//$gzma_yjzcw_row = get_fetchAll_row($gzma, $gzma_yjz_sql);
$szyd_yjzcw_row = get_fetchAll_row($szyd, $szyd_yjz_sql);
$szyd_yjzcw_wc_row = get_fetchAll_row($szyd, $szyd_yjz_wc_sql);
$gzdd_yjzcw_row = get_fetchAll_row($gzdd, $gzdd_yjz_sql);
$nndd_gc_yjzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_gc and a.dr=0 and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$nndd_wc_yjzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_wc and a.dr=0 and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$nndd_gc_yjzcw_row = get_fetchAll_row($nndd, $nndd_gc_yjzcw_sql);
$nndd_wc_yjzcw_row = get_fetchAll_row($nndd, $nndd_wc_yjzcw_sql);

//本月纯网总到诊
$zjdd_mjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(7),a.ts,25) ='{$month}'";
//$gzma_mjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and convert(varchar(7),a.ts,25) ='{$month}'";
$szyd_mjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where  rdepartment not like '%未预约%' and ".$str_jz_gc." and convert(varchar(7),a.ts,25) ='{$month}'";
$szyd_mjz_wc_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and ".$str_jz_wc." and convert(varchar(7),a.ts,25) ='{$month}'";
$gzdd_mjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and convert(varchar(7),a.ts,25) ='{$month}'";

$zjdd_mjzcw_row = get_fetchAll_row($zjdd, $zjdd_mjz_sql);
//$gzma_mjzcw_row = get_fetchAll_row($gzma, $gzma_mjz_sql);
$szyd_mjzcw_row = get_fetchAll_row($szyd, $szyd_mjz_sql);
$szyd_mjzcw_wc_row = get_fetchAll_row($szyd, $szyd_mjz_wc_sql);
$gzdd_mjzcw_row = get_fetchAll_row($gzdd, $gzdd_mjz_sql);
$nndd_gc_mjzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_gc and a.dr=0  and convert(varchar(7),a.ts,25) ='{$month}'";
$nndd_wc_mjzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_wc and a.dr=0 and convert(varchar(7),a.ts,25) ='{$month}'";
$nndd_gc_mjzcw_row = get_fetchAll_row($nndd, $nndd_gc_mjzcw_sql);
$nndd_wc_mjzcw_row = get_fetchAll_row($nndd, $nndd_wc_mjzcw_sql);


//昨日就诊(纯网纯肛)
$zjdd_ccjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(10),a.ts,25) ='{$yesterday}'";
//$gzma_ccjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$szyd_ccjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%'  and ".$str_jz_gc."  and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$szyd_ccjz_wc_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  not like '%未预约%' and ".$str_jz_wc."   and convert(varchar(10),a.ts,25) ='{$yesterday}'";
$gzdd_ccjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and convert(varchar(10),a.ts,25) ='{$yesterday}'";

$zjdd_ccjzcw_row = get_fetchAll_row($zjdd, $zjdd_ccjz_sql);
//$gzma_ccjzcw_row = get_fetchAll_row($gzma, $gzma_ccjz_sql);
$szyd_ccjzcw_row = get_fetchAll_row($szyd, $szyd_ccjz_sql);
$szyd_ccjzcw_wc_row = get_fetchAll_row($szyd, $szyd_ccjz_wc_sql);
$gzdd_ccjzcw_row = get_fetchAll_row($gzdd, $gzdd_ccjz_sql);

//本月纯网纯肛总到诊
$zjdd_ccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(7),a.ts,25) ='{$month}'";
//$gzma_ccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and convert(varchar(7),a.ts,25) ='{$month}'";
$szyd_ccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and ".$str_jz_gc." and convert(varchar(7),a.ts,25)='{$month}'";
$szyd_mjz_wcg_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and ".$str_jz_wc." and convert(varchar(7),a.ts,25) ='{$month}'";
$gzdd_ccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and convert(varchar(7),a.ts,25) ='{$month}'";

$zjdd_ccmjzcw_row = get_fetchAll_row($zjdd, $zjdd_ccmjz_sql);
//$gzma_ccmjzcw_row = get_fetchAll_row($gzma, $gzma_ccmjz_sql);
$szyd_ccmjzcw_row = get_fetchAll_row($szyd, $szyd_ccmjz_sql);
$szyd_mjzcw_wcg_row = get_fetchAll_row($szyd, $szyd_mjz_wcg_sql);
$gzdd_ccmjzcw_row = get_fetchAll_row($gzdd, $gzdd_ccmjz_sql);

//上月纯网纯肛总到诊
$zjdd_sccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and awr is not null and convert(varchar(7),a.ts,25) ='{$smonth}'";
//$gzma_sccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and convert(varchar(7),a.ts,25) ='{$smonth}'";
$szyd_sccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and ".$str_jz_gc." and convert(varchar(7),a.ts,25)='{$smonth}'";
$szyd_smjz_wcg_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and ".$str_jz_wc." and convert(varchar(7),a.ts,25)='{$smonth}'";
$gzdd_sccmjz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  like '%肛%' and a.dr=0 and isappointment=1 and convert(varchar(7),a.ts,25) ='{$smonth}'";

$zjdd_sccmjzcw_row = get_fetchAll_row($zjdd, $zjdd_sccmjz_sql);
//$gzma_sccmjzcw_row = get_fetchAll_row($gzma, $gzma_sccmjz_sql);
$szyd_sccmjzcw_row = get_fetchAll_row($szyd, $szyd_sccmjz_sql);
$szyd_smjzcw_wcg_row = get_fetchAll_row($szyd, $szyd_smjz_wcg_sql);
$gzdd_sccmjzcw_row = get_fetchAll_row($gzdd, $gzdd_sccmjz_sql);
$nndd_gc_sccmjzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_gc and a.dr=0  and convert(varchar(7),a.ts,25) ='{$smonth}'";
$nndd_wc_sccmjzcw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where $nndd_wc and a.dr=0  and convert(varchar(7),a.ts,25) ='{$smonth}'";
$nndd_gc_sccmjzcw_row = get_fetchAll_row($nndd, $nndd_gc_sccmjzcw_sql);
$nndd_wc_sccmjzcw_row = get_fetchAll_row($nndd, $nndd_wc_sccmjzcw_sql);


require_once("common/class.phpmailer.php"); //载入PHPMailer类 

$mail = new PHPMailer(); //实例化 
$mail->IsSMTP(); // 启用SMTP 
$mail->Host = "smtp.aliyun.com"; //SMTP服务器 以163邮箱为例子 
$mail->Port = 25; //邮件发送端口 
$mail->SMTPAuth = true;  //启用SMTP认证 

$mail->CharSet = "UTF-8"; //字符集 
$mail->Encoding = "base64"; //编码方式 

$mail->Username = "zyrta19911015@aliyun.com";  //你的邮箱 
$mail->Password = "root123";  //你的密码 
$mail->From = "zyrta19911015@aliyun.com";  //发件人地址（也就是你的邮箱） 




