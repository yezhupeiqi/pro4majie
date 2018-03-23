<?php
//header('content-type:text/html;charset=utf-8');
class Database{
    private $host;//主机名
    private $dbname;//数据库名称
    private $username;//用户名
    private $password;//密码
    private $link;//链接
    private $result;//结果
    private static $self;
    //构造静态函数
    private function __construct($config)
    {
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->dbname = $config['dbname'];
        $this->link=@mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        //数据库连接失败时提示
        if(!$this->link){
            exit("数据库连接失败，错误信息".mysqli_connect_error()."<br/>错误代码：".mysqli_connect_errno());
        }
    }
    //创建公开静态方法
    public static function createDb($config){
        if(self::$self == null){
            self::$self = new Database($config);
        }
        return self::$self;
    }
    //数据库语句处理
    public function sqlDeal($sql){
        $this->result = mysqli_query($this->link,$sql);
        return $this->result;
    }
    //数据查询语句
    public function sqlQuery($sql){
        $this->sqlDeal($sql);
        if($this->result){
            $arr = [];
            foreach($this->result as $value){
                $arr[] = $value;
            }
            return $arr;
        }else{
            return "查询失败";
        }
    }
    //析构函数
    public function __destruct(){
        @mysqli_free_result($this->result);
        mysqli_close($this->link);
    }
}
?>