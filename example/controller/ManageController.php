<?php
namespace example\controller;
use ez\core\Controller;
use ez\core\Session;

/**
 * 框架管理器
 * 
 * @author lxj
 */
class ManageController extends Controller {
    
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
                $this->
            }
        }
    }
    
    /**
     * 数据表列表
     * 
     * @access public
     */
    public function index() {
        
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

