<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/2
 * Time: 16:24
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

namespace Admin\Common;
use Think\Controller;

class AdminController extends Controller{
    public function _initialize(){
        //判断用户是否登录
        $admin_user = session('admin_user');
        if (!$admin_user){
            $this->error('抱歉您还没有登录，请先登录...', u('Manager/Login'));
        }
    }
}
 

 
    