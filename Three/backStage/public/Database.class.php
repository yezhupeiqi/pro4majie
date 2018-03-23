<?php

class Database
{
    private $user;
    private $password;
    private $host;
    private $databaseName;
    private $post;
    private $link;
    private $result;
    private static $db;

    //单例数据库
    public static function createDB($config){
        if(self::$db==null){
            self::$db=new Database($config);
        }
        return self::$db;
    }
    //数据库构造函数 用于储存连接属性 和生成一个数据库的连接
    public function __construct($config){
        $this->host=$config['host'];
        $this->user=$config['user'];
        $this->password=$config['password'];
        $this->databaseName=$config['databaseName'];
        $this->post=$config['post'];

        $this->link=@mysqli_connect($this->host,$this->user,$this->password,$this->databaseName,$this->post);
        if(!$this->link){
            exit("错误信息：".mysqli_connect_error()."<br>"."错误代码：".mysqli_connect_errno());
        }
        mysqli_query($this->link,"set names 'utf8'");
    }
    //语句执行
    public function performSql($sql){
        $handle=fopen('log.txt','a');
        //时间转换
//      $time=date('Y-m-d h:i:s',time());
        $str=$sql .$time;
        fwrite($handle,"$str\n");
        fclose($handle);
        $this->result=mysqli_query($this->link,$sql);
        return $this->result;
    }
    //执行语句提示
    public function dealSql($sql)
    {
        $this->result=mysqli_query($this->link,$sql);
        $row=mysqli_affected_rows($this->link);
        return $row;

    }
    //返回查询结果
    public function querySql($sql){
        $this->performSql($sql);
        if($this->result){
            while($row=mysqli_fetch_assoc($this->result)){
                $arr[]=$row;
            }
            return $arr;
        }
        else{
            return "执行语句失败";
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        @mysqli_free_result($this->result);
        mysqli_close($this->link);
    }
}