<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>东北大学新生宿舍查询系统</title>
	<link rel="stylesheet"  media="screen" type="text/css" href="/chaxun/Public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/chaxun/Public/css/index.css">
</head>
<body>
	<div class="container">
		<div class="wrapper">
			<div class="header">
				<h1 class="text-center">东北大学 学生服务系统</h1>
			</div>
			<div class="toolbar control-label" >
				<div class="control-label">
					<button  class="pull-left  btn btn-success first">考场查询</button>
					<button  class=" pull-right btn btn-default second">新生宿舍查询</button>
				</div>
			</div>
			<!--主体开始-->
			<div id="content" class="content">
				<!--考场查询结果展示开始-->
				<div id="kaochangResult">
					<h3 class="text-center">考场查询结果</h3>
					<table class="table table-striped table-hover table-condensed table-bordered">
						<tr>
							<td>学号</td>
							<td id="result1"></td>
						</tr>
						<tr>
							<td>姓名</td>
							<td id="result2"></td>
						</tr>
						<tr>
							<td>班级</td>
							<td id="result3"></td>
						</tr>
						<tr>
							<td>考场</td>
							<td id="result4"></td>
						</tr>
						<tr>
							<td>所在列</td>
							<td>第<span id="result5"></span></td>
						</tr>
						<tr>
							<td>座位号</td>
							<td id="result6"></td>
						</tr>
						<tr>
							<td>考试时间</td>
							<td id="result7"></td>
						</tr>
					</table>
				</div>
				<!--考场查询结果展示结束-->
				<!--考场开始-->
				<div id="kaoChang" class="row">
					<div class="col-lg-12 col-sm-12">
						<form id="formKaoChang" action="/chaxun/index.php/Home/Index" class="form-horizontal" method="post">
							<h2 class="text-center">考场查询</h2>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs" for="stuNumKC">学号:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-ok-circle"></i>
										</div>
										<input type="text" name="stuNumCK" id="stuNumKC" placeholder="请输入您的学号" class="form-control">
									</div>
								</div>
								<span id="stuNumTipKC" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs" for="stuNameKC">姓名:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-user"></i>
										</div>
										<input type="text" name="stuNameKC" id="stuNameKC" placeholder="请输入您的姓名" class="form-control">
									</div>
								</div>
								<span id="stuNameTipKC" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs" for="captchaKC">验证码:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-asterisk"></i>
										</div>
										<input type="text" name="captcha" id="captchaKC" placeholder="请输入下方的验证码" class="form-control">
									</div>
								</div>
								<span id="captchaTipKC" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs"></label>
								<div class="col-sm-5">
									<img src="/chaxun/index.php/Home/Index/verifyImg" alt="验证码" onclick="javascript:this.src='/chaxun/index.php/Home/Index/verifyImg?tm='+Math.random();" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs"></label>
								<div class="col-sm-5">
									<input type="submit" class="btn btn-primary form-control hwLayer-ok" name="submitKC" id="submitKC" value="点击查询" />
								</div>
							</div>
						</form>
					</div>
				</div>
				<!--kaoChang 结束-->


				<!--宿舍查询结果展示开始-->
				<div id="suSheResult">
					<h3 class="text-center">宿舍查询结果</h3>
					<table class="table table-hover table-striped table-condensed table-bordered">
						<tr>
							<td>学号</td>
							<td id="SSresult1"></td>
						</tr>
						<tr>
							<td>身份证号后四位</td>
							<td id="SSresult2"></td>
						</tr>
						<tr>
							<td>宿舍信息</td>
							<td id="SSresult3"></td>
						</tr>
						<tr>
							<td>备注</td>
							<td id="SSresult4"></td>
						</tr>
					</table>
				</div>
				<!--宿舍查询结果展示结束-->
				<!--宿舍查询开始-->
				<div id="suShe" class="row">
					<div class="col-lg-12 col-sm-12">
						<form id="formSS" action="/chaxun/index.php/Home/Index" class="form-horizontal" method="post">
							<h2 class="text-center">新生宿舍查询</h2>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs" for="stuNumSS">学号:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-ok-circle"></i>
										</div>
										<input type="text" name="stuNumSS" id="stuNumSS" placeholder="请输入您的学号" class="form-control">
									</div>
								</div>
								<span id="stuNumTipSS" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs" for="stuLast4">身份证号后四位:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-user"></i>
										</div>
										<input type="text" name="stuLast4" id="stuLast4" placeholder="请输入您的身份证号后四位" class="form-control">
									</div>
								</div>
								<span id="stuLast4TipSS" class="text-danger"></span>

							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs" for="captchaSS">验证码:</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-asterisk"></i>
										</div>
										<input type="text" name="captchaSS" id="captchaSS" placeholder="请输入下方的验证码" class="form-control">
									</div>
								</div>
								<span id="captchaTipSS" class="text-danger"></span>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs"></label>
								<div class="col-sm-5">
									<img src="/chaxun/index.php/Home/Index/verifyImg" alt="验证码" onclick="javascript:this.src='/chaxun/index.php/Home/Index/verifyImg?tm='+Math.random();" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label hidden-xs"></label>
								<div class="col-sm-5">
									<input type="submit" class="btn btn-primary form-control" name="submitSS" id="submitSS" value="点击查询">
									<input type="hidden" name="flag" id="flag" value="1"/>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!--宿舍查询结束-->

				<div class="well">
					<div class="pull-right hidden-xs">
						<img src="/chaxun/Public/img/code.jpg" width="100px" />
					</div>
					<h4>注意：</h4>
					<p>1. 账号不存在说明数据库里没有您的信息！</p>
					<p>2. 如有问题请联系管理员！ </p>
				</div>
			</div>
		</div>
		<div class="footer">
			&copy; 2016-2016 Northeastern University 资源与土木工程学院  地理信息系统与地图制图. <br />
			<a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=WyEzOjU8My46NXUzKy4bPTQjNjoyN3U4NDY" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_02.png"/></a>        
			author： 张桓；  All rights reserved.<br />
			技术咨询：john；   248404941（QQ）；yz30.com@aliyun.com（email）；
		</div>
	</div>
	<!-- End container-->




	<script src="/chaxun/Public/js/jquery-1.10.1.js"></script>
	<script src="/chaxun/Public/js/jquery.js"></script>
	<script src="/chaxun/Public/js/jquery.ui.js"></script>
	<script src="/chaxun/Public/js/jquery-3.1.1.min.js"></script>
	<script src="/chaxun/Public/js/bootstrap.min.js"></script>
	<script src="/chaxun/Public/js/jquery.validate.js"></script>

	<script>
        /**
         * Created by Administrator on 2016/11/13.
         */

//导航栏切换
        $(function(){
            $('button.first').on('mouseover', function(){
                $('#suShe').css('display', 'none');
                $('#suSheResult').css('display', 'none');
                $('#kaoChang').css('display', 'block');
                $('button.first').addClass('btn-success');
                $('button.second').removeClass('btn-success');

            });
            $('button.second').on('mouseover', function(){
                $('#suShe').css('display', 'block');
                $('#kaoChang').css('display', 'none');
                $('#kaochangResult').css('display', 'none');
                $('button.second').addClass('btn-success');
                $('button.first').removeClass('btn-success');
            });
        });



        //考场查询  校验数据并发送数据
        $(function(){

            //校验数据
            $('#stuNumKC').on('click', function () {
                $('#stuNumTipKC').removeClass('text-danger').text('');
                $('#stuNumKC').css('border', '1px solid #CCCCCC');
                $('#submitKC').removeClass('disabled')
                $('#submitKC').css('cursor', 'pointer');

            });
            $('#stuNameKC').on('click', function () {
                $('#stuNameTipKC').removeClass('text-danger').text('');
                $('#stuNameKC').css('border', '1px solid #CCCCCC');
                $('#submitKC').removeClass('disabled');
                $('#submitKC').css('cursor', 'pointer');

            });
            $('#captchaKC').on('click', function () {
                $('#captchaTipKC').removeClass('text-danger').text('');
                $('#captchaKC').css('border', '1px solid #CCCCCC');
                $('#submitKC').removeClass('disabled');
                $('#submitKC').css('cursor', 'pointer');

            });
            $('#submitKC').on('click', function(event){
                event.preventDefault();
                //取得数据
                var stuNameKC = $('#stuNameKC').val();
                var stuNumKC = $('#stuNumKC').val();
                var captchaKC = $('#captchaKC').val();
                if (stuNumKC.length < 6) {
                    $('#stuNumKC').focus();
                    $('#stuNumTipKC').addClass('text-danger').text('学号不得少于六位!');
                    $('#stuNumKC').css('border', '1px solid #A94442');
                    return false;
                }
                if (stuNameKC == '') {
                    $('#stuNameKC').focus();
                    $('#stuNameTipKC').addClass('text-danger').text('姓名不得为空!');
                    $('#stuNameKC').css('border', '1px solid #A94442');
                    return false;
                }
                if (captchaKC.length <5) {
                    $('#captchaKC').focus();
                    $('#captchaTipKC').addClass('text-danger').text('验证码不得小于5位!');
                    $('#captchaKC').css('border', '1px solid #A94442');
                    return false;
                }

                //发送数据
                $.ajax({
                    type: 'POST',
                    data: {
                        stuNameKC : stuNameKC  ,
                        stuNumKC  : stuNumKC   ,
                        captchaKC : captchaKC  ,
                    },
                    url: '/chaxun/index.php/Home/Index',
                    beforeSend: function(){
                        $('#submitKC').addClass('disabled').val('数据交互中请稍后');
                        $('#submitKC').css('cursor', 'not-allowed');
                    },
                    success: function (res) {
                        if (res == '验证码错误!'){
                            //验证码出错
                            $('#captchaKC').focus();
                            $('#captchaTipKC').addClass('text-danger').text(res);
                            $('#captchaKC').css('border', '1px solid #A94442');
                        } else if(res == '学号不存在！'){
                            //学号不存在
                            $('#stuNumKC').focus();
                            $('#stuNumTipKC').addClass('text-danger').text(res);
                            $('#stuNumKC').css('border', '1px solid #A94442');
                        } else if(res == '姓名与学号不匹配!'){
                            //学号与姓名不匹配
                            $('#stuNameKC').focus();
                            $('#stuNameTipKC').addClass('text-danger').text(res);
                            $('#stuNameKC').css('border', '1px solid #A94442');
                        } else {
                            $('#kaochangResult').css('display', 'block');
                            $('#kaochang').css('display', 'none');
                            $('#result1').text(res['stuNum']);
                            $('#result2').text(res['stuName']);
                            $('#result3').text(res['_class']);
                            $('#result4').text(res['addr']);
                            $('#result5').text(res['_list']);
                            $('#result6').text(res['num']);
                            $('#result7').text(res['date']);

                        }

                    },

                    complete: function(){
                        $('#submitKC').removeClass('disabled').val('提交查询');
                        $('#submitKC').css('cursor', 'pointer');
                    }
                });
            });





        });


        //新生宿舍查询  校验数据并发送数据
        $(function(){

            //校验数据
            $('#stuNumSS').on('click', function () {
                $('#stuNumTipSS').removeClass('text-danger').text('');
                $('#stuNumSS').css('border', '1px solid #CCCCCC');
                $('#submitSS').removeClass('disabled')
                $('#submitSS').css('cursor', 'pointer');

            });
            $('#stuLast4').on('click', function () {
                $('#stuLast4TipSS').removeClass('text-danger').text('');
                $('#stuLast4').css('border', '1px solid #CCCCCC');
                $('#submitSS').removeClass('disabled');
                $('#submitSS').css('cursor', 'pointer');

            });
            $('#captchaSS').on('click', function () {
                $('#captchaTipSS').removeClass('text-danger').text('');
                $('#captchaSS').css('border', '1px solid #CCCCCC');
                $('#submitSS').removeClass('disabled');
                $('#submitSS').css('cursor', 'pointer');

            });
            $('#submitSS').on('click', function(event){
                event.preventDefault();
                //取得数据
                var stuNumSS = $('#stuNumSS').val();
                var stuLast4 = $('#stuLast4').val();
                var captchaSS = $('#captchaSS').val();
                var flag = $('#flag').val();
                if (stuNumSS.length < 6) {
                    $('#stuNumSS').focus();
                    $('#stuNumTipSS').addClass('text-danger').text('学号不得少于六位!');
                    $('#stuNumSS').css('border', '1px solid #A94442');
                    return false;
                }
                if (stuLast4.length != 4) {
                    $('#stuLast4').focus();
                    $('#stuLast4TipSS').addClass('text-danger').text('身份证号后四位!');
                    $('#stuLast4').css('border', '1px solid #A94442');
                    return false;
                }
                if (captchaSS.length <5) {
                    $('#captchaSS').focus();
                    $('#captchaTipSS').addClass('text-danger').text('验证码不得小于5位!');
                    $('#captchaSS').css('border', '1px solid #A94442');
                    return false;
                }

                //发送数据
                $.ajax({
                    type: 'POST',
                    data: {
                        stuNumSS : stuNumSS  ,
                        stuLast4  : stuLast4   ,
                        captchaSS : captchaSS  ,
                        flag: flag,
                    },
                    url: '/chaxun/index.php/Home/Index',
                    beforeSend: function(){
                        $('#submitSS').addClass('disabled').val('数据交互中请稍后');
                        $('#submitSS').css('cursor', 'not-allowed');
                    },
                    success: function (res) {
                        if (res == '验证码错误!'){
                            //验证码出错
                            $('#captchaSS').focus();
                            $('#captchaTipSS').addClass('text-danger').text(res);
                            $('#captchaSS').css('border', '1px solid #A94442');
                        } else if(res == '学号不存在！'){
                            //学号不存在
                            $('#stuNumSS').focus();
                            $('#stuNumTipSS').addClass('text-danger').text(res);
                            $('#stuNumSS').css('border', '1px solid #A94442');
                        } else if(res == '学号与身份证号后四位不匹配!'){
                            //学号与省份证号后四位不匹配
                            $('#stuLast4').focus();
                            $('#stuLast4TipSS').addClass('text-danger').text(res);
                            $('#stuLast4').css('border', '1px solid #A94442');
                        } else {
                            $('#suSheResult').css('display', 'block');
                            // $('#suShe').css('display', 'none');
                            $('#SSresult1').text(res['stuNum']);
                            $('#SSresult2').text(res['last4']);
                            $('#SSresult3').text(res['dorNum']);
                            $('#SSresult4').text(res['comment']);
                        }

                    },

                    complete: function(){
                        $('#submitSS').removeClass('disabled').val('提交查询');
                        $('#submitSS').css('cursor', 'pointer');
                    }
                });
            });
        });

	</script>
</body>
</html>