<?php
namespace Home\Controller;
use Home\Common\DecideController;
use Home\Model\IndexModel;
use Home\Model\kaochangModel;
use Home\Model\susheModel;
use Think\Controller;
use Think\PageAjax;
use Think\Verify;

class IndexController extends DecideController {
//class IndexController extends Controller {

    public function index(){
//        dump($_POST);
        if (IS_POST) {
            if($_POST['flag'] == 1){
                //验证第二个验证码
//                dump($_POST['captchaSS']);
                if ($this->check_verify($_POST['captchaSS'], 1)) {
                    //验证码正确
//                    $this->ajaxReturn('验证码正确!');
                    $sushe = new susheModel();
                    $data = $sushe->getss($_POST['stuNumSS'], $_POST['stuLast4']);
                    if ($data == 0){
                        $this->ajaxReturn('学号不存在！');
                    } else if($data == -1){
                        $this->ajaxReturn('学号与身份证号后四位不匹配!');
                    } else {
                        //dump($data);
                        $this->ajaxReturn($data);
                    }
                } else {
                    //验证码错误
                    $this->ajaxReturn('验证码错误!');
                }
            } else {
                //验证第一个验证码
                if ($this->check_verify($_POST['captchaKC'], 1)) {
                    //验证码正确
    //                $this->ajaxReturn('验证码正确!');
                    $kaochang = new kaochangModel();
                    $data = $kaochang->getkc($_POST['stuNumKC'], $_POST['stuNameKC']);
                    if ($data == 0){
                        $this->ajaxReturn('学号不存在！');
                    } else if($data == -1){
                        $this->ajaxReturn('姓名与学号不匹配!');
                    } else {
                        //dump($data);
                        $this->ajaxReturn($data);
                    }
                } else {
    //                验证码错误
                    $this->ajaxReturn('验证码错误!');
                }


            }

        }
        $this->display();


    }



    //验证码1
    public function verifyImg(){
        $cfg = array(
            'imageH' => 45,
            'imageW' => 200,
            'length' => 5,
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'bg'        =>  array(253, 251, 254),  // 背景颜色
            'fontSize' => 20,
            'useCurve'  =>  false,            // 是否画混淆曲线
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取

        ) ;
        $vry = new Verify($cfg);
        $vry->entry(1);
        $vry->entry(2);
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    public function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }



}
