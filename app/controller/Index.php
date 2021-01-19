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

class Index extends Controller {
    public function index(){
        $this->assign('good', '123');
        $this->assign('arr', [1,2,3,4,5]);

        return $this->view();
//        echo 'hello world';
    }
    public function add(){
        echo 1;
    }

    public function aaa(){
        echo '<pre>';
        $user = new User();
        $user->a = 1;
        $user->save();
    }

    public function test2(){
        //如果$arr是为5组3个相同数字的数组则返回真，否则返回假
        $arr = [1,1,1,2,2,2,3,3,3,4,4,4,5,5,5];
        echo '<pre>';
        $arr1 = array_count_values($arr);
        print_r($arr1);
        $arr2 = array_unique($arr1);

        if(count($arr1) == 5 && count($arr2) == 1 && array_shift($arr2) == 3){
            echo 'yes';
        }
$a = array_merge_recursive(['a','b'],[1,2,'b']);
        print_r($a);
    }

    public function test(){
        $arr = [1,9,5,8,3,2,4,7,6,10];
        echo "<pre>";
        print_r($arr);
        for($i = 0; $i < count($arr); $i++){
            for($j = 0; $j < count($arr) - $i - 1; $j++){
               if($arr[$j] > $arr[$j + 1]){
                   $tem = $arr[$j];
                   $arr[$j] = $arr[$j +1];
                   $arr[$j + 1] = $tem;
               }
            }
        }
        print_r($arr);
    }

    public function test1(){
        //交替输出数组中的值
        $arr = [
            [1,2,3],
            ['a', 'b', 'c', 'd']
        ];
        $max = 0;
        $fin = [];
        foreach ($arr as $key => $val) {
            if(count($val) > $max)$max = count($val);
        }
        for ($i = 0; $i < $max; $i++){
            foreach ($arr as $key => $val) {
                isset($val[$i]) ?  array_push($fin, $val[$i]) : '' ;
            }
        }
        var_dump($fin);
    }
}