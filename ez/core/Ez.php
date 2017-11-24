<?php
namespace ez\core;

/**
 * 框架初始化类
 * 
 * @author lxj
 */
class Ez
{
    /**
     * 初始化框架
     * 
     * @access public
     */
    public static function _init()
    {
        /* PHP版本检测 */
        if (version_compare(PHP_VERSION, '5.4.0', '<')) {
            header("Content-type:text/html;charset=utf-8");
            die('PHP版过低! 运行系统必须大于5.4。谢谢合作!');
        }
        
        set_error_handler(['\\ez\\core\\Error', 'errorHandler']);
        set_exception_handler(['\\ez\\core\\Error', 'exceptionHandler']);
        
        /* 是否开启面压缩 */
        if(config('openGzip')) {
            ob_start('ob_gzhandler');
        }
        
        /* session驱动 */
        if (config('sessionAutoStart')) {
            if (empty(config('sessionDriver'))) {
                $sessionSavePath = config('sessionSavePath');
                if (!empty($sessionSavePath) && is_dir($sessionSavePath)) {
                    session_save_path($sessionSavePath);
                }
                session_start();
            } else {
                if(class_exists(config('sessionDriver'))) {
                    new $driver();
                }
            }
        }
        
        /* 设置时区 */
        date_default_timezone_set(config('timeZone'));
        
        /* 常量设置 */
        if (!defined('HTTPHOST')) {
            if(!isset($_SERVER['HTTPS']) || empty(filter_input(INPUT_SERVER, 'HTTPS')) || filter_input(INPUT_SERVER, 'HTTPS')=='off') {
                define('HTTPHOST', 'http://'.filter_input(INPUT_SERVER, 'HTTP_HOST'));
            } else {
                define('HTTPHOST', 'https://'.filter_input(INPUT_SERVER, 'HTTP_HOST'));
            }
        }
        if (!defined('__CSS__'))    define('__CSS__',    HTTPHOST.'/css');
        if (!defined('__JS__'))     define('__JS__',     HTTPHOST.'/js');
        if (!defined('__IMG__'))    define('__IMG__',    HTTPHOST.'/images');
        if (!defined('__VIDEO__'))  define('__VIDEO__',  HTTPHOST.'/videos');
    }
    
    /**
     * 程序开始
     * 
     * @access public
     */
    public static function start()
    {
        self::_init();
        try {
            $app = new Application();
            $app->run();
        } catch (Exception $ex) {
            Log::addLog($ex->__toString());
        }
        
        if(config('openGzip')) {
            ob_end_flush();
        }
    }
}



