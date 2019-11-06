<?php

require_once 'datasource.php';
$mail->Subject = "{$nowDate}远大数据日报"; //邮件标题 
$mail->FromName = "远大数据日报系统";  //发件人姓名 

$address1 = "675320502@qq.com"; //收件人email 
$mail->AddAddress($address1, "张西"); //添加收件人（地址，昵称） 

$mail->IsHTML(true); //支持html格式内容 
$contents = $contents = <<<EOF
         <html>
    <head>   
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>预约通知</title>
        <style>
           tr td:first-child{width: 230px;text-align:left;}
        </style>
    </head>
    <body>
        <div style="text-align: center;font-size: 18px;">{$nowDate}远大数据日报</div> <table width="100%" border="1" cellpadding="0" cellspacing="0" align="center" class="tbtitle" style="background:#FBFCE2;margin-bottom:5px;">    
            <tbody>
                <tr align="center" bgcolor="#CFCFCF" height="26">
                    <td></td>
                    <td>远大</td>
                    <td>远大胃肠</td>

                </tr>
                <tr align="center">
                    <td >预约到今天</td>
                    <td>$szyd_yyl_row</td>
                <td>$szyd_yyl_wc_row</td>
 
                </tr>
                <tr align="center">
                    <td>预约到今天（纯网）</td>
                    <td>$szyd_cw_row</td>
                <td>$szyd_yyl_wc_row</td>
  
                </tr>
                <tr align="center">
                    <td>今天大夜班预约</td>
                    <td>$szyd_yydy_row</td>
                <td>$szyd_yydy_wc_row</td>   
                </tr>
                <tr align="center">
                    <td>昨日预约到今天</td>
                    <td>$szyd_yyy_row</td>
                <td>$szyd_yyy_wc_row</td>  
                </tr>        
                <tr align="center">
                    <td>昨日预约</td>
                    <td>$szyd_lrl_row</td>
                 <td>$szyd_lrl_wc_row</td>    >
                </tr>
                <tr align="center">
                    <td>昨日预约（纯网）</td>
                    <td>$szyd_lcw_row</td>
                <td>$szyd_lrl_wc_row</td>                    
                </tr>
                <tr align="center">
                    <td>昨日预约到昨日</td>
                    <td>$szyd_zrdzr_row</td>
                <td>$szyd_zrdzr_wc_row</td>      
                </tr>
                 <tr align="center">
                    <td>昨日预约昨日就诊</td>
                    <td>$szyd_jz_row</td>
                <td>$szyd_jz_wc_row</td>           
                </tr>
                
                <tr align="center">
                    <td>昨日预约到昨日（纯网）</td>
                    <td>$szyd_zrdzrcw_row</td>
                    <td>$szyd_zrdzr_wc_row</td>                         
                </tr>    
                <tr align="center">
                    <td>昨日预约昨日就诊（纯网）</td>
                    <td>$szyd_jzcw_row</td>
                 <td>$szyd_jz_wc_row</td>      
                </tr>
                <tr align="center">
                    <td>昨日就诊(纯网)</td>
                    <td>$szyd_yjzcw_row</td>
                  <td>$szyd_yjzcw_wc_row</td>         
                </tr>
                      <tr align="center">
                    <td>本月纯网总到诊</td>
                    <td>$szyd_mjzcw_row</td>
                 <td>$szyd_mjzcw_wc_row</td>
                </tr>
                <tr align="center">
                    <td>昨日就诊(纯网纯肛)</td>
                    <td>$szyd_ccjzcw_row</td>
                  <td>$szyd_ccjzcw_wc_row</td>  
                </tr>
                      <tr align="center">
                    <td>本月纯网纯肛总到诊</td>
                    <td>$szyd_ccmjzcw_row</td>
                 <td>$szyd_mjzcw_wcg_row</td> 
                </tr>
                
         <tr align="center">
                    <td>上月纯网纯肛总到诊</td>
                    <td>$szyd_sccmjzcw_row</td>
                 <td>$szyd_smjzcw_wcg_row</td>    
                </tr>                
            </tbody>
        </table>
           <div>
            <p>预约到今天:按预约时间查询，预约时间是今天的数量</p>
            <p>预约到今天（纯网）:按预约时间查询，预约时间是今天的数量（纯网）</p>
            <p>今天大夜班预约:按录入时间查询，昨日大夜班录入的数量</p>
            <p>昨日预约到今天:按预约时间查询，预约时间是今天，录入时间是昨天的数量</p>
            <p>昨日预约:按录入时间查询，昨日录入的数量</p>
            <p>昨日预约（纯网）:按录入时间查询，昨日录入的数量（纯网）</p>
            <p>昨日预约到昨日:录入时间是昨天，预约时间也是昨天的数量</p>
            <p>昨日预约到昨日（纯网）:录入时间是昨天，预约时间也是昨天的数量（纯网）</p>
            <p>昨日预约昨日就诊:录入时间是昨天，就诊时间也是昨天的数量</p>
            <p>昨日预约昨日就诊（纯网）:录入时间是昨天，就诊时间也是昨天的数量（纯网按照就诊数据的媒体算）</p>
            <p>昨日就诊(纯网):就诊时间是昨天的数量（纯网）</p>                
        </div>
    </body> 
</html>  
EOF;
$mail->Body = $contents;
echo $contents;
exit();
//发送 
if (!$mail->Send()) {
    echo "error: " . $mail->ErrorInfo;
} else {
    echo "success";
}



