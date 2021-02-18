<?php

namespace Common;

use Exception\ConnectException;

/*
 * 共用 Redis 
 */
class Redis {
    public $version = "1.0";
    
    private $redis = null;

    public function connect($ip="127.0.0.1", $port=6379, $db=0) {
        try {
            $this->redis = new redis();
            if (!$this->redis->connect($ip, $port, $db)) {
                throw new ConnectException("connect Error!");
            }
        } catch (\Exception $e) {
            throw new ConnectException($e->getMessage(), 1);
        }
    }

    /**
     * select redis database
     */
    public function select($selectDB){
        $this->redis->select($selectDB);
    }

    // get
    public function get($_key) {
        return $this->redis->get($_key);
    }

    // delete
    public function del($_key) {
        return $this->redis->DEL($_key);
    }

    // get all keys
    public function keys($_key, $_field = '') {
        return $this->redis->keys($_key, $_field);
    }

    // set 
    public function set($_key, $value, $_expire = 0) {
        $res = $this->redis->SET($_key, $value );
        if(!$res) return false;
        // 設定存活時間
        if($_expire != 0) $this->redis->expire($_key, $_expire);
        return true;
    }

    // hash - hmset
    public function hmset($_key, $data, $_expire = 0) {
        // 寫入 hmset
        $res = $this->redis->HMSET($_key, $data);
        if(!$res) return false;
        // 設定存活時間
        if($_expire != 0) $this->redis->expire($_key, $_expire);
        return true;
    }

    // hash - hgetall
    public function hgetall($_key) {
        return $this->redis->HGETALL($_key);
    }
    
    // hash - hget
    public function hget($_key, $_field) {
        return $this->redis->HGET($_key, $_field);
    }

    // hash - hget keys
    public function hkeys($_key, $_field) {
        return $this->redis->hkeys($_key, $_field);
    }
}