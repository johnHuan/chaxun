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
            url: 'http://202.118.16.50:8033/chaxun/index.php/Home/Index',
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
            url: 'http://202.118.16.50:8033/chaxun/index.php/Home/Index',
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
