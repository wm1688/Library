<?php
require '../vendor/autoload.php';
use \Common\RedisLib;

try {
    $redis = new RedisLib();
    $redis->connect();
    $redis->set("test", "Hi Redis");
    echo "set test success \n";

    echo "get test key:". $redis->get("test") ."\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}