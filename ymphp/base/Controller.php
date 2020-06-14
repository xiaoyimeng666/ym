<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/21
 * Time: 17:44
 */

namespace ymphp\base;


class Controller{

    protected $_controller;

    protected $_action;

    protected $_view;

    public function __construct($controller, $action){
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    public function assign($name, $value){
        $this->_view->assign($name, $value);
    }

    public function view(){
        $this->_view->view();
    }

    public function get($value = ''){
        if(isset($_GET[$value])){
            return $this->getStr($_GET[$value]);
        }
        return '';
    }
    public function post($value = ''){
        if(isset($_POST[$value])){
            return $this->getStr($_POST[$value]);
        }
        return '';
    }
//找时间把下面代码放到helper.php(未创建)
    private function getStr($var) {
        if (is_array($var)){
            return $this->arr2Str($var);
        }
        elseif(strlen($var)){
            //addslashes() 特殊符号加反斜杠
            $var = $this->filterHtml(addslashes($var));
        }
        return $var;
    }
    private function arr2Str($array){
        foreach($array as $key=>$value){
            if(!is_array($value)){
                $array[$key]=$this->filterHtml(addslashes($value));
            }
            Else{
                $this->arr2Str($array[$key]);
            }
        }
        return $array;
    }
    private function filterHtml($html){
        $newHtml = preg_replace_callback_array([
            "/<!DOCTYPE([^>]*?)>/is" => function($match){
                echo "";
            },
            "/<(\/?)(html|body|head|link|meta|base|input)([^>]*?)>/is" => function($match){
                echo "";
            },
            "/<(script|i?frame|style|title|form)(.*?)<\/\\1>/is" => function($match){
                echo "";
            },
            "/(<[^>]*?\s+)on[a-z]+\s*?=(\"|')([^\\2]*)\\2([^>]*?>)/isU" => function($match){
                echo "\\1\\4";
            },
            "/\s+/" => function($match){
                echo "";
            }
        ],$html);
        return $newHtml;
    }

}