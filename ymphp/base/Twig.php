<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2021/1/17
 * Time: 15:56
 */

namespace ymphp\base;


class Twig {

    private $config = [];
    public function __construct(){
        $this->config = require(APP_PATH . 'config/config.php');
    }
    public function url($path = ''){
        return $path;
    }

    public function static_url($path = ''){
        if($this->config['isMaster']){
            $path = 'public/'.$path;
        }
        return $path;
    }
}