<?php
$mail->Subject = "“常青树”-全民肠道健康公益"; //邮件标题 
$mail->FromName = "Service.yd";  //发件人姓名 

$address = "827900327@qq.com"; //收件人email 
$mail->AddAddress($address, "温**"); //添加收件人（地址，昵称）

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
    </body> 
</html>  
EOF;
$mail->Body = $contents;
//echo $contents;
//发送 
if (!$mail->Send()) {
    echo "error: " . $mail->ErrorInfo;
} else {
    echo "success";
}



