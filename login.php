<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登录</title>
    <script type="text/javascript" src="./js/jquery.min.js"></script>
</head>

<body>
    <form action="index.php" method="post" id="form1">
        用户:<input id="use" type="text" name="name" value="" /><br />
        密码: <input id="pwd" type="password" name="pwd" /><br />
        <input id="Fsubmit" type="button" name="button" value="登录" />
    </form>
</body>
<script>
    $(function() {
        $("#Fsubmit").click(function() {

            $("#form1").submit();
        });
    });
</script>

</html>