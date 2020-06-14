<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/21
 * Time: 16:31
 */

namespace ymphp;

defined('CORE_PATH') or define('CORE_PATH', __DIR__);

class YmPhp{

    protected  $config = [];

    public function __construct($config){
        $this->config = $config;
    }

    /***
     * 运行程序
     */
    public function run(){
        spl_autoload_register([$this, 'loadClass']);
        $this->setDbConfig();
        $this->route();
    }

    /**
     * 配置路由信息
     */
    private function route(){
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = [];

        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);

        $url = trim($url, '/');

        if ($url) {
            $urlArray = explode('/', $url);
            $urlArray = array_filter($urlArray);

            $controllerName = ucfirst($urlArray[0]);

            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;

            array_shift($urlArray);
            $param = $urlArray ? $urlArray : [];
        }

        // 判断控制器和操作是否存在
        $controller = 'app\\controller\\'. $controllerName;
        if (!class_exists($controller)) {
            exit($controller . '控制器不存在');
        }
        if (!method_exists($controller, $actionName)) {
            exit($actionName . '方法不存在');
        }

        $dispatch = new $controller($controllerName, $actionName);

        //以下等同于：$dispatch->$actionName($param)
        call_user_func_array([$dispatch, $actionName], $param);
    }

    /***
     * 设置数据库信息
     */
    public function setDbConfig(){
        if($this->config['db']){
            define('DB_DSN', "mysql:host=".$this->config['db']['host'].";dbname=".$this->config['db']['database']);
            define('DB_HOST', $this->config['db']['host']);
            define('DB_USERNAME', $this->config['db']['username']);
            define('DB_PASSWORD', $this->config['db']['password']);
            define('DB_DATABASE', $this->config['db']['database']);
        }
    }

    /***
     * 自动加载
     * @param $className
     */
    public function loadClass($className){
        $classMap = $this->classMap();

        if(isset($classMap[$className])){
            $file = $classMap[$className];
        }elseif(strpos($className, '\\' )!== false){
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
            if(!is_file($file)){
                return ;
            }
        }else{
            return ;
        }
        include $file;
    }

    protected function classMap(){
        return [
            'ymphp\base\Controller' => CORE_PATH . '/base/Controller.php',
            'ymphp\base\Model' => CORE_PATH . '/base/Model.php',
            'ymphp\base\View' => CORE_PATH . '/base/View.php',
            'ymphp\db\sql' => CORE_PATH . '/db/Db.php',
            'ymphp\db\Sql' => CORE_PATH . '/db/Sql.php',
        ];
    }

}