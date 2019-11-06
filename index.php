<?php
session_start();
$lifeTime = 24 * 3600 * 365;
session_set_cookie_params($lifeTime);
if ($_POST['name'] == 'admin' && $_POST['pwd'] == 'ydgc9921') {
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
            <title>统计</title>
            <link href="./css/style.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="./js/jquery.min.js"></script>
            <script type="text/javascript" src="./js/moment.min.js"></script>
        </head>

        <body>
            <div class="fixed" style="display:none;">        
            </div>
            <audio id="chatAudio"><source src="./images/mp3.mp3" type="audio/mpeg"></audio>
            <div class="mychart">
                <?php require_once 'mychart.php'; ?>
            </div>

            <div class="mytable">
                <?php require_once 'mytable.php'; ?>
            </div>
        </body>   
        <script type="text/javascript" src="./js/main.js"></script>   
    </html>
    <?php
} else {
    header('Location:login.php');
}
?>