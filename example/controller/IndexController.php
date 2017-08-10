<?php
namespace example\controller;
use ez\core\Controller;

/**
 * 示例控制器
 * 
 * @author lxj
 */
class IndexController extends Controller
{
    public function index()
    {
        $Test = new \example\model\TestModel();
        $data = $Test->query("insert cmf_test (Value, Num) values ('加速的飒飒', '3')");
        var_dump($data);
//        $data = $Test->insert([''])
//        $data = $Test->findPage(5);
        
//        $Page = new \ez\core\Page($Test->count(), 5);
        
//        $this->display();
        
    }
    
    public function up() {
        $Upload = new \ez\driver\Upload();
        $Upload->doUpload();
    }
}
