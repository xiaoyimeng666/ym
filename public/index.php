<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/21
 * Time: 16:09
 */


define('APP_PATH', __DIR__.'/../');


define('DE_BUG', true);

require(APP_PATH . 'ymphp/YmPhp.php');

require_once  APP_PATH . 'public/vendor/autoload.php';

$config = require(APP_PATH . 'config/config.php');
(new ymphp\YmPhp($config))->run();
