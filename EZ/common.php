<?php
/**
 * EzPHP必经之路
 * 
 * by 江上多南风
 */

// 记录应用开始时间
$GLOBALS['ez_beginTime'] = microtime(TRUE);

define('SEP', DIRECTORY_SEPARATOR);

// 版本信息
const EZ_VERSION     =   '1.0';

// URL 模式定义
const URL_COMMON        =   0;  // 普通模式
const URL_PATHINFO      =   1;  // PATHINFO模式

define('SEP', '/');
defined('APP_DEBUG')    or define('APP_DEBUG',      false);                         // 是否调试模式
defined('APP_PATH')     or define('APP_PATH',       __DIR__.SEP.'example'.SEP);     // 应用目录

// 目录常量
define('CLASS_PATH',    __DIR__.SEP.'class' . SEP);                                 // 核心类库目录
define('FUNC_PATH',     __DIR__.SEP.'function' . SEP);                              // 函数目录
define('PLUGIN_PATH',   __DIR__.SEP.'plugin' . SEP);                                // 插件目录

// 系统信息
if(version_compare(PHP_VERSION,'5.4.0','<')) {
    ini_set('magic_quotes_runtime',0);
    define('MAGIC_QUOTES_GPC',get_magic_quotes_gpc()? true : false);                
}else{
    define('MAGIC_QUOTES_GPC',false);                                               // php5.4以后移除MAGIC_QUOTES_GPC（自动转义'"\）
}
define('IS_CGI',(0 === strpos(PHP_SAPI,'cgi') || false !== strpos(PHP_SAPI,'fcgi')) ? 1 : 0 );
define('IS_WIN',strstr(PHP_OS, 'WIN') ? 1 : 0 );
define('IS_CLI',PHP_SAPI=='cli'? 1   :   0);

if(!IS_CLI) {
    // 当前文件名
    if(!defined('_PHP_FILE_')) {
        if(IS_CGI) {
            //CGI/FASTCGI模式下
            $_temp  = explode('.php',$_SERVER['PHP_SELF']);
            define('_PHP_FILE_',    rtrim(str_replace($_SERVER['HTTP_HOST'],'',$_temp[0].'.php'),'/'));
        }else {
            define('_PHP_FILE_',    rtrim($_SERVER['SCRIPT_NAME'],'/'));
        }
    }
    if(!defined('__ROOT__')) {
        $_root  =   rtrim(dirname(_PHP_FILE_),'/');
        define('__ROOT__',  (($_root=='/' || $_root=='\\')?'':$_root));
    }
}

//静态文件路径
if( !defined('HTTPHOST') )   define('HTTPHOST',   'http://'.$_SERVER['HTTP_HOST']);
if( !defined('SITE_URL') )   define('SITE_URL',   HTTPHOST.__ROOT__);
if( !defined('__UPLOAD__') ) define('__UPLOAD__', SITE_URL.'/public/uploads');	
if( !defined('__CSS__') )    define('__CSS__',  SITE_URL.'/css');
if( !defined('__JS__') )     define('__JS__',   SITE_URL.'/js');
if( !defined('__IMG__') )    define('__IMG__',  SITE_URL.'/images');
