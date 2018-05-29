<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/2
 * Time: 17:23
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

class ConfigController extends AdminController{
    public function set(){
        if(IS_POST){
            $data = $_POST;
            $info = M('Config');
            $result = $info->where('cid=1')->save($data);

            if ($result){
                $this->success('设置成功');
            } else {
                $this->error('设置失败');
            }
        } else {
            $info = M('Config');
            $fields = $info->getDBfields(); //所有字段
            $result = $info->find();
            $this->assign('fields', $fields);
            $this->assign('config', $result);
            $this->display();
        }
    }


}
 
    