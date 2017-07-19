<?php
namespace ez\core;

/**
 * 数据模型类
 * 
 * @author lxj
 */
class Model
{
    /**
     * 表名，带前缀
     */
    public $tableName;
    
    /**
     * 真实表名，带前缀
     */
    public $trueTableName;
    
    /**
     * pdo数据库连接
     */
    protected $pdo;
    
    
    /**
     * 构造函数
     * 
     * @access public
     */
    public function __construct($table = '')
    {
        $this->tableName = empty($table) ? $this->tableName : $table;
        if (empty($this->tableName)) {
            throw new Exception("no tableName");
        }
        
        $this->trueTableName = config('dbPrefix');
    }
    
    /**
     * 创建medoo实例
     * 
     * @access public
     */
    public function makeMedoo()
    {
        static $medoo = '';
        
        if (!empty($medoo)) {
            return $medoo;
        }
        
        $medoo = new Medoo();
        return $medoo;
    }
    
    /**
     * 魔术方法调用数据库
     * 
     * @param string $name 方法名
     * @param array $$arguments 参数数组
     */
    public function __call($name, $arguments)
    {
        if (in_array($name, [
                'query',
                'id', 
                'action',
                'quote',
                'debug',
                'error',
                'log',
                'last',
                'info'
                ])) {
            $medoo = $this->makeMedoo();
            $result = call_user_func_array([$medoo, $name], $arguments);
            return $result;
        } else if (in_array($name, [
                'delete',
                'get', 
                'max',
                'min',
                'avg',
                'has',
                'count',
                'insert',
                'replace',
                'select',
                'sum',
                'update',
                ])) {
            $medoo = $this->makeMedoo();
            array_unshift($arguments, $this->tableName);
            $result = call_user_func_array([$medoo, $name], $arguments);
            return $result;
        } else {
            throw new Exception('Method not exists');
        }
    }
    
    /**
     * 访问pdo数据库连接
     * 
     * @param $name 访问的属性
     * @access public
     */
    public function __get($name)
    {
        if ($name == 'pdo') {
            return $this->makeMedoo()->connect();
        } else {
            throw new Exception('Attribute not exists');
        }
    }
    
    
}
