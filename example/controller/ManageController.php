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
     * 数据表管理model
     */
    public $table;
    
    
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
        
        $this->table = new Model('tables');
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
    }
    
    /**
     * 数据表详情
     * 
     * @access public
     */
    public function tindex() {
        
    }
    
    /**
     * 添加数据表
     * 
     * @access public
     */
    public function addtable() {
        
    }
    
    /**
     * 编辑数据表
     * 
     * @access public
     */
    public function edittable() {
        
    }
    
    /**
     * 添加字段
     * 
     * @access public
     */
    public function addfield() {
        
    }
    
    /**
     * 编辑字段
     * 
     * @access public
     */
    public function editfield() {
        
    }
    
    
}

