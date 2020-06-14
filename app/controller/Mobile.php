<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/5/10
 * Time: 13:14
 */

namespace app\controller;


use app\model\User;
use ymphp\base\Controller;
use ymphp\base\Session;

class Mobile extends Controller
{
    public function index(){
        echo Session::get('user');
        return $this->view();
    }

    public function doLogin(){
        $phone = $this->post('user');
        $password = $this->post('password');
        $u = new User();
        $a = $u->query("select * from `user` where phone = ? and password = ?", [$phone, $password]);
        var_dump($a);die;
        if($a){
            Session::set('user',$a[0]['id']);
            echo "<script>alert('登录成功');window.location.href='index'</script>";
        }else{
            echo "<script>alert('登录失败');window.location.href='index'</script>";
        }
    }
}