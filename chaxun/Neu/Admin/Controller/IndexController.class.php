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
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;
use Think\Upload;
use Think\UploadFile;
use Think\Verify;
use Tools\PPage;

//直接使用adminController作为权限控制，没有登录的用户直接跳转到登录的界面
class IndexController extends AdminController{
    public $filename;
    public function index(){
        $this->display();
    }

    public function head(){
        $this->display();
    }

    public function left(){
        //根据管理员获得其角色，进而获得对应的权限
        //①根据管理员id信息获得其本身记录信息
        $admin_id = session('admin_id');
        $manager_info = D('Manager')->find($admin_id);
        $role_id = $manager_info['admin_role_id'];

        //②根据$role_id获得本身记录信息
        $role_info = D('Role')->find($role_id);
        $auth_ids = $role_info['role_auth_ids'];

        //超级管理员没有权限限制
        //③根据$auth_ids获得具体权限
        if ($admin_id === 1){		//超级管理员，所有权限
            $auth_infoA = D('Auth')->where("auth_level=0")->select();   		//父级
            $auth_infoB = D('Auth')->where("auth_level=1")->select();			//子级
        } else {
            $auth_infoA = D('Auth')->where("auth_level=0 and auth_id in ($auth_ids)")->select();   		//父级
            $auth_infoB = D('Auth')->where("auth_level=1 and auth_id in ($auth_ids)")->select();			//子级
        }

        $this->assign('auth_infoA' ,$auth_infoA);
        $this->assign('auth_infoB' ,$auth_infoB);

        $this->display();
    }

    public function right(){
        $this->assign('time', time());
        $this->display();
    }


    //上传考场数据
    public function kaochang(){
        //上传文件
        if ($_FILES){
            $config =  array(
                'maxSize'=>3145728,
                'savePath'=>'/',
            );
            $upload = new Upload($config);
            $info = $upload->upload();
            if (!$info) {
                $this->ajaxReturn($upload->getError());
            } else {
                $this->ajaxReturn($info);
            }
        } else if($_POST) {
            $verify = new Verify();
            if ($verify->check($_POST['captcha'])) {
                if($_POST['info'] != ""){
                    //数据写入
                    $temp = json_decode($_POST['info']);
                    $file_name = './Uploads'.$temp->kaochang->savepath.$temp->kaochang->savename;

                    vendor("PHPExcel");
                    $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                    $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow(); // 取得总行数
//                    $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                    $obj = M('Kaochang');
                    $count1 = $obj->count();
                    for($i=2;$i<=$highestRow;$i++) {
                        set_time_limit(0);
                        $data['stuNum'] =  $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                        $data['stuName'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                        $data['_class']    = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                        $data['addr'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                        $data['_list'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                        $data['num'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                        $data['date'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                        $result = $obj->add($data);
                    }
                    $count = $result - $count1;
                    $this->ajaxReturn($count);
                } else{
                    $this->ajaxReturn(2);
                }
            } else {
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }


    //上传宿舍数据
    public function sushe(){
        if ($_POST){
            $captcha = $_POST['captcha'];
            $verify = new Verify();
            if ($verify->check($captcha)){
                //验证码正确
                if ($_FILES){
                    $config =  array(
                        'maxSize'=>3145728,
                        'savePath'=>'/',
                    );
                    //上传
                    $upload = new Upload($config);
                    $info = $upload->upload();
                    if (!$info) {
                        $this->ajaxReturn($upload->getError());
                    } else {
                        //写入数据库
                        //获取上传文件信息
                        $file_name = './Uploads' . $info['sushe']['savepath'] . $info['sushe']['savename'];
                        vendor("PHPExcel");

                        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                        $objPHPExcel = $objReader->load($file_name, $encode = 'utf-8');
                        $sheet = $objPHPExcel->getSheet(0);
                        $highestRow = $sheet->getHighestRow(); // 取得总行数
                        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                        $obj = M('Sushe');
                        $count1 = $obj->count();
                        for ($i = 2; $i <= $highestRow; $i++) {
                            set_time_limit(0);
                            $data['stuNum'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                            $data['last4'] = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
                            $data['dorNum'] = $objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
                            $data['comment'] = $objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
                            $result = $obj->add($data);
                        }
                        $count = $result - $count1;
                        $this->ajaxReturn($count);
                    }
                }else{
                    //文件未能被上传
                    $this->ajaxReturn(2);
                }
            } else {
                //验证码错误
                $this->ajaxReturn(1);
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


    //下载页面
    public function download(){
        $this->display();
    }

    //下载考场数据
    public function downloadkaochang(){
        $xlsName  = "Kaochang";
        $xlsCell  = array(
            array('kid','编号'),
            array('stuNum','学号'),
            array('stuName','姓名'),
            array('_class','班级'),
            array('addr','考试地点'),
            array('_list','所在列'),
            array('num','序号'),
            array('date','考试时间'),
        );
        $xlsModel = M('Kaochang');
        $xlsData  = $xlsModel->Field('kid,stuNum,stuName,_class,addr,_list,num,date')->select();
        $this->exportExcel($xlsName,$xlsCell,$xlsData);

    }


    //下载宿舍数据
    public function downloadsushe(){
        $xlsName  = "sushe";
        $xlsCell  = array(
            array('sid','编号'),
            array('stuNum','学号'),
            array('last4','身份证后四位'),
            array('dorNum','寝室号'),
            array('comment','备注'),
        );
        $xlsModel = M('sushe');
        $xlsData  = $xlsModel->Field('sid,stuNum,last4,dorNum,comment')->select();
        $this->exportExcel($xlsName,$xlsCell,$xlsData);

    }


    //查看考场数据
     public function overlookK(){
        $info = M('Kaochang');
        $total = $info->count();    //获得总记录数
        $perobj = D('config');
        $perresult = $perobj->find();
        $per = $perresult['page_per']; //设计后台每页显示条数
        $field = $info->getDBfields();      //获取所有字段名称
        $pageobj = new PPage($total, $per);
        $sql = "SELECT kid,stuNum,stuName,_class,addr,_list,num,date FROM neu_kaochang ORDER BY kid DESC ".$pageobj->limit;
        $list = $info->query($sql);
        $show = $pageobj->fpage(array(2,3,4,5,7,8));
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('fields', $field);
        $this->display();

    }

    //修改考场数据
    public function edit(){
        $id = $_GET['kid'];
        if(IS_POST){
            $data = $_POST;
            $info = M('Kaochang');
            $result = $info->where("kid='$id'")->save($data);
            if ($result){
                $this->success('修改成功', 'overlookK');
            } else {
                $this->error('修改失败');
            }
        } else {
            $info = M('Kaochang');
            $fields = $info->getDBfields(); //所有字段
            $result = $info->where("kid='$id'")->find();
            $this->assign('fields', $fields);
            $this->assign('result', $result);
            $this->display();
        }
    }

    //删除考场数据
    public function deleteK(){
        $id = ($_GET['kid']);
        $obj = M('Kaochang');
        $result = $obj->where("kid='$id'")->delete();
        if ($result){
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    /**
     * @param $expTitle
     * @param $expCellName
     * @param $expTableData
     * 写入数据库里
     */
    public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    //查看新生宿舍数据
    public function overlookS(){
        $info = M('Sushe');
        $total = $info->count();    //获得总记录数
        $perobj = D('config');
        $perresult = $perobj->find();
        $per = $perresult['page_per']; //设计后台每页显示条数
        $field = $info->getDBfields();      //获取所有字段名称
        $pageobj = new PPage($total, $per);
        $sql = "SELECT sid,stuNum,last4, dorNum,comment FROM neu_sushe ORDER BY sid DESC ".$pageobj->limit;
        $list = $info->query($sql);
        $show = $pageobj->fpage(array(2,3,4,5,7,8));
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('fields', $field);
        $this->display();
    }


    //删除s宿舍数据
    public function deleteS(){
        $id = ($_GET['sid']);
        $obj = M('Sushe');
        $result = $obj->where("sid='$id'")->delete();
        if ($result){
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    //修改宿舍数据
    public function editS(){
        $id = $_GET['sid'];
        if(IS_POST){
            $data = $_POST;
            $info = M('Sushe');
            $result = $info->where("sid='$id'")->save($data);
            if ($result){
                $this->success('修改成功', 'overlookS');
            } else {
                $this->error('修改失败');
            }
        } else {
            $info = M('Sushe');
            $fields = $info->getDBfields(); //所有字段
            $result = $info->where("sid='$id'")->find();
//            dump($result);
            $this->assign('fields', $fields);
            $this->assign('result', $result);
            $this->display();
        }
    }


    //直接操作数据表
    public function manageSheet(){
        $this->display();
    }

    //删除宿舍表中指定编号的数据
    public function deleteSsome(){
        $lower = $_POST['lower1'];
        $upper = $_POST['upper1'];

        $obj = M('Sushe');
        $sql = "delete from neu_sushe where sid>{$lower} AND sid<{$upper}";
        $result = $obj->query($sql);
        if(!$result){
            $this->ajaxReturn(1);
        } else{
            $this->ajaxReturn(2);
        }

    }

    //删除考场表中指定编号的数据
    public function deleteKsome(){
        $lower = $_POST['lower2'];
        $upper = $_POST['upper2'];

        $obj = M('Kaochang');
        $sql = "delete from neu_kaochang where kid>{$lower} AND kid<{$upper}";
        $result = $obj->query($sql);
        if(!$result){
            $this->ajaxReturn(1);
        } else{
            $this->ajaxReturn(2);
        }
    }

    //清空宿舍数据表
    public function deleteSAll(){
        $obj = M('Sushe');
        $sql = "TRUNCATE TABLE neu_sushe";
        $result = $obj->query($sql);
        if (!$result){
            $this->success('已经成功清除宿舍数据表', 'sushe');
        }else{
            $this->error('清楚数据表失败');
        }
    }


    //清空考场数据表
    public function deleteKAll(){
        $obj = M('Kaochang');
        $sql = "TRUNCATE TABLE neu_kaochang";
        $result = $obj->query($sql);
        if (!$result){
            $this->success('已经成功清除考场数据表', 'sushe');
        }else{
            $this->error('清除数据表失败');
        }
    }



}


