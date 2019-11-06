<?php

require_once '../config.php';
if (!empty($_POST['datetime'])) {
    $date = $_POST['datetime'];
}
$startDate = $date . " 00:00:00";
$endDate = $date . " 23:59:59";
$data = array();

if ($_POST['type'] == 'zjdd') {
    $zjdd_yy_sql = "select  media,count(media) as nums from info_appointment where department not like '%未预约%' and dr=0 and ts >='{$startDate}' and ts<='{$endDate}'  GROUP BY media ";
    $zjdd_yy_row = get_fetchAll_assoc($zjdd, $zjdd_yy_sql);
    $zjdd_jz_sql = "select rmedia as media,count(rmedia) as nums from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and  isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}'  GROUP BY rmedia ";
    $zjdd_jz_row = get_fetchAll_assoc($zjdd, $zjdd_jz_sql);
    $data = get_data($zjdd_yy_row, $zjdd_jz_row);
} elseif ($_POST['type'] == 'gzma') {
    $gzma_yy_sql = "select media,count(media) as nums from info_appointment where  department not like '%未预约%' and dr=0  and ts >='{$startDate}' and ts<='{$endDate}' GROUP BY media";
    $gzma_yy_row = get_fetchAll_assoc($gzma, $gzma_yy_sql);
    $gzma_jz_sql = "select rmedia as media,count(rmedia) as nums  from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' GROUP BY rmedia ";
    $gzma_jz_row = get_fetchAll_assoc($gzma, $gzma_jz_sql);
    $data = get_data($gzma_yy_row, $gzma_jz_row);
} elseif ($_POST['type'] == 'szyd') {
    $szyd_yy_sql = "select  media,count(media) as nums from info_appointment WHERE (department='肛肠外科' or department='肛肠科') and  dr=0  and len(media)!=0 and media!='微信平台' and  gn!='新媒体' and ts >'{$startDate}' and ts <='{$endDate}' group by media ";
    $szyd_yy_row = get_fetchAll_assoc($szyd, $szyd_yy_sql);
    $szyd_yyNum = $szyd_yy_row;
    $szyd_jz_sql = "select  rmedia as media,count(rmedia) as nums from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and gn not in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') and  len(rmedia)!=0  and  rmedia!='微信平台' and  gn!='新媒体' and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by rmedia ";
    $szyd_jz_row = get_fetchAll_assoc($szyd, $szyd_jz_sql);
    $szyd_jzNum = $szyd_jz_row;
    $data = get_data($szyd_yyNum, $szyd_jzNum);
} elseif ($_POST['type'] == 'szydwc') {
    $szyd_yy_sql = "select  media,count(media) as nums from info_appointment WHERE department not like '%未预约%' and dr=0  and (gn in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') or awr like '%肖婵%')   and  dr=0  and len(media)!=0 and ts >'{$startDate}' and ts <='{$endDate}' group by media ";
    $szyd_yy_row = get_fetchAll_assoc($szyd, $szyd_yy_sql);
    $szyd_yyNum = $szyd_yy_row;
    $szyd_jz_sql = "select  rmedia as media,count(rmedia) as nums from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and gn in ('胃肠组','胃肠大夜班','胃肠1组','胃肠2组') and a.dr=0 and  len(rmedia)!=0  and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by rmedia ";
    $szyd_jz_row = get_fetchAll_assoc($szyd, $szyd_jz_sql);
    $szyd_jzNum = $szyd_jz_row;
    $data = get_data($szyd_yyNum, $szyd_jzNum);
} elseif ($_POST['type'] == 'gzdd') {
    $gzdd_yy_sql = "select media,count(media) as nums from info_appointment where department not like '%未预约%' and dr=0 and ts >='{$startDate}' and ts<='{$endDate}' group by media";
    $gzdd_yy_row = get_fetchAll_assoc($gzdd, $gzdd_yy_sql);
    $gzdd_yyNum = getGzddNum($gzdd_yy_row);
    $gzdd_jz_sql = "select  rmedia as media,count(rmedia) as nums from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and  isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by rmedia";
    $gzdd_jz_row = get_fetchAll_assoc($gzdd, $gzdd_jz_sql);
    $gzdd_jzNum = getGzddNum($gzdd_jz_row);
    $data = get_data($gzdd_yyNum, $gzdd_jzNum);
} elseif ($_POST['type'] == 'nngc') {
    $nngc_yy_sql = "select media,count(media) as nums  from info_appointment where department not in ('未预约','耳鼻喉科')  and sourceType !='自然门诊' and symptom !='体检' and gn like '%肛肠%'  and  ts >='{$startDate}' and ts<='{$endDate}' group by media";
    $nngc_yy_row = get_fetchAll_assoc($nndd, $nngc_yy_sql);
    $nngc_jz_sql = "select rmedia as media,count(rmedia) as nums  from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment  not in ('未预约','耳鼻喉科')  and gn like '%肛肠%'  and a.dr=0 and isappointment=1 and rsourceType !='自然门诊' and rsymptom !='体检'  and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by rmedia";
    $nngc_jz_row = get_fetchAll_assoc($nndd, $nngc_jz_sql);
    $data = get_data($nngc_yy_row, $nngc_jz_row);
} elseif ($_POST['type'] == 'nnwc') {
    $nnwc_yy_sql = "select media,count(media) as nums  from info_appointment where department not in ('未预约','耳鼻喉科')   and sourceType !='自然门诊' and  gn like '%胃肠%' and ts >='{$startDate}' and ts<='{$endDate}' group by media";
    $nnwc_yy_row = get_fetchAll_assoc($nndd, $nnwc_yy_sql);
    $nnwc_jz_sql = "select rmedia as media,count(rmedia) as nums  from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not in ('未预约','耳鼻喉科')  and  gn like '%胃肠%' and a.dr=0 and isappointment=1 and rsourceType !='自然门诊' and rsymptom !='体检' and a.ts >'{$startDate}' and a.ts <='{$endDate}' group by rmedia";
    $nnwc_jz_row = get_fetchAll_assoc($nndd, $nnwc_jz_sql);
    $data = get_data($nnwc_yy_row, $nnwc_jz_row);
} elseif ($_POST['type'] == 'szty') {
    $szty_yy_sql = "select media,count(media) as nums from info_appointment where  department not like '%未预约%' and dr=0  and ts >='{$startDate}' and ts<='{$endDate}' GROUP BY media";
    $szty_yy_row = get_fetchAll_assoc($szty, $szty_yy_sql);
    $szty_jz_sql = "select rmedia as media,count(rmedia) as nums  from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment not like '%未预约%' and a.dr=0 and isappointment=1 and awr is not null and a.ts >'{$startDate}' and a.ts <='{$endDate}' GROUP BY rmedia ";
    $szty_jz_row = get_fetchAll_assoc($szty, $szty_jz_sql);
    $data = get_data($szty_yy_row, $szty_jz_row);
}
echo json_encode($data);

function getGzddNum($gzdd_row)
{
    $data = $row = array();
    $phoneNum = $baiduNum = 0;
    $dianhua = array('3G01', '3G02', '3G120', '3G626', '3Gdd01', '3Gddgc01', '3Gddgc03', '3Ggc02', '网电', '3G手机');
    $baidu = array('百度', '百度01', '百度02', '百度120', '百度626', '百度dd01', '百度dd02', '百度ddgc01', '百度ddgc03', '百度gc02', '百度健康', '百度商桥120', '百度网盟120', '百度网盟');
    foreach ($gzdd_row as $k => $v) {
        if (in_array($v['media'], $dianhua)) {
            $phoneNum += $v['nums'];
            unset($gzdd_row[$k]);
        }
        if (in_array($v['media'], $baidu)) {
            $baiduNum += $v['nums'];
            unset($gzdd_row[$k]);
        }
    }
    $gzdd_row[] = array("media" => '百度', "nums" => $baiduNum);
    $gzdd_row[] = array("media" => '网络电话', "nums" => $phoneNum);
    return $gzdd_row;
}

function get_data($yy, $jz)
{
    $data = array();
    foreach ($yy as $k => $v) {
        foreach ($jz as $kk => $vv) {
            if ($v['media'] == $vv['media']) {
                $data[] = array("media" => $v['media'], "yy" => $v['nums'], "jz" => $vv['nums']);
                unset($yy[$k]);
                unset($jz[$kk]);
            }
        }
    }

    foreach ($yy as $v) {
        $data[] = array("media" => $v['media'], "yy" => $v['nums'], "jz" => 0);
    }
    foreach ($jz as $v) {
        $data[] = array("media" => $v['media'], "yy" => 0, "jz" => $v['nums']);
    }
    return $data;
}
