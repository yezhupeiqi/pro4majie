<?php
//模型层父类
class Model
{
    protected $mysqli;

    public function __construct()
    {
        require_once "./public/Database.class.php";
        require_once "./config/config.php";
        $this->mysqli = Database::createDb($config);
    }
    //查询语句
    public function queryData($table, $condition = null)
    {
        $sql = "select * from {$table} WHERE 1=1 ";
        if ($condition == null) {

        } else {
            foreach ($condition as $key => $value) {
                $sql .= "and {$key} = '{$value}'";
            }
        }
        //执行语句
        $data = $this->mysqli->sqlQuery($sql);
        $this->saveSqlOper($sql);
        return $data;
    }
    //插入语句
    public function insertData($table, $condition = null)
    {
        $sql = "insert into {$table}(";
        foreach ($condition as $key => $value) {
            $sql .= "{$key},";
        }
        $sql = rtrim($sql, ",");
        $sql .= ")values(";
        foreach ($condition as $key => $value) {
            $sql .= "'{$value}',";
        }
        $sql = rtrim($sql, ",");
        $sql .= ")";
        $data = $this->mysqli->sqlDeal($sql);
        $this->saveSqlOper($sql);
        return $data;
    }
    //删除语句
    public function deleteData($table, $condition = null)
    {
        $sql = "delete from {$table} where 1=1";
        if ($condition == null) {

        } else {
            foreach ($condition as $key => $value) {
                $sql .= " and {$key}='{$value}'";
            }
        }
        $data = $this->mysqli->sqlDeal($sql);
        $this->saveSqlOper($sql);
        return $data;
    }

    //修改语句
    public function updateData($table, $new, $condition)
    {
        $sql = "update {$table} set";
        foreach ($new as $key => $value) {
            $sql .= " {$key}='{$value}',";
        }
        $sql = rtrim($sql, ",");
        $sql .= "where 1=1";
        foreach ($condition as $key => $val) {
            $sql .= " and {$key}='{$val}'";
        }
        $data = $this->mysqli->sqlDeal($sql);
        $this->saveSqlOper($sql);
        return $data;
    }
    //获取表格总长度
    public function getCount($table, $condition = null)
    {
        $sql = "select COUNT(*) as allCount from {$table} WHERE 1=1 ";
        if ($condition == null) {

        } else {
            foreach ($condition as $key => $value) {
                $sql .= "and {$key} = '{$value}'";
            }
        }
        //执行语句
        $data = $this->mysqli->sqlQuery($sql);
        $this->saveSqlOper($sql);
        return $data;
    }
    //将数据库操作记录到日志文件中
    public function saveSqlOper($sql)
    {
        $handle = fopen('./core/log.txt', 'a');
//      $time = date("Y-m-d H:i:s",time())."  ";
        fwrite($handle, $time . $sql . "\n");
        fclose($handle);
    }

}