<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <link href="/chaxun/Public/css/admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <table cellspacing=0 cellpadding=0 width="100%" align=center border=0>
            <tr height=28>
                <td background="/chaxun/Public/images/title_bg1.jpg">当前位置: >>  后台管理首页</td></tr>
            <tr>
                <td bgcolor=#b1ceef height=1></td></tr>
            <tr height=20>
                <td background=/chaxun/Public/images/shadow_bg.jpg></td></tr></table>
        <table cellspacing=0 cellpadding=0 width="90%" align=center border=0>
            <tr height=100>
                <td align=middle width=100></td>
                <td width=60>&nbsp;</td>
                <td>
                    <table height=100 cellspacing=0 cellpadding=0 width="100%" border=0>

                        <tr>
                            <td>当前时间：<?php echo (date("Y-m-d H:i:s", $time)); ?></td></tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 16px"><?php echo (session('admin_name')); ?></td></tr>
                        <tr>
                            <td>欢迎进入网站管理中心！</td></tr></table></td></tr>
            <tr>
                <td colspan=3 height=10></td></tr></table>
        <table cellspacing=0 cellpadding=0 width="95%" align=center border=0>
            <tr height=20>
                <td></td></tr>
            <tr height=22>
                <td style="padding-left: 20px; font-weight: bold; color: #ffffff" 
                    align=middle background="/chaxun/Public/images/title_bg2.jpg">您的相关信息</td></tr>
            <tr bgcolor=#ecf4fc height=12>
                <td></td></tr>
            <tr height=20>
                <td></td></tr></table>
        <table cellspacing=0 cellpadding=2 width="95%" align=center border=0>
            <tr>
                <td align=right width=100>登陆帐号：</td>
                <td style="color: #880000"><?php echo (session('admin_email')); ?></td></tr>
            <tr>
                <td align=right>真实姓名：</td>
                <td style="color: #880000"><?php echo (session('admin_name')); ?></td></tr>
            <tr>
                <td align=right>身份过期：</td>
                <td style="color: #880000">30 分钟</td></tr>
            <tr>
                <td align=right>电话：</td>
                <td style="color: #880000"><?php echo (session('admin_tel')); ?></td></tr>
            <tr>
                <td align=right>开发者qq：</td>
                <td style="color: #880000">248404941</td></tr>
            <tr>
                <td align=right>技术支持：</td>
                <td style="color: #880000"><a href="http://www.john_3.com">张桓</a></td>
            </tr>
        </table>
    </body>
</html>