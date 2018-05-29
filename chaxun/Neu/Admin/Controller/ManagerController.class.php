<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/2
 * Time: 11:28
 * john_3 web俱乐部
 * supporter: yun
 * author: john
 * ============================================================================
 * 版权所有 2016-2026 john_3网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.John_3.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * 
 */
 
 namespace Admin\Controller;
 use Admin\Model\ManagerModel;
 use Think\Controller;
 use Think\Verify;

 class ManagerController extends Controller{


     public function login(){
        //两个逻辑展示、收集
//            print_r($_POST);
         if (IS_POST) {
             $vry = new Verify();
             if ($vry->check($_POST['captcha'])) {        //验证码错误就提示，正确就不管
                 //管理员账号和密码校验
                 $manager = new ManagerModel();
                 $admin_info = $manager->checkNamePwd($_POST['admin_user'], $_POST['admin_pwd']);
                 if ($admin_info) {
                     dump($admin_info);
                     //登录成功session持久化管理员信息，页面跳转到后台首页
                     session('admin_id', $admin_info['admin_id']);
                     session('admin_user', $admin_info['admin_user']);
                     session('admin_name', $admin_info['admin_name']);
                     session('admin_email', $admin_info['admin_email']);
                     session('admin_tel', $admin_info['admin_tel']);
                     $this->redirect('Index/index');
                 } else {
                     $this->error('用户名或密码错误', U('Manager/Login'));
                 }
             } else {
                 $this->error('验证码错误!', U('Manager/Login'));
             }
         }
             $this->display();
     }

    //验证码
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
         $vry->entry();
     }

     //退出
     public function logout(){
         session('[destroy]');
         $this->success('退出成功', U('Manager/Login'));
     }


 }

 
    