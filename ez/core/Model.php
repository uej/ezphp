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
        } else if ($name == 'statement') {
            return $this->makeMedoo()->statement;
        } else {
            throw new Exception('Attribute not exists');
        }
    }
    
    /**
     * 执行一条原生sql
     * 
     * @param string $sql
     * @return boolean
     */
    public function query($sql)
    {
        $this->makeMedoo()->query($sql);
        if ($this->makeMedoo()->statement->errorCode() === '00000') {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * 分页查找
     * 
     * @param mixed $columns 查询字段
     * @param int $page 每页展示条数
     * @param int $max 最多展示页数
     * @return array 数据结果  [ 'data'=>数据数组, 'pages'=>总页数, 'count'=>数据总条数, 'html'=>分页html代码 ]
     */
    public function findPage($page = 10, $where = null, $max = 9, $columns = '*') {
        
        /* 总数，页数计算 */
        $p     = isset($_GET['p']) ? intval($_GET['p']) : 1;
        $count = $this->count($where);
        if(!$count) {
            return FALSE;
        }
        $pages = ceil($count/$page);
        if( $max > $pages ) {
            $max = $pages;
        }
        $p > $pages && $p = $pages;
        
        if( empty($p) || $p < 0 ) {
            $p     = 1;
            $start = 0;
        } else if( $p > $pages ) { 
            $start = ($pages-1) * $page;
        } else {
            $start = (intval($p) - 1) * $page;
        }
        is_array($where) ? $where = array_merge( $where, [ 'LIMIT' =>  [$start, $page] ] ) : $where = [ 'LIMIT' =>  [$start, $page] ];
        
        /* 数据 */
        $data  = $this->select($columns, $where);
        if(!$data) {
            return FALSE;
        }
        
        /* get参数 */
        $parameter      = $_GET;
        
        /* 分页html生成 */
        if($pages > 1) {
            $html  = '<span class="total">共'.$count.'条，'.$pages.'页</span>';
            if( empty($p) || $p == 1 ) {
                $html .= '<span class="disabled">上一页</span>';
            } else {
                $params = $parameter;
                $params['p'] = $p-1;
                $html .= '<a href="'.Route::createUrl(ACTION_NAME, $params).'">上一页</a>';
            }
            if( $p > ceil($max/2) ) {
                $i = $p - floor($max/2);
            }
            if( isset($i) ) {
                $showMax = $p + floor($max/2);
                $max % 2 == 0 && $showMax--;
            } else {
                $showMax = $max;
                $i       = 1;
            }
            if( $i > $pages-($max-1) ) {
                $i = $pages-($max-1);
            }
            if( $showMax > $pages ) {
                $showMax = $pages;
            }
            for( ; $i<=$showMax; $i++ ) {
                if( $i != $p ) {
                    $params = $parameter;
                    $params['p'] = $i;
                    $html .= '<a href="'.Route::createUrl(ACTION_NAME, $params).'">'.$i.'</a>';
                } else {
                    $html .= '<span class="nowpage">'.$i.'</span>';
                }
            }
            if( $p == $pages ) {
                $html .= '<span class="disabled">下一页</span>';
            } else {
                $params = $parameter;
                $params['p'] = $p+1;
                $html .= '<a href="'.Route::createUrl(ACTION_NAME, $params).'">下一页</a>';
            }
            $params = $parameter;
            unset($params['p']);
            $url = Route::createUrl(ACTION_NAME, $params);
            if( strpos($url, '?') === FALSE ) {
                $url .= '?';
            } else {
                $url .= '&';
            }
            
            $html .= '<span class="turnto">转到</span>
            <input id="jump_page" class="textInput" value="" style="width:30px;" maxlength="10" type="text">
            <span class="turnto">页</span>
            <a href="javascript:void(0)" onclick="jumppage()">GO</a>
            <script>
                function jumppage() {
                    var hrefPageNo = document.getElementById("jump_page");
                    var hrefPageNoValue = hrefPageNo.value;
                    var pattern = /^\d+$/;
                    if(pattern.test(hrefPageNoValue) && hrefPageNoValue>0 && hrefPageNoValue<='.$pages.') {
                        window.location.href="'.$url.'p="+hrefPageNoValue;
                    } else {
                        alert("页数输入不合法");
                        hrefPageNo.focus();
                    }
                }
            </script>';
        }
        
        return [
            'data'      => $data,
            'pages'     => $pages,
            'count'     => $count,
            'html'      => $html,
        ];
        
    }
    
}
