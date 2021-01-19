<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/22
 * Time: 14:28
 */

namespace ymphp\base;


class View{

    protected $variables = [];

    protected $_controller;

    protected $_action;

    protected $_file;

    protected $_fileTime;

    protected $config;

    public function __construct($controller, $action){
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_file =  new File();
        $this->config = require(APP_PATH . 'config/config.php');
    }

    public function assign($name, $value){
        $this->variables[$name] = $value;
    }


    public function view(){
        /*
        $view_file = APP_PATH . 'app/view/' . $this->_controller . '/' . $this->_action . '.html';
        if(is_file($view_file)){
            $this->_fileTime = [$view_file => filemtime($view_file)];
            $cacheFile = APP_PATH .'runtime/' . md5($view_file) . '.php';
            if(!$this->checkCacheFile($cacheFile)){
                $content = file_get_contents($view_file);
                $this->setCacheFile($cacheFile,$content);
            }
            ob_start();
            ob_implicit_flush(0);
            $this->_file->read($cacheFile, $this->variables);
            $content = ob_get_clean();
            echo $content;
        }else{
            echo "找不到视图文件";
        }
        */

        $path = APP_PATH . 'app/views/view';
        $loader = new \Twig\Loader\FilesystemLoader($path);
        $twig = new \Twig\Environment($loader, [
           'cache' => APP_PATH . 'runtime/temp',
        ]);
        $twig->addGlobal('url', new Twig());

        echo  $twig->render( '/'. $this->_controller . '/' . $this->_action . '.html');
    }

    private function checkCacheFile($cacheFile){
        if(!is_file($cacheFile)){
            return false;
        }
        if(!$handle = fopen($cacheFile,"r")){
            return false;
        }

        preg_match('/\/\*(.+?)\*\//', fgets($handle), $match);
        if(!isset($match[1])){
           return false;
        }
        $includeFile = unserialize($match[1]);
        if(!is_array($includeFile)){
            return false;
        }
        foreach ($includeFile as $path => $time) {
            if(is_file($path) && filemtime($path) > $time){
                return false;
            }
        }
        return true;
    }

    /***
     * @param $cacheFile
     * @param $content
     * 模板解析 v1.0 2020-3-28
     * 1.只解析普通变量
     * 2020-10-11
     * 1.add url()
     *
     */
    private function setCacheFile($cacheFile, $content){
        $content = preg_replace_callback_array([
            '/\{\{ url\(\'(.+)\'\) \}\}/' => function($res){
                if(substr($res[1],0, 5) == 'static' && $this->config['isMaster'])
                    return 'public/' . $res[1];
                return $res[1];
            },
            '/\{\{ (.+) \}\}/' => function($res){
                return "<?php echo ".'$'.$res[1] . " ?>\n";
            },
            '/\{\% (.+) \%\}/' => function($res){

//                $tag = explode(' ',$res[1]);
                return $this->parseTag($res[1]); //$tag[0];
            }
        ],$content);
        $content = "<?php /*" . serialize($this->_fileTime) . "*/ ?>\n" . $content;
        $this->_file->write($cacheFile, $content);
        return ;
    }

    /***
     * @param $content
     * 标签解析 1.0 2020-10-28
     */
    private function parseTag($content){

        $tag = explode(' ',$content);
        return '/***' . $content . ' ***/ <br />';
    }



}