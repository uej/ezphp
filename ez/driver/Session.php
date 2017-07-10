<?php
namespace ez\driver;

/**
 * Session驱动抽象类，所有session驱动需继承此类
 * 
 * @author lxj
 */
abstract class Session
{
    /**
     * 构造函数
     * 
     * @access public
     */
    public function __construct() 
    {
		if (config('sessionAutoStart')) {
			$this->init();
			session_set_save_handler(
				array($this, 'open'),
				array($this, 'close'),
				array($this, 'read'),
				array($this, 'write'),
				array($this, 'destroy'),
				array($this, 'gc')
			);
			$this->start();
			register_shutdown_function(array($this, 'close'));
		}
	}
}

