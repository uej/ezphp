<?php
namespace ez\core;

/**
 * 表单生成类
 *
 * @author lxjwork
 */
class Form
{
    /**
     * 生成input type=text
     * 
     * @param array $field 字段信息
     * @param array $property 标签属性
     */
    public static function textinput($field, $property = '')
    {
        
    }
    
    /**
     * 表单验证/隐藏域input验证
     * 
     * @param array $fields 字段
     * @param int $method 传送方式
     * @access public
     */
    public static function checkInput($fields, $signKey, $method = INPUT_POST)
    {
        $str = '';
        foreach ($fields as $k) {
            $str .= $k . filter_input($method, $k);
        }
        
        if (sha1($str) == filter_input($method, $signKey)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * 生成表单签名
     * 
     * @param array $fields 字段数组
     * @access public
     */
    public static function makeInputSign($fields)
    {
        $str = '';
        foreach ($fields as $k => $v) {
            $str .= $k . $v;
        }
        return sha1(config('inputSign') . $str);
    }
}
