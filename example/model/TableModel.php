<?php
namespace example\model;
use ez\core\Model;

/**
 * 全局table表
 * 
 * @author lxj
 */
class TableModel extends Model {
    
    /**
     * 表名
     */
    public $tableName = 'common_table';
    
    /**
     * 储存引擎
     */
    public $engine = [
        'MyISAM',
        'MEMORY',
        'InnoDB',
    ];
    
    
    /**
     * 创建表
     * 
     * @param String $table    表名
     * @param String $notes    表注释
	 * @param String $primaryKey   主键,默认为"ID"
     * @param String $engine   储存引擎
     * 
     * @access public
     */
    public function createTable($table, $notes, $primaryKey="ID", $engine = "MyISAM") {
        $sql = "CREATE TABLE `{$this->tablePrefix}{$table}` ( "
        . "`$primaryKey` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`$primaryKey`)) "
        . "ENGINE = $engine CHARSET=utf8 COLLATE utf8_general_ci COMMENT = '$notes'";
        
		return $this->query($sql);
    }
    
    /**
     * 修改数据表
     * 
     * @param string $lastTableName 历史表名
     * @param String $tableName     新表名
     * @param string $notes         表注释
     * 
     * @access public
     * @return bool
     */
    public function editTable($lastTableName, $tableName, $notes) {
        $sql = "RENAME TABLE `{$this->tablePrefix}$lastTableName` TO `{$this->tablePrefix}$tableName`";
        $this->query($sql);
        $sql = "ALTER TABLE `{$this->tablePrefix}$tableName` COMMENT = '$notes'";
        $this->query($sql);
    }
    
}

