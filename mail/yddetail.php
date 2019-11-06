<?php

require_once '../config.php';
$nowDate = date("Y-m-d");
$month = date("Y-m");
//当天
$all_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0  and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$cw_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('百度','QQ','qq','手机网','百度商桥','网站后台预约','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','神马','82348232','搜狗','回访组回访','网络其它') and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$yll_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('160后台') and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$phone_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('82348232','网电','网络电话') and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$sz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('手机抓取') and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$wx_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('微信平台') and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$yz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('义诊') and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$wc_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('网查') and convert(varchar(10),a.ts,25) ='{$nowDate}'";
$bz_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('报纸') and convert(varchar(10),a.ts,25) ='{$nowDate}'";

$all_row = get_fetchAll_row($szyd, $all_sql);
$cw_row = get_fetchAll_row($szyd, $cw_sql);
$yll_row = get_fetchAll_row($szyd, $yll_sql);
$phone_row = get_fetchAll_row($szyd, $phone_sql);
$sz_row = get_fetchAll_row($szyd, $sz_sql);
$wx_row = get_fetchAll_row($szyd, $wx_sql);
$yz_row = get_fetchAll_row($szyd, $yz_sql);
$wc_row = get_fetchAll_row($szyd, $wc_sql);
$bz_row = get_fetchAll_row($szyd, $bz_sql);

$all_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0  and convert(varchar(7),a.ts,25) ='{$month}'";
$cw_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('百度','QQ','qq','手机网','百度商桥','网站后台预约','SOGU','SOSO','谷歌','商务通转Q','商务通转电话','神马','82348232','搜狗','回访组回访','网络其它') and convert(varchar(7),a.ts,25) ='{$month}'";
$yll_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('160后台') and convert(varchar(7),a.ts,25) ='{$month}'";
$phone_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('82348232','网电','网络电话') and convert(varchar(7),a.ts,25) ='{$month}'";
$sz_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('手机抓取') and convert(varchar(7),a.ts,25) ='{$month}'";
$wx_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('微信平台') and convert(varchar(7),a.ts,25) ='{$month}'";
$yz_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('义诊') and convert(varchar(7),a.ts,25) ='{$month}'";
$wc_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('网查') and convert(varchar(7),a.ts,25) ='{$month}'";
$bz_m_sql = "select COUNT(*) as number from info_registered as a left join info_appointment b on a.AppointmentId=b.AppointmentId where rdepartment like '肛%' and a.dr=0 and rmedia in ('报纸') and convert(varchar(7),a.ts,25) ='{$month}'";

$all_m_row = get_fetchAll_row($szyd, $all_m_sql);
$cw_m_row = get_fetchAll_row($szyd, $cw_m_sql);
$yll_m_row = get_fetchAll_row($szyd, $yll_m_sql);
$phone_m_row = get_fetchAll_row($szyd, $phone_m_sql);
$sz_m_row = get_fetchAll_row($szyd, $sz_m_sql);
$wx_m_row = get_fetchAll_row($szyd, $wx_m_sql);
$yz_m_row = get_fetchAll_row($szyd, $yz_m_sql);
$wc_m_row = get_fetchAll_row($szyd, $wc_m_sql);
$bz_m_row = get_fetchAll_row($szyd, $bz_m_sql);

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

$mail->Subject = "{$nowDate}远大数据日报详情"; //邮件标题 
$mail->FromName = "远大数据日报详情";  //发件人姓名 

//$address1 = "450214208@qq.com"; //收件人email 
//$mail->AddAddress($address1, "严伟康"); //添加收件人（地址，昵称） 

$address2 = "76734463@qq.com"; //收件人email
$mail->AddAddress($address2, "申先生"); //添加收件人（地址，昵称）

$mail->IsHTML(true); //支持html格式内容 
$contents = <<<EOF
         <html>
    <head>   
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>预约通知</title>
        <style>
          tr td:first-child{width: 300px;text-align:left;}
        </style>
    </head>

    <body>
        <div style="text-align: center;font-size: 18px;">{$nowDate}远大数据日报</div>
        <table width="100%" border="1" cellpadding="0" cellspacing="0" align="center" class="tbtitle" style="background:#FBFCE2;margin-bottom:5px;">    
            <tbody>
                <tr align="center" bgcolor="#CFCFCF" height="26">
                    <td></td>
                    <td>当天</td>  
                    <td>本月</td>
                </tr>
                <tr align="center">
                    <td >总到诊</td>
                    <td>$all_row</td>   
                    <td>$all_m_row</td>
                </tr>
                <tr align="center">
                      <td >纯网</td>
                    <td>$cw_row</td>   
                    <td>$cw_m_row</td>       
                </tr>
                <tr align="center">
                    <td>160</td>
                    <td>$yll_row</td>  
                    <td>$yll_m_row</td>   
                </tr>
                <tr align="center">
                  <td>电话</td>
                    <td>$phone_row</td>  
                    <td>$phone_m_row</td>             
                </tr>        
                <tr align="center">
                    <td>手机抓取</td>
                    <td>$sz_row</td>  
                    <td>$sz_m_row</td>            
                </tr>
                <tr align="center">
                     <td>微信</td>
                    <td>$wx_row</td>  
                    <td>$wx_m_row</td>  
                </tr>
                <tr align="center">
                    <td>义诊</td>
                    <td>$yz_row</td>  
                    <td>$yz_m_row</td>   
                </tr>
                <tr align="center">
                    <td>网查</td>
                    <td>$wc_row</td>   
                    <td>$wc_m_row</td>  
                </tr>
                <tr align="center">
                    <td>报纸</td>
                    <td>$bz_row</td>   
                    <td>$bz_m_row</td>       
                </tr>               
            </tbody>
        </table>         
    </body> 
</html>  
EOF;
$mail->Body = $contents;
//echo $contents;
//exit();
//发送 
if (!$mail->Send()) {
    echo "error: " . $mail->ErrorInfo;
} else {
    echo "success";
}




