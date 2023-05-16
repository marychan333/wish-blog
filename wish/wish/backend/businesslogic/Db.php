<?php
class Db
{
    public $conn;
    private $host = '127.0.0.1';
    private $usr = 'root';
    private $pwd = '123456';
    private $dbname = 'talk';
    private $port = 3306;

    //构造方法
    function __construct()
    {
        $conn = mysqli_connect($this->host, $this->usr, $this->pwd, $this->dbname, $this->port);
        if (mysqli_connect_errno($conn)) {
            echo "Database connection failed！" . mysqli_connect_error();
        }
        //设置数据库字符集
        mysqli_set_charset($conn, 'utf8');
        $this->conn = $conn;
    }



    //析构方法
    function __destruct()
    {
        mysqli_close($this->conn);
    }


}