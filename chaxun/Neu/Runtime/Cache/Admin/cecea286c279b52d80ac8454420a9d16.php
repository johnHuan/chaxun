<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>关闭系统</title>
    <link rel="stylesheet"  media="screen" type="text/css" href="/chaxun/Public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet"  media="screen" type="text/css" href="/chaxun/Public/css/bootstrap/bootstrap-responsive.css">
    <link rel="stylesheet"  media="screen" type="text/css" href="/chaxun/Public/css/bootstrap/bootstrap-overrides.css">
    <link rel="stylesheet"  media="screen" tpye="text/css" href="/chaxun/Public/css/bootstrap.min.css">
    <script type="text/javascript" src="/chaxun/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/chaxun/Public/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<nav>当前位置：系统管理 >>系统参数设置</nav>
<hgroup>
    <h3> <span class="text-primary ">设置系统的配置参数</span></h3>
    <h4 class="text-success">什么都不操作表示不修改</h4>
</hgroup>
<form role="form" action="/chaxun/index.php/Admin/Config/set" method="post">
    <div class="table-responsive">
        <table class="table table-condensed table-hover table-bordered " style="width: 80%">
            <tr>
                <td><?php echo ($fields[0]); ?></td>
                <td><input readonly class="inline-input" type="text" value="<?php echo ($config[cid]); ?>"></td>
            </tr>
            <tr>
                <td><?php echo ($fields[1]); ?></td>
                <td><input name="avaliable" class="inline-input" type="text" value="<?php echo ($config[avaliable]); ?>" data-placement="right"  data-toggle='tooltip' title="只能是0或1； 0代表关闭系统；1代表系统正常开放"></td>
            </tr>

            <tr>
                <td><?php echo ($fields[2]); ?></td>
                <td><input name="page_per" class="inline-input" type="text" value="<?php echo ($config[page_per]); ?>" ></td>
            </tr>
            <tr>
                <td><?php echo ($fields[3]); ?></td>
                <td><input name="email" class="inline-input" type="text" value="<?php echo ($config[email]); ?>"></td>
            </tr>

            <tr>
                <td><?php echo ($fields[4]); ?></td>
                <td><textarea cols="100" name="infoh" placeholder="系统关闭后页面上显示的信息H3" ><?php echo ($config[infoh]); ?></textarea></td>
            </tr>
            <tr>
                <td><?php echo ($fields[5]); ?></td>
                <td><textarea cols="100" name="infos" placeholder="系统关闭后页面上显示的信息span" ><?php echo ($config[infos]); ?></textarea></td>
            </tr>


        </table>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="提 交" >
    </div>
</form>
</div>
<script>
    //智能提示
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });
    //通过按钮拿值
    $(function () {
        $('#setCrttentTime').click(function () {
            $('#orignStamps').val($('#currentStamps').val());
        });
        //

    })
</script>
</body>
</html>