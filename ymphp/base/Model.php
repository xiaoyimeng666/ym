<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/21
 * Time: 17:49
 */

namespace ymphp\base;


use ymphp\db\Sql;

class Model extends Sql {

    protected $model;

    protected $data = [];

    public function __construct(){
        parent::__construct();
        if(!$this->table){
            $this->model = get_class($this);
            $this->table = substr($this->model, strrpos($this->model,'\\') + 1);
        }
    }
//    public function save(){
//        var_dump($this->data);
//    }

    public function setAttr($name, $value){
        $this->data[$name] = $value;
        return $this;
    }

    public function __set($name, $value)
    {
        $this->setAttr($name, $value);
    }
}