<?php
/**
 * Created by PhpStorm.
 * User: 小依梦
 * Date: 2020/3/21
 * Time: 17:57
 */

namespace ymphp\db;


class Sql{

    protected $table;

    protected  $pk = 'id';

    protected $link;

    protected $bind;

    protected $field = '';

    protected $wheres = '';

    protected $sql = '';

    protected $sqlQuery;

    protected $prepare;

    public function __construct(){
        try{
            $param = [\PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'];
            $this->link = new \PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, $param);
        } catch (\PDOException $e){
            echo "error!:" . $e->getMessage() . "<br />";
            die;
        }
    }

    /***
     * @return string
     * 保存数据
     */
    public function save(){
        $sql = $this->insertSQL($this->data);
//        return $this->query($sql);

        if (!empty($this->prepare)) {
            $this->free();
        }
        try{
            $this->prepare = $this->link->prepare($sql);
            if($this->prepare){
                $this->bindParam2Array($this->data);
            }
            return $this->prepare->execute();
        } catch (\PDOException $e){
            echo "error!:" . $e->getMessage() . "<br />";
            die;
        }
    }

    /***
     * @return $this
     * 指定查询字段
     */
    public function field($field){
        $this->field .= ','.$field;
        $this->field = ltrim($this->field,',');
        return $this;
    }

    /***
     * @param mixed $field     查询字段
     * @param mixed $op        查询表达式
     * @param mixed $condition 查询条件
     * @return $this
     */
    public function where($field, $op = null, $condition = null){
        if(is_null($op) && is_null($condition)){
            if(is_array($field)){

            }else{
                $this->wheres .= $this->wheres == '' ? $field : ' and '.$field;
            }
        }elseif (in_array($op,['null','not null'])){
            $this->wheres .= $this->wheres == '' ? $field . ' is ' . ":$op" : ' and '.$field . ' is ' . ":$op";
            $this->bind[$op] = $op;
        }elseif (is_null($condition)){
            $this->wheres .= $this->wheres == '' ? $field . ' = ' . ":$op" : ' and '.$field . ' = ' . ":$op";
            $this->bind[$op] = $op;
        }elseif (is_array($condition)){

        }else{
            $this->wheres .= $this->wheres == '' ? " $field " . " $op " . " :$condition " : ' and '." $field " . " $op " . " :$condition ";
            $this->bind[$condition] = $condition;
        }
        return $this;
    }
    /***
     * 查询
     */
    public function find(){
        $sql =  $this->selectSQL();
//        print_r($this->bind);
//        echo '<br/>';
//        print_r($sql);
        return $this->query($sql);
//        return $sql;
    }

    /***
     * @param string $sql
     * @return string
     * 执行输入的sql
     */
    public function query($sql, $bind = []){
        $this->sqlQuery = $sql;
        if($bind){
            $this->bind = $bind;
        }
        if (!empty($this->prepare)) {
            $this->free();
        }
        try{
            $this->prepare = $this->link->prepare($sql);
            if($this->prepare){
                $this->bindParam();
//                    $this->bindParam2Array($this->bind);
                $this->prepare->execute();
                return $this->prepare->debugDumpParams();
                return $this->prepare->fetchAll(\PDO::FETCH_ASSOC);
            }
        } catch (\PDOException $e){
            echo "error!:" . $e->getMessage() . "<br />";
            die;
        }
    }

    /***
     *  释放查询结果
     */
    protected function free(){
        $this->prepare = null;
    }

    protected function bindParam2Array($data = []){
        foreach ($data as $key => $value) {
            $this->prepare->bindValue(":$key", $value);
        }
    }

    /***
     * 参数绑定
     */
    protected function bindParam(){
        if($this->bind){
            foreach ($this->bind as $key => $value){
                $this->prepare->bindValue($key+1, $value);
            }
        }
    }


    /***
     * @param $data
     * @return string
     * 创建新增数据的sql
     */
    protected function insertSQL($data){

        if($data){
            $keys = '';
            $values = '';
            foreach ($data as $key => $val){
                $keys .= "`$key`,";
                $values .= ":$key,";
            }
            $keys = rtrim($keys,',');
            $values = rtrim($values,',');
            $sql = "insert into  `" . $this->table . "`($keys) values($values)";
            return $sql;
        }
    }
    /***
     * @param $data
     * @return string
     * 创建查询的sql
     */
    protected function selectSQL(){
        $field = $this->field == '' ? '*' : $this->field;
        $where = $this->wheres == '' ? ' ' : ' where ' .$this->wheres;
        return 'select ' . $field . ' from ' . "`$this->table`" . $where;
    }



    /***
     * @param $data
     * 显示错误信息
     */
    protected function checkError($data){
        if(!$data){
            echo "SQL执行失败";
            echo "<br>错误代码：".$this->link->errno;
            echo "<br>错误信息：".$this->link->error;
            die;
        }
    }


}