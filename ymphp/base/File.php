<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/28
 * Time: 19:42
 */

namespace ymphp\base;


class File
{

    public function write($cacheFile, $content){

        $dir = dirname($cacheFile);
        if(!is_dir($dir)){
            mkdir($dir);
        }
        file_put_contents($cacheFile, $content);
    }

    public function read($cacheFile, $data=[]){
        if(!empty($data) && is_array($data)){
            extract($data);
        }
        include $cacheFile;
    }
}