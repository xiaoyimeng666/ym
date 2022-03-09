<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/22
 * Time: 15:05
 */

namespace app\model;


use ymphp\base\Model;

class User extends Model {

    public function getUserByIds($ids){
        if (is_array($ids)){
//            $ids = implode("_", $ids);
            return $this->where('id','in',$ids)->find();
        }
        return $this->where('id',"$ids")->find();
    }

}