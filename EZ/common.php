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
define('CLASS_PATH',    INCLUDE_PATH . 'class' . SEP);                              // 核心类库目录
define('FUNC_PATH',     INCLUDE_PATH . 'function' . SEP);                           // 函数目录
define('PLUGIN_PATH',   INCLUDE_PATH . 'plugin' . SEP);                             // 插件目录

