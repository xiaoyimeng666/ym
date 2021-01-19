<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/21
 * Time: 16:26
 */

$isMaster = php_uname('s') == 'Linux' ? true : false;

$config['db']['host'] = '127.0.0.1';
$config['db']['username'] = 'root';
$config['db']['password'] = 'root';
$config['db']['database'] = 'xiaoyimeng';

if($isMaster){
    $config['db']['host'] = 'sdm546979301.my3w.com';
    $config['db']['username'] = 'sdm546979301';
    $config['db']['password'] = '10086000aA';
    $config['db']['database'] = 'sdm546979301_db';
}
$config['defaultController'] = 'Index';
$config['defaultAction'] = 'index';

$config['isMaster'] = $isMaster;


return $config;