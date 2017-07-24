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
    public function index() {
        $Test = new \ez\core\Model('test');
        //$data = $Test->update(['Num' => 'sadasdasssssssssssssssssssssssssssssss爱神的箭'], ['ID' => 1]);
//        $data = $Test->insert([''])
        $data = $Test->findPage(5);
        
//        $Page = new \ez\core\Page($Test->count(), 5);
        echo '<pre>';
        var_dump($data['data']);
        echo '</pre>';
        echo $data['html'];
        
    }
}
