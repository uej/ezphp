<?php
namespace ez\core;

/**
 * 框架默认路由
 * 
 * @author lxj
 */
class Route
{
    /**
     * 当前控制器名称
     */
    public $controller;
    
    /**
     * 当前方法
     */
    public $action;
    
    
    /**
     * 路由构造
     * 
     * @access public
     */
    public function __construct()
    {
        $this->parsePath();
        defined('CONTROLLER_NAME') || define('CONTROLLER_NAME', $this->controller);
        defined('ACTION_NAME') || define('ACTION_NAME', $this->action);
    }
    
    /**
     * url解析
     * 
     * @access public
     */
    public function parsePath()
    {
        /* url伪静态 */
        if (config('urlRewrite')) {
            $script_name = isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : $_SERVER['SCRIPT_NAME'];
            $pathinfo = trim(str_replace(Config('urlSuffix'), '', $_SERVER['REDIRECT_PATH_INFO']), '/');
            $param = explode('/', $pathinfo);
        } else {
            if(isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
                $param = explode('/', trim(str_replace(Config('urlSuffix'), '', $_SERVER['PATH_INFO']), '/'));
            } else {
                $param = [];
            }
        }
        
        /* 控制器 */
        if(isset($param[0]) && !empty($param[0])) {
            $this->controller = strtolower($param[0]);
        } else {
            $this->controller = config('defaultController');
        }
        
        /* 方法 */
        if(isset($param[1]) && !empty($param[0])) {
            $this->action = strtolower($param[1]);
        } else {
            $this->action = config('defaultAction');
        }
    }
    
}

