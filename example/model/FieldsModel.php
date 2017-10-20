<?php
namespace example\model;
use ez\core\Model;

/**
 * 全局字段表
 * 
 * @access public
 */
class FieldsModel extends Model {
    
    /**
     * @var string 表名
     */
    public $tableName = 'common_fields';
    
    /** 
	 * @var array 字段输入类型
	 */
	protected $input_type = array(
        'text',  		
        'textarea',
        'ueditor',
        'password',
        'number', 
        'select',  
        'checkbox',
        'radio', 
        'file',
        'submit',
        'button',
        'tel',
    );
    
    /** 
	 * @var array 字段类型
	 */
    protected $_type = ['int', 'char', 'varchar', 'text', 'double', 'float', 'tinyint', 'smallint', 'bigint', 'mediumtext', 'longtext'];
    
    /**
	 * @var array 不需要字符编码的类型
	 */
	private $nocharsetArr = array("int", 'smallint', 'bigint', "tinyint", "float", 'double');
    
    
    /**
     * 添加字段
     * 
     * @param string $tableName 数据表名
     * @param array $fieldMethod   ( field=>字段名      type=>类型      length=>长度/值 default=>默认值
	 * 		                      isnull=>是否可为空 charset=>字符集 note=>注释)
     * @access public
     * 
     * @return bool
     */
    public function addField($tableName, $fieldMethod = []) {
        if( empty($fieldMethod) ) {
            return false;
        }
        
        /* sql组装 */
        $sql     = "ALTER TABLE `{$this->tablePrefix}$tableName` ";
		$length  = empty($fieldMethod['length'])  ? ""     : "(".$fieldMethod['length'].")";
        $isnull  = $fieldMethod['isnull'] == 1    ? "NULL" : "NOT NULL";
        $default = $fieldMethod['default'] === "" ? ""     : "DEFAULT '".$fieldMethod['default']."'";
        $note    = empty($fieldMethod['note'])    ? ""     : "COMMENT '".$fieldMethod['note']."'";
        if( !in_array($fieldMethod['type'], $this->nocharsetArr) ) {
            $charset = "CHARACTER SET utf8 COLLATE utf8_general_ci";
        }
        $sql .= "ADD `{$fieldMethod['field']}` {$fieldMethod['type']}$length $charset $isnull $default $note";
        
        return $this->query($sql);
    }
    
    
}

