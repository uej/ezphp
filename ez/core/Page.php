<?php
namespace ez\core;

/**
 * 数据分页
 * 
 * @author lxj
 */
class Page
{
    /**
     * 数据总条数
     */
    public $totalRows;
    
    /**
     * 每页显示条数
     */
    public $listRows;
    
    /**
     * 是否显示总页数
     */
    public $showTotalPage = true;
    
    /**
     * 分页栏显示页数
     */
    public $rollPage = 5;
    
    /** 
     * 是否显示总记录数
     */
    public $showTotal = true;
    
    /**
     * 是否开启输入页码跳转控件
     */
    public $showInputPage = true;
    
    /**
     * 分页参数标签
     */
    public $pageTag = 'p';
    
    /**
     * 显示页数
     */
    public $showPageSize = 11;
    
    
    /**
     * 构造函数
     * 
     * @param int $total 数据总条数
     * 
     * @access public
     */
    public function __construct($total, $listRows = 20) 
    {
        $this->totalRows = $total;
        $this->listRows = $listRows;
    }
    
    /**
     * 分页生成
     * 
     * @access public
     */
    public function show()
    {
        /* 总数，页数计算 */
        $p     = isset($_GET[$this->pageTag]) ? intval($_GET[$this->pageTag]) : 1;
        $count = $this->totalRows;
        if(!$count) {
            return FALSE;
        }
        $totalPage = ceil($count/$this->listRows);
        if( $this->showPageSize > $totalPage ) {
            $this->showPageSize = $totalPage;
        }
        $p > $totalPage && $p = $totalPage;
        
        if( empty($p) || $p < 0 ) {
            $p     = 1;
            $start = 0;
        } else if( $p > $totalPage ) { 
            $start = ($totalPage-1) * $this->listRows;
        } else {
            $start = (intval($p) - 1) * $this->listRows;
        }
        
        /* get参数 */
        $parameter      = $_GET;
        
        /* 分页html生成 */
        if($totalPage > 1) {
            $html  = '<span class="total">共'.$count.'条，'.$totalPage.'页</span>';
            if( empty($p) || $p == 1 ) {
                $html .= '<span class="disabled">上一页</span>';
            } else {
                $params = $parameter;
                $params['p'] = $p-1;
                $html .= '<a href="'.Route::createUrl(ACTION_NAME, $params).'">上一页</a>';
            }
            if( $p > ceil($this->showPageSize/2) ) {
                $i = $p - floor($this->showPageSize/2);
            }
            if( isset($i) ) {
                $showMax = $p + floor($this->showPageSize/2);
                $this->showPageSize % 2 == 0 && $showMax--;
            } else {
                $showMax = $this->showPageSize;
                $i       = 1;
            }
            if( $i > $totalPage-($this->showPageSize-1) ) {
                $i = $totalPage-($this->showPageSize-1);
            }
            if( $showMax > $totalPage ) {
                $showMax = $totalPage;
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
            if( $p == $totalPage ) {
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
                    if(pattern.test(hrefPageNoValue) && hrefPageNoValue>0 && hrefPageNoValue<='.$totalPage.') {
                        window.location.href="'.$url.'p="+hrefPageNoValue;
                    } else {
                        alert("页数输入不合法");
                        hrefPageNo.focus();
                    }
                }
            </script>';
        }
        
        return $html;
    }
    
}

