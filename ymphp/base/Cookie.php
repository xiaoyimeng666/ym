<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/6/14
 * Time: 17:04
 */

namespace ymphp\base;


class Cookie{

    protected static  $confid = [
        //前缀
        'prefix' => '',
        // 时间
        'expire' => 3600,
        // 有效路径
        'path' => '/',
        // 有效域名
        'domain' => '',
        // 启用安全传输
        'secure' => false,
        // httponly设置
        'httponly' => '',
        // 使用setcookie
        'setcookie' => true,
    ];

    protected static $init = null;

    public static function init(){
        if (!empty(self::$config['httponly'])) {
            ini_set('session.cookie_httponly', 1);
        }
        self::$init = true;
    }

    public static function set($name, $value = ''){
        !isset(self::$init) && self::init();

        $config = self::$confid;
        $name .= $config['prefix'];

        if(is_array($value)){
            $value = 'imen:' . json_encode($value);
        }
        if ($config['setcookie']) {
            setcookie($name, $value, $config['expire'], $config['path'], $config['domain'], $config['secure'], $config['httponly']);
        }
        $_COOKIE[$name] = $value;
    }

    public static function has($name){
        !isset(self::$init) && self::init();

        $config = self::$confid;
        $name .= $config['prefix'];

        return isset($_COOKIE[$name]);
    }

    public static function get($name = ''){
        !isset(self::$init) && self::init();

        if($name == ''){
            $value = $_COOKIE;
        }elseif (isset($_COOKIE[$name])){
            $value = $_COOKIE[$name];
            if(strpos($value, 'imen:')){
                $value = substr($value, 5);
                $value = json_decode($value, true);
            }
        }else{
            $value = null;
        }
        return $value;
    }


}