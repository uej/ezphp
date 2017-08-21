<?php
namespace ez\core;

/**
 * 应用程序类
 * 
 * @author lxj
 */
class Application
{
    /**
     * 初始化应用
     * 
     * @param array $config
     */
    public function __construct()
    {
        if(empty($config['route'])) {
            new Route();
        } else {
            $route = $config['route'];
            new $route();
        }
    }
    
    /**
     * 执行应用
     * 
     * @access public
     */
    public function run()
    {
        $controllerName = '\\' . APP_NAME . '\\controller\\' . ucfirst(CONTROLLER_NAME) . 'Controller';

        if(class_exists($controllerName)) {
            $controller = new $controllerName();
            $action = ACTION_NAME;
            if(method_exists($controller, $action)) {
                $this->aop_start();
                $controller->$action();
                $this->aop_end();
            } else {
                throw new \Exception('not exist Action');
            }
        } else {
            throw new \Exception('not exist Controller');
        }
    }
    
    /**
     * 面向切面，开始前执行检查
     * 
     * @access private
     */
    private function aop_start()
    {
        
    }
    
    /**
     * 结束后执行
     */
}
