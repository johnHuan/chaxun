<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/2
 * Time: 15:19
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

namespace Admin\Model;
use Think\Model;

class ManagerModel extends Model{
    //用户名和密码的校验
    public function checkNamePwd($admin_user, $admin_pwd){
        //根据$admin_user判断账号是否存在  可以是账号，email，电话号码均可以
        $admin_info = $this->where("admin_user='$admin_user' or admin_email='$admin_user' or admin_tel='$admin_user'")->find();
//        dump($admin_info);      //有结果返回结果信息，无结果返回NULL
        if ($admin_info){
            if ($admin_info['admin_pwd'] == sha1($admin_pwd))
                return $admin_info;
        }
        return null;
    }
}
 
 

 
    