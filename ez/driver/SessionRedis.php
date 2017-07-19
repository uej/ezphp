<?php
namespace ez\driver;

/**
 * Redis session驱动
 * 
 * @author lxj
 */
class SessionRedis
{
    /**
     * redis
     */
    protected $redis;


    /**
     * 初始化连接redis
     * 
     * @access public
     */
    public function init()
    {
        static $redis = NULL;
        if (!empty($redis)) {
            $this->redis = $redis;
        } else {
            $redis = new \Redis();
            $redis->connect(config('redisHost'), config('redisPort'));
            if (config('redisPassword')) {
                $redis->auth(config('redisPassword'));
            }
            $this->redis = $redis;
        }
        
        $this->redis->select(config('redisSessiondb'));
    }
    
    /**
     * 开启session
     * 
     * @access public
     */
    public function start()
    {
        session_start();
    }
    
    /**
     * open
     * 
     * @access public
     */
    public function open($savePath, $sessionName)
    {
        return TRUE;
    }
    
    /**
     * 读取session
     * 
     * @access public
     */
    public function read($sessionId)
    {
        return $this->redis->get(config('redisSessionPrefix') . $sessionId);
    }
    
    /**
     * 写入session
     * 
     * @access public
     */
    public function write($sessionId, $data)
    {
        $expire = config('sessionExpire');
        if ($expire > 0) {
            return $this->redis->setex(config('redisSessionPrefix') . $sessionId, config('sessionExpire'), $data);
        } else {
            return $this->redis->set(config('redisSessionPrefix') . $sessionId, $data);
        }
    }
    
    /**
     * 关闭Session
     *
     * @access public
     */
    public function close() {
        if (session_id() != '') {
            session_write_close();        
        }
        return true;
    }
   
	/**
     * 删除Session
	 *
     * @access public
     * @param string $sessionId
     * @return bool|void
     */
    public function destroy($sessionId) {
        return $this->redis->delete(config('redisSessionPrefix') . $sessionId);
    }
    
    /**
     * Session 垃圾回收
     * @access public
     * @param string $lifetime
     * @return bool
     */
    public function gc($lifetime) {
        return true;
    }
}

