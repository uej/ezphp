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
        $data = $Test->update(['Value' => 'sadasdasssssssssssssssssssssssssssssss爱神的箭'], ['ID' => 1]);
        var_dump($data);
        dump();
    }
}
