<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="/chaxun/Public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"  media="screen" type="text/css" href="/chaxun/Public/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet"  media="screen" type="text/css" href="/chaxun/Public/css/bootstrap/bootstrap-responsive.css">
        <link rel="stylesheet"  media="screen" type="text/css" href="/chaxun/Public/css/bootstrap/bootstrap-overrides.css">
        <script src="/chaxun/Public/js/jquery-1.7.2.min.js" type="text/javascript"></script>

    </head>
    <body>
        <table class="table table-bordered">
            <tr>
                <td>
                    <?php if(is_array($auth_infoA)): foreach($auth_infoA as $k=>$vo): ?><table class="table">
                            <tr>
                                <td><a onclick=expand(<?php echo ($vo["auth_id"]); ?>)  href="javascript:void(0);"><span class="glyphicon glyphicon-cog"><?php echo ($vo["auth_name"]); ?></span></a></td>
                            </tr>
                        </table>
                        <table class="table" id="child<?php echo ($vo["auth_id"]); ?>" style="display: none" >
                            <?php if(is_array($auth_infoB)): foreach($auth_infoB as $kk=>$voo): if(($vo["auth_id"]) == $voo["auth_pid"]): ?><tr>
                                        <td class="text-center"></td>
                                        <td width="180"><a href="/chaxun/index.php/Admin/<?php echo ($voo["auth_c"]); ?>/<?php echo ($voo["auth_a"]); ?>" target="right"><?php echo ($voo["auth_name"]); ?></a></td>
                                     </tr><?php endif; endforeach; endif; ?>
                        </table><?php endforeach; endif; ?>
                 </td>
            </tr>
        </table>

        <script language=javascript>
            function expand(el)
            {
                childobj = document.getElementById("child" + el);

                if (childobj.style.display == 'none')
                {
                    childobj.style.display = 'block';
                }
                else
                {
                    childobj.style.display = 'none';
                }
                return;
            }
        </script>
    </body>
</html>