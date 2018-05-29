<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/5
 * Time: 11:43
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
 use Admin\Common\AdminController;

 class AuthController extends AdminController{

     /**
      * 权限控制-查看
      */
     public function auth(){
         $info = M('Auth');
         $fields = $info->getDBfields(); //所有字段
         $result = $info->select();
         $this->assign('fields', $fields);
         $this->assign('data', $result);
         $this->display();

     }

     /**
      * 权限控制-修改
      */
     public function authedit(){
         $auth_id = $_GET['auth_id'];
         if(IS_POST) {
             $data = $_POST;
             $info = M('Auth');
             $result = $info->where("auth_id='$auth_id'")->save($data);

             if ($result) {
                 $this->success('设置成功', U('auth'));
             } else {
                 $this->error('设置失败');
             }
         } else {
            $info = M('Auth');
             $fields = $info->getDBfields(); //所有字段
             $result = $info->where("auth_id='$auth_id'")->find();
             $this->assign('fields', $fields);
             $this->assign('data', $result);
             $this->display();
         }
     }


     /**
      * 角色管理-查看
      */
     public function role(){
         $info = M('Role');
         $fields = $info->getDBfields(); //所有字段
         $result = $info->select();
         $this->assign('fields', $fields);
         $this->assign('data', $result);
         $this->display();
     }

     /**
      * 角色管理-修改
      */
     public function roleedit(){
         $role_id = $_GET['role_id'];
         if(IS_POST) {
             $data = $_POST;
             $info = M('Role');
             $result = $info->where("role_id='$role_id'")->save($data);
             if ($result) {
                 $this->success('设置成功', U('role'));
             } else {
                 $this->error('设置失败');
             }
         } else {
             $info = M('Role');
             $fields = $info->getDBfields(); //所有字段
             $result = $info->where("role_id='$role_id'")->find();
             $this->assign('fields', $fields);
             $this->assign('data', $result);
             $this->display();
         }
     }

     /**
      * 管理员管理-查看
      */
     public function manager(){
         $info = M('Manager');
         $fields = $info->getDBfields(); //所有字段
         $result = $info->select();
         $this->assign('fields', $fields);
         $this->assign('data', $result);
         $this->display();
     }

     /**
      * 管理员管理-修改
      */
     public function manageredit(){
         $admin_id = $_GET['admin_id'];
         if(IS_POST) {
             $data = $_POST;
             $data['admin_pwd'] = sha1($data['admin_pwd']);
             $info = M('Manager');
             $result = $info->where("admin_id='$admin_id'")->save($data);
             if ($result) {
                 $this->success('设置成功', U('Manager'));
             } else {
                 $this->error('设置失败');
             }
         } else {
             $info = M('Manager');
             $fields = $info->getDBfields(); //所有字段
             $result = $info->where("admin_id='$admin_id'")->find();
             $this->assign('fields', $fields);
             $this->assign('data', $result);
             $this->display();
         }
     }

     /**
      * 添加管理员
      */
     public function addManager(){
         if(IS_POST) {
             $data = $_POST;
             if($data['admin_role_id'] == 1){
                 $data['admin_role_id'] = 2;
             }
             $data['admin_pwd'] = sha1($data['admin_pwd']);
             $info = M('Manager');
             $result = $info->add($data);
             if ($result) {
                 $this->success('添加成功', U('Manager'));
             } else {
                 $this->error('添加失败');
             }
         } else {
             $info = M('Manager');
             $fields = $info->getDBfields(); //所有字段
             $this->assign('fields', $fields);
             $this->display();
         }
     }


     /**
      * 添加权限
      */
     public function addAuth(){
         if(IS_POST) {
             $data = $_POST;
             $info = M('Auth');
             $result = $info->add($data);
             if ($result) {
                 $this->success('添加成功', U('Auth'));
             } else {
                 $this->error('添加失败');
             }
         } else {
             $info = M('Auth');
             $fields = $info->getDBfields(); //所有字段
             $this->assign('fields', $fields);
             $this->display();
         }
     }



     /**
      * 添加角色
      */
     public function addRole(){
         if(IS_POST) {
             $data = $_POST;
             $info = M('Role');
             $result = $info->add($data);
             if ($result) {
                 $this->success('添加成功', U('Role'));
             } else {
                 $this->error('添加失败');
             }
         } else {
             $info = M('Role');
             $fields = $info->getDBfields(); //所有字段
             $this->assign('fields', $fields);
             $this->display();
         }
     }


 }

 
    