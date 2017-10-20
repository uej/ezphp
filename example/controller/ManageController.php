<?php
namespace example\controller;
use ez\core\Controller;
use ez\core\Session;
use ez\core\Model;

/**
 * 框架管理器
 * 
 * @author lxj
 */
class ManageController extends Controller {
    
    /**
     * 数据表
     */
    public $table;
    
    /**
     * 字段表
     */
    public $field;
    
    
    /**
     * 初始化登录检查
     * 
     * @access public
     */
    public function __construct() {
        parent::__construct();
        if (ACTION_NAME != 'login' && !Session::get('manage')) {
            die('Controller is not exist');
        }
        
        $this->table = new \example\model\TableModel();
        $this->field = new \example\model\FieldsModel();
    }
    
    /**
     * 登录
     * 
     * @access public
     */
    public function login() {
        if (empty(filter_input(INPUT_POST, 'Password'))) {
            $this->display();
        } else {
            $post = filter_input_array(INPUT_POST);
            $pwd  = empty(config('managePwd')) ? ',./mkl098' : config('managePwd');
            if ($post['Name'] == 'lxj2233' && $post['Password'] == $pwd) {
                Session::set('manage', 1);
                $this->redirect('index');
            } else {
                $this->error('something error!');
            }
        }
    }
    
    /**
     * 数据表列表
     * 
     * @access public
     */
    public function index() {
        $tables = $this->table->findPage(10);
        $this->assign('tables', $tables);
        $this->display();
    }
    
    /**
     * 数据表详情
     * 
     * @access public
     */
    public function tindex() {
        $id     = intval(filter_input(INPUT_GET, 'id'));
        
        if ($id > 0) {
            $fields = $this->field->select('*', ['TableID' => $id]);
            $table  = $this->table->get('*', ['ID' => $id]);
            $this->display(['fields' => $fields]);
        } else {
            $this->error('something error!');
        }
    }
    
    /**
     * 添加数据表
     * 
     * @access public
     */
    public function addtable() {
        
        /* 数据插入 */
        if( !empty(filter_input(INPUT_POST, 'TableName')) ) {
            if( $data = $this->table->create() ) {
                
                /* 表名验证 */
                if( empty($data['TableName']) ) {
                    $this->error("请填写表名");
                }
                
                /* 创建表 */
                $res = $this->table->createTable($data['TableName'], $data['Notes']);
                $res || $this->error($this->table->error);
                
                /* 表汇总表配置数据 */
                $data['CreateTime'] = time();
                if( $this->table->insert($data) ) {
                    $this->success("添加成功");
                } else {
                    $this->error($this->table->error);
                }
                
            } else {
                $this->error($this->table->error);
            }
            
        /* 表单展示 */
        } else {
            $this->display();
        }
    }
    
    /**
     * 编辑数据表
     * 
     * @access public
     */
    public function edittable() {
        
        /* 数据插入 */
        if( !empty(filter_input(INPUT_POST, 'TableName')) ) {
            if( $data = $this->table->create() ) {
                
                /* 表名验证 */
                if( empty($data['TableName']) ) {
                    $this->error("请填写表名");
                }
                
                /* 表修改 */
                $id            = intval(filter_input(INPUT_POST, 'ID'));
                $lastTableName = $this->table->get('TableName', ['ID' => $id]);
                $this->table->editTable($lastTableName, $data['TableName'], $data['Notes']);
                
                if( $this->table->update($data, ['ID' => $id]) ) {
                    $this->success("修改成功");
                } else {
                    $this->error($this->table->error);
                }
                
            } else {
                $this->error($this->table->error);
            }
            
        /* 表单展示 */
        } else {
            $id = intval($_GET['id']);
            $this->assign('data', $this->table->get('*', ['ID' => $id]));
            $this->display();
        }
    }
    
    /**
     * 添加字段
     * 
     * @access public
     */
    public function addfield() {
        $id = empty($_GET['tableid']) ? intval($_POST['TableID']) : intval($_GET['tableid']);
        if($id<=0) {
            $this->error("参数错误");
        }
        
        /* 字段添加 */
        if( isset($_POST) && !empty($_POST['FieldName']) ) {
            if( $data = $this->field->create() ) {
                
                /* 字段验证 */
                $this->checkField($data);
                
                /* 创建表字段 */
                $fieldArr            = [];
                $fieldArr['field']   = $data['FieldName'];
                $fieldArr['type']    = $data['FieldType'];
                $fieldArr['length']  = intval($data['FieldSize']);
                $fieldArr['default'] = $data['FieldDefaultValue'];
                $fieldArr['isnull']  = intval($data['FieldNull']);
                $fieldArr['note']    = $data['FieldNote'];
                
                /* 字段添加 */
                $tableName = $this->table->get('TableName', ['ID' => $id]);
                $res       = $this->field->addField($tableName, $fieldArr);
                $res===0 || $this->error($this->field->error);
                
                /* 添加进字段表 */
                $this->field->insert($data) || $this->error("添加字段入字段存储表失败");
                $this->success("操作成功");
                
            } else {
                $this->error($this->field->error);
            }
            
        /* 模板展示 */
        } else {
            $this->assign('table',      $this->table->get('*', ['ID' => $id]));
            $this->assign('input_type', $this->field->input_type);
            $this->assign('type',       $this->field->_type);
            $this->assign('tableid',    $id);
            $this->display();
        }
    }
    
    /**
     * 编辑字段
     * 
     * @access public
     */
    public function editfield() {
        $id      = empty($_GET['id'])      ? intval($_POST['ID'])      : intval($_GET['id']);
        $tableid = empty($_GET['tableid']) ? intval($_POST['TableID']) : intval($_GET['tableid']);
        if($id<=0 || $tableid<=0) {
            $this->error("参数错误");
        }
        
        /* 字段添加 */
        if( isset($_POST) && !empty($_POST['FieldName']) ) {
            if( $data = $this->fields->create() ) {
                
                /* 字段验证 */
                $this->checkField($data);
                
                /* 创建表字段 */
                $fieldArr            = [];
                $fieldArr['field']   = $data['FieldName'];
                $fieldArr['type']    = $data['FieldType'];
                $fieldArr['length']  = intval($data['FieldSize']);
                $fieldArr['default'] = $data['FieldDefaultValue'];
                $fieldArr['isnull']  = intval($data['FieldNull']);
                $fieldArr['note']    = $data['FieldNote'];
                
                /* 字段添加 */
                $tableName = $this->table->get('TableName', ['ID' => $tableid]);
                $res       = $this->field->editField($tableName, $fieldArr);
                $res===0 || $this->error("编辑字段失败");
                
                /* 添加进字段表 */
                $this->fields->update($data, ['ID' => $id]) || $this->error("添加字段入字段存储表失败");
                $this->success("操作成功");
                
            } else {
                $this->error($this->fields->error);
            }
            
        /* 模板展示 */
        } else {
            $this->assign('table',      $this->table->get('*', ['ID' => $id]));
            $this->assign('input_type', $this->field->input_type);
            $this->assign('type',       $this->field->_type);
            $this->assign('tableid',    $tableid);
            $this->assign('data',       $this->field->get('*', ['ID' => $id]));
            $this->display();
        }
    }
    
    /**
     * 字段编辑验证
     * 
     * @access private
     */
    private function checkField($data = NULL) {
        $data = empty($data) ? $_POST : $data;
        
        empty($data['FieldTitle']) && $this->error("请填写字段标识名称");
        empty($data['FieldName'])  && $this->error("请填写字段名称");
        empty($data['FieldType'])  && $this->error("请选择字段输入类型");
        empty($data['FieldNote'])  && $this->error("请填写字段注释");
        in_array($data['FieldType'], ['char', 'varchar'])
        && empty($data['FieldSize'])
        && $this->error("请填写字段长度");
    }
    
    
}

