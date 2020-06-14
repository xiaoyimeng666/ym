<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/29
 * Time: 18:07
 */

namespace ymphp\base;


class Session{

    protected static $init   = null;

    /***
     * session初始化
     */
    public static function init(){
        $isDoStart = false;
        if (PHP_SESSION_ACTIVE != session_status()) {
            ini_set('session.auto_start', 0);
            $isDoStart = true;
        }
        if ($isDoStart) {
            session_start();
            self::$init = true;
        } else {
            self::$init = false;
        }
    }

    /**
     * session自动启动或初始化
     */
    public static function boot()
    {
        if (is_null(self::$init)) {
            self::init();
        } elseif (false === self::$init) {
            if (PHP_SESSION_ACTIVE != session_status()) {
                session_start();
            }
            self::$init = true;
        }
    }

    /***
     * @param $name
     * @param string $value
     * 设置session
     */
    public static function set($name, $value=''){
        empty(self::$init) && self::boot();
        $_SESSION[$name] = $value;
    }

    /***
     * @param $name
     * @return null
     * 获取session
     */
    public static function get($name){
        empty(self::$init) && self::boot();
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    /***
     * @param $name
     * @return bool
     * session是否存在
     */
    public static function has($name){
        empty(self::$init) && self::boot();
        return isset($_SESSION[$name]);
    }
}