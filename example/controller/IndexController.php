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
<<<<<<< HEAD
        $Test = new \ez\core\Model('test');
        //$data = $Test->update(['Num' => 'sadasdasssssssssssssssssssssssssssssss爱神的箭'], ['ID' => 1]);
        $data = $Test->insert([''])
        var_dump($data);
        var_dump($Test->last());
=======
        var_dump($_GET);
        
>>>>>>> refs/remotes/origin/1.0.0
    }
}
