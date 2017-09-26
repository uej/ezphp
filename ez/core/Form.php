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
     * @param array $field 字段信息 ['type' => '', 'name' => '', 'value' => ]
     * @param array $property 标签属性
     * @param boolen $n_id 是否ID属性同name
     * @access public
     */
    public static function mkform($field, $property = [], $n_id = true)
    {
        if (!empty($field['type'])) {
            return FALSE;
        }
        
        switch ($field['type']) {
            case 'tel':
                return self::input_tel($field, $property, $n_id);
            case 'number':
                return self::input_number($field, $property, $n_id);
            case 'text':
                return self::input_text($field, $property, $n_id);
            case 'select':
                return self::select($field, $property, $n_id);
            case 'radio':
                return self::input_radio($field, $property, $n_id);
            case 'checkbox':
                return self::input_checkbox($field, $property, $n_id);
            case 'password':
                return self::input_password($field, $property, $n_id);
            case 'button':
                return self::input_button($field, $property, $n_id);
            case 'file':
                return self::input_file($field, $property, $n_id);
            case 'submit':
                return self::input_submit($field, $property, $n_id);
            case 'textarea':
                return self::textarea($field, $property, $n_id);
            case 'ueditor':
                return self::ueditor($field, $property, $n_id);
        }
    }
    
    /**
     * 解析property
     * 
     * @access private
     */
    private static function property($data) {
        $str = "";
        foreach ($data as $key => $val) {
            $str .= "\"$key\"=\"$val\" ";
        }
        return $str;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_tel($field, $property = '', $n_id = true)
    {
        $input = "<input type=\"tel\" name=\"{$field['name']}\" ";
        if ($field['value']) {
            $input .= "value=\"{$field['value']}\" ";
        }
        if ($n_id) {
            $input .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $input .= self::property($property);
        }
        $input .= "/>";
        
        return $input;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_number($field, $property = '', $n_id = true)
    {
        $input = "<input type=\"number\" name=\"{$field['name']}\" ";
        if ($field['value']) {
            $input .= "value=\"{$field['value']}\" ";
        }
        if ($n_id) {
            $input .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $input .= self::property($property);
        }
        $input .= "/>";
        
        return $input;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_text($field, $property = '', $n_id = true)
    {
        $input = "<input type=\"text\" name=\"{$field['name']}\" ";
        if ($field['value']) {
            $input .= "value=\"{$field['value']}\" ";
        }
        if ($n_id) {
            $input .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $input .= self::property($property);
        }
        $input .= "/>";
        
        return $input;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function select($field, $property = '', $n_id = true)
    {
        
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_radio($field, $property = '', $n_id = true)
    {
        
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_checkbox($field, $property = '', $n_id = true)
    {
        
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_password($field, $property = '', $n_id = true)
    {
        $input = "<input type=\"password\" name=\"{$field['name']}\" ";
        if ($n_id) {
            $input .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $input .= self::property($property);
        }
        $input .= "/>";
        
        return $input;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_file($field, $property = '', $n_id = true)
    {
        $input = "<input type=\"file\" name=\"{$field['name']}\" ";
        if ($n_id) {
            $input .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $input .= self::property($property);
        }
        $input .= "/>";
        
        return $input;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function textarea($field, $property = '', $n_id = true)
    {
        $html = "<textarea name=\"{$field['name']}\" ";
        if ($n_id) {
            $html .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $html .= self::property($property);
        }
        $html .= ">";
        if ($field['value']) {
            $html .= $field['value'];
        }
        $html .= "</textarea>";
        
        return $html;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_button($field, $property = '', $n_id = true)
    {
        $input = "<input type=\"button\" ";
        if ($field['value']) {
            $input .= "value=\"{$field['value']}\" ";
        }
        if ($n_id) {
            $input .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $input .= self::property($property);
        }
        $input .= "/>";
        
        return $input;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function input_submit($field, $property = '', $n_id = true)
    {
        $input = "<input type=\"submit\" ";
        if ($field['value']) {
            $input .= "value=\"{$field['value']}\" ";
        }
        if ($n_id) {
            $input .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $input .= self::property($property);
        }
        $input .= "/>";
        
        return $input;
    }
    
    /**
     * 生成form表单
     * 
     * @access public
     */
    public static function ueditor($field, $property = '', $n_id = true) {
        $html = "<textarea name=\"{$field['name']}\" ";
        if ($n_id) {
            $html .= "id=\"{$field['name']}\" ";
        }
        if (is_array($property)) {
            $html .= self::property($property);
        }
        $html .= ">";
        if ($field['value']) {
            $html .= $field['value'];
        }
        $html .= "</textarea>";
        $html .= '<script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.config.js"></script>
                <script type="text/javascript" charset="utf-8" src="/js/ueditor/ueditor.all.min.js"></script>
                <script type="text/javascript" charset="utf-8" src="/js/ueditor/lang/zh-cn/zh-cn.js"></script>
                <script>
                    var editor = UE.getEditor("Content", {
                        serverUrl: "' . \ez\core\Route::createUrl($field['path']) . '"
                    });
                </script>';
        
        return $html;
    }

    /**
     * 解析数据
     * 
     * @access public
     */
    public static function decodeStr($str) {
        $dataArr    = explode(',', $str);
        $data       = [];
        foreach ($dataArr as $val) {
            $kv     = explode('=', $val);
            $data[] = ['key' => $kv[0], 'value' => $kv[1]];
        }
        
        return $data;
    }

    /**
     * 表单验证/隐藏域input验证
     * 
     * @param array $fields 字段
     * @param string $signKey 签名
     * @param int $method 传送方式
     * @access public
     */
    public static function checkInput($fields, $signKey, $method = INPUT_POST)
    {
        $str = '';
        foreach ($fields as $k) {
            $str .= $k . filter_input($method, $k);
        }
        
        if (sha1(config('inputSign').$str) == $signKey) {
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
