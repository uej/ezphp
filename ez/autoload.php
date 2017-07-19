<?php
/**
 * 系统函数
 * 
 * @author lxj
 */

/**
 * 框架自动加载函数
<<<<<<< HEAD
 * 
 * @param string $classname 类名
=======
>>>>>>> refs/remotes/origin/1.0.0
 */
function ezAutoload($classname)
{
    if (false !== strpos($classname, '\\')) {
            
        /* 定位路径 */
        $filename = __DIR__ . '/../' . str_replace('\\', '/', $classname . '.php');

        /* 引入文件 */
<<<<<<< HEAD
        if (is_file($filename)) {
=======
        if(is_file($filename)) {
>>>>>>> refs/remotes/origin/1.0.0
            include $filename;
        }
    } else {
        $filename = __DIR__ . '/core/' . $classname . '.php';
<<<<<<< HEAD
        if (is_file($filename)) {
=======
        if(is_file($filename)) {
>>>>>>> refs/remotes/origin/1.0.0
            include $filename;
        }
    }
    
    return;
}

/* 注册自动加载函数 */
spl_autoload_register('ezAutoload', TRUE, TRUE);

/**
 * 获取、设置配置函数
 * 
 * @param mixed $name 配置的名称或者 key=>value 对
 * @param mixed $value 配置$name的value
 * 
 * @return mixed 
 */
function config($name=null, $value=null)
{
    global $_config;
    
	/* 无参数时获取所有 */
    if (empty($name)) return $_config;
   
    /* 优先执行设置获取或赋值 */ 
    if (is_string($name)) {

        /* 值过滤 */
        if (is_null($value)) {
            return isset($_config[$name]) ? $_config[$name] : null;
        }

        /* 设置配置定义 */
        $GLOBALS['_config'][$name] = $value;
        return;
    }
	
    /* 批量设置 */ 
    if(is_array($name))
        return $GLOBALS['_config'] = array_merge($_config,array_change_key_case($name));
	
    return null;
}
