<?php
namespace ez\core;
use ez\core\Application;

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
        
        /* 是否开启面压缩 */
		if(config('openGzip')) {
			ob_start('ob_gzhandler');
		}
        
        /* session驱动 */
        if (config('sessionAutoStart')) {
            if(empty(config('sessionDriver'))) {
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
        if( !defined('HTTPHOST') ) {
            if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS']=='off') {
                define('HTTPHOST',   'http://'.$_SERVER['HTTP_HOST']);
            } else {
                define('HTTPHOST',   'https://'.$_SERVER['HTTP_HOST']);
            }
        }
        if(!defined('__CSS__'))     define('__CSS__',    HTTPHOST.'/css');
        if(!defined('__JS__'))      define('__JS__',     HTTPHOST.'/js');
        if(!defined('__IMG__'))     define('__IMG__',    HTTPHOST.'/images');
        if(!defined('__VIDEO__'))   define('__VIDEO__',  HTTPHOST.'/videos');
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
            
        }
    }
}



