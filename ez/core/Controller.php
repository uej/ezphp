<?php
namespace ez\core;

/**
 * 框架控制器
 * 
 * @author lxj
 */
class Controller
{
    /**
	 * 模板文件路径
	 */
	public $templateDir;
	
	/**
	 * 模板后缀名
	 */
	public $suffix;
    
    
    /**
     * 构造函数
     * 
     * @access public
     */
    public function __construct()
    {
        $this->suffix = config('templateSuffix');
		$this->templateDir = '../view/' . strtolower(CONTROLLER_NAME) . '/';
    }
    
    /**
     * 显示模板
     * 
     * @param string $view 模板名称，小写，为空则根据方法名自动定位
     * @param array $data 传递到模板的变量数组
     * 
     * @access public
     */
    public function display($view = '', $data = [])
    {
        /* 未指定模板，在默认位置寻找模板加载 */
        if (is_array($view)) {
            extract($view);
            $template = '../view/' . strtolower(CONTROLLER_NAME) . '/' . strtolower(ACTION_NAME) . '.php';
            if(!is_file($template)) {
                throw new \Exception('template not exists');
            }
            include $template;
            
        } else if (is_string($view)) {
            if (is_array($data) && !empty($data)) {
                extract($data);
            }
            
            if (is_file($view)) {
                include $view;
            } else {
                $template = '../view/' . strtolower(CONTROLLER_NAME) . '/' . strtolower(ACTION_NAME) . '.php';
                if(!is_file($template)) {
                    throw new \Exception('template not exists');
                }
                include $template;
            }
        }
    }
    
    /**
     * Action跳转(URL重定向)
     * 
     * @param string $url 跳转的URL表达式
     * @param array $params 其它URL参数
     * @param integer $delay 延时跳转的时间 单位为秒
     * @param string $msg 跳转提示信息
     * @return void
     * 
     * @access public
     */
    public function redirect($url, $params = [], $delay = 0, $msg='')
    {
        $url = Route::createUrl($url, $params);
        Route::redirect($url,$delay,$msg);
    }
    
    /**
     * ajax返回
     * 
     * @param array 数据数组
     * @param string JSON、STRING
     */
    public function ajaxReturn($data, $type = 'JSON')
    {
        switch (strtoupper($type)) {
            case 'JSON':
                is_array($data) && die(json_encode($data, JSON_UNESCAPED_UNICODE));
                break;
            case 'STRING':
                is_string($data) && die($data);
                break;
        }
    }
    
}



