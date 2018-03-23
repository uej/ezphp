<?php
namespace example\controller;
use ez\core\Controller;
use ez\core\Route;
use example\model\Test;

/**
 * 示例控制器
 * 
 * @author lxj
 */
class IndexController extends Controller
{
    public function index() {
        die('ssss');
        $Test = new Test();
        $Name = new \example\model\Name();
        
        dump($_GET);
//        var_dump($Test->tt());
//        var_dump($Name->tt());
    }
    
    public function add() {
        $Test = new Test();
        var_dump($Test->insert(['Value' => 'ssd萨达阿斯达', 'Num' => 22]));
        var_dump($Test->select('*', ['ID[<>]' => [100, 120]]));
    }
    
    public function t3() {
        if(empty($_GET['asdasda'])) {
            echo '<a href="'.Route::createUrl('index', ['d' => 'sds']).'">adsd</a>';
        } else {
            $this->success('操作成功');
        }
    }
    
    public function t2() {
        if(empty($_GET)) {
            echo '<a href="'.Route::createUrl('up', ['d' => 'sds']).'">adsd</a>';
        } else {
            $this->error('操作失败', 60);
        }
    }
    
    public function up() {
        $this->display();
    }
    
    public function doup() {
//        die(json_encode(['code' => -1, 'msg' => 'ssdsa萨芬']));
        
        $Up = new \ez\driver\Upload();
        $res = $Up->doUpload();
        die(json_encode($res, JSON_UNESCAPED_UNICODE));
    }
    
    public function verify() {
        if(empty($_GET)) {
            $this->display();
        } else {
            $verify = new \ez\driver\VerifyCode(['imageH' => 55, 'imageW' => 200, 'useZh' => 1, 'useCurve' => 0]);
            $verify->entry('qcode');
        }
    }
    
    public function checkVerify() {
        $verify = new \ez\driver\VerifyCode();
        if($verify->check(filter_input(INPUT_POST, 'VerifyCode'), 'qcode')) {
            echo '1';
        } else {
            echo '0';
        }
    }
}
