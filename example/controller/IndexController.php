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
//        $Test = new \example\model\TestModel();
        //$data = $Test->update(['Num' => 'sadasdasssssssssssssssssssssssssssssss爱神的箭'], ['ID' => 1]);
//        $data = $Test->insert([''])
//        $data = $Test->findPage(5);
        
//        $Page = new \ez\core\Page($Test->count(), 5);
        $this->display();
        
    }
    
    public function up() {
        $Upload = new \ez\driver\Upload();
        $Upload->doUpload();
    }
}
