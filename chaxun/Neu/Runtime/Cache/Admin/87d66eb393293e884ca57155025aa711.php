<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员登录</title>
    <link rel="stylesheet" type="text/css" href="/chaxun/Public/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/chaxun/Public/css/admin_index.css" />
</head>
<body class="login_body">
<div class="login_div">
    <div class="col-xs-12 login_title">管理员登录后台</div>
    <form action="/chaxun/index.php/Admin/Manager/Login.html" class="login" id="LoginForm" method="post">
        <div class="nav">
            <div class="nav login_label">
                <div class="col-xs-4 login_left"> 账号: </div>
                <div class="col-xs-6 login_right">
                    <input class="text" data-validation="length" data-validation-length="min4" type="text" name="admin_user" id="name" value="" placeholder="email / user / tel"  onblur="javascript:ok_or_errorBylogin(this)" />
                </div>
            </div>
            <div class="nav login_label">
                <div class="col-xs-4 login_left">密码: </div>
                <div class="col-xs-6 login_right">
                    <input class="text" data-validation="length" data-validation-length="min4"  type="password" name="admin_pwd" id="pwd" value="" placeholder="admin password" onBlur="javascript:ok_or_errorBylogin(this)" />
                </div>
            </div>

            <div class="nav login_label">
                <div class="col-xs-4 login_left">验证码: </div>
                <div class="col-xs-6 login_right">
                    <input class="text"  data-validation="length" data-validation-length="min4"  type="text" name="captcha" id="code" value="" placeholder="Please Enter Below Code" onBlur="javascript:ok_or_errorBylogin(this)" />
                </div>

            </div>
            <div class="nav login_label">
               <div class="col-xs-12 text-center code"><img src="/chaxun/index.php/Admin/Manager/verifyImg" alt="验证码" onclick="javascript:this.src='/chaxun/index.php/Admin/Manager/verifyImg?tm='+Math.random();" /></div>
            </div>
            <div class="col-xs-12 text-center">
                <input type="submit" class="btn btn-primary" id="login_btn" value="登 录" />
            </div>
        </div>
    </form>
     <script src="/chaxun/Public/js/jquery.min.js"></script>
    <script src="/chaxun/Public/js/admin_login.js" type="text/javascript"></script>
    <script>


    </script>
</div>
</body>
</html>