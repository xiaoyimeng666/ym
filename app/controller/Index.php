<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/21
 * Time: 17:27
 */

namespace app\controller;


use app\model\User;
use ymphp\base\Controller;
use ymphp\base\Cookie;
use ymphp\base\Session;

class Index extends Controller {
    public function index(){
        Cookie::set('aa','asdasdasd');
        var_dump($_COOKIE);
//        return $this->view();
    }

    public function login(){
        $user = Cookie::get();
//        if($user)echo 1;
        var_dump($user);
    }


}