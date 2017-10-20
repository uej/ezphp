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
        /* url重写 */
        if (config('urlRewrite')) {
            $script_name = isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : $_SERVER['SCRIPT_NAME'];
            if (isset($_SERVER['REDIRECT_PATH_INFO']) && !empty($_SERVER['REDIRECT_PATH_INFO'])) {
                $pathinfo = trim(str_replace(Config('urlSuffix'), '', $_SERVER['REDIRECT_PATH_INFO']), '/');
                $param = explode('/', $pathinfo);
            } elseif (isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
                $param = explode('/', trim(str_replace(Config('urlSuffix'), '', $_SERVER['PATH_INFO']), '/'));
            }
            
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
    
    /**
     * url生成，根据默认路由规则
     * 
     * @param string $url Url表达式，格式:控制器/方法
     * @param array $params 参数，键值对数组
     * @param boolen $domain 是否显示域名
     * @param boolen $redirect 是否跳转
     * @return string URL
     * @access public
     */
    public static function createUrl($url = '', $params = [], $domain = TRUE, $redirect = FALSE)
    {
        if (empty($url)) {
            return HTTPHOST;
        }
        
        /* 域名显示判断 */
        if (!config('urlRewrite')) {
            $realurl = $domain ? HTTPHOST . '/index.php' : '/index.php';
        } else {
            $realurl = $domain ? HTTPHOST : '';
        }
        
        /* get参数组装 */
        $get = '';
        if (is_array($params) && !empty($params)) {
            foreach ($params as $key => $value) {
                if (strpos($get, '?') !== FALSE) {
                    $get .= "&$key=$value";
                } else {
                    $get .= "?$key=$value";
                }
            }
        }
        
        $path  = explode('/', $url);
        $total = count($path);
        if ($total == 1) {
            $realurl .= '/' . CONTROLLER_NAME . '/' . $path[0] . config('urlSuffix');
        } else if ($total == 2) {
            $realurl .= '/' . $path[0] . '/' . $path[1] . config('urlSuffix');
        }
        
        $realurl .= $get;
        if ($redirect) {
            self::redirect($realurl);
        } else {
            return $realurl;
        }
    }
    
    /**
     * URL重定向
     *
     * @param string  $url  地址
     * @param integer $time 时间
     * @param string  $msg  跳转时的提示信息
     * @access public
     */
    public static function redirect($url, $time = 0, $msg = '')
    {
        /* 多行URL地址支持 */
        $url = str_replace(array("\n", "\r"), '', $url);

        /* 提示信息 */
        if(empty($msg)) {
            $msg = "系统将在{$time}秒之后自动跳转到{$url}！";
        }

        if (!headers_sent()) {
            /* 跳转 */
            if (0 === $time) {
                header("Location: ".$url);
            } else {
                header("refresh:{$time};url={$url}");
                $str = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                $msg = $str . $msg;
                echo($msg);
            }
            exit();
        } else {
            $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
            if ($time != 0) $str .= $msg;
            exit($str);
        }
    }
    
}

