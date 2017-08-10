<?php
namespace ez\core;

/**
 * 会话操作类
 * 
 * @author lxj
 */
class Session
{
    /**
     * 获取session值
     * 
     * @param string $key Session键
     * @return mixed Session值
     */
    public static function get($key)
    {
        if (!is_string($key) || empty($key) || !isset($_SESSION[$key])) {
            return NULL;
        }
        
        return $_SESSION[$key];
    }
    
    /**
     * 设置session值
     * 
     * @param string $key Session键
     * @param mixed $value Session值
     * @return bool 设置结果
     */
    public static function set($key = '', $value = NULL)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $_SESSION[$k] = $v;
            }
            return TRUE;
        }
        
        if (is_string($key) && !empty($key)) {
            $_SESSION[$key] = $value;
            return TRUE;
        }
        
        return FALSE;
    }
}


