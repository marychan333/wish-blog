<?php
session_start();
include("Db.php");


class handlerLogic
{

    //登录
    public function login($param)
    {
        $account = $param['account'];//获取登录传递过来的名字
        $db = new Db();//实例化数据库类用来操作数据库
        $sql = "select * from user where account = '$account'";
        $result = mysqli_query($db->conn, $sql);//执行查询
        $user = mysqli_fetch_assoc($result);
        if (!$user) return ['code' => 1, 'msg' => 'user does not exist', 'data' => []];
        if ($user['password'] != md5($param['password'])) return ['code' => 1, 'msg' => 'password error', 'data' => []];
        $_SESSION['user_id'] = $user['id'];//设置session
        $_SESSION['user_name'] = $user['account'];//设置session
        return ['code' => 0, 'msg' => 'success', 'data' => ['user_id' => $user['id'], 'user_name']];
    }

    //注册
    public function register($param)
    {
        if (empty($param['account'])) {
            return ['code' => 1, 'msg' => 'Account must be filled in ', 'data' => []];
        }
        if (empty($param['password'])) {
            return ['code' => 1, 'msg' => 'password must be filled in ', 'data' => []];
        }
        if (mb_strlen($param['account'], 'utf8') < 4) {//账号长度小于4个不行
            return ['code' => 1, 'msg' => 'The account length of the account is 4 digits ', 'data' => []];
        }
        if (mb_strlen($param['password'], 'utf8') < 6) {//密码少于6位不行
            return ['code' => 1, 'msg' => 'The password length of the account is 6 6digits ', 'data' => []];
        }
        $db = new Db();
        $account = $param['account'];
        $password = md5($param['password']);//md5加密
        $add_time = date('Y-m-d H:i:s');//创建时间
        $sql = "select * from user where account = '$account'";//查询账号是否存在
        $result = mysqli_query($db->conn, $sql);//执行查询
        $user = mysqli_fetch_assoc($result);
        if ($user) return ['code' => 1, 'msg' => 'Account already exists ', 'data' => []];
        //插入数据库
        $sql = "INSERT INTO `user` ( `account`, `password`,`add_time`) VALUES  ('$account', '$password','$add_time')";
        $result = mysqli_query($db->conn, $sql);
        $id = mysqli_insert_id($db->conn);
        return ['code' => 0, 'msg' => 'success', 'data' => []];
    }

    //检查是否登录过期
    public function checkLogin()
    {
        if ($_SESSION['user_id']) {
            return ['code' => 0, 'msg' => 'success', 'data' => ['user_name' => $_SESSION['user_name']]];
        } else {
            return ['code' => 1, 'msg' => 'fail'];
        }

    }

    public function loginOut($param)
    {
        unset($_SESSION['user_id']);//删除session
        unset($_SESSION['user_name']);
        return ['code' => 0, 'msg' => 'success', []];

    }

    public function del($param){
        if(!$_SESSION['user_id']){
            return ['code' => 1, 'msg' => 'please login', 'data' => []];
        }
        $id = $param['id'];
        $db = new Db();
        $sql = 'delete FROM talk where id = '.$id;

        $result = mysqli_query($db->conn, $sql);
        $id = mysqli_insert_id($db->conn);
        return ['code' => 0, 'msg' => 'success', 'data' => []];
    }


    //获取所有talk
    public function talk_list()
    {
        $db = new Db();
        $sql = 'select * from talk order by id desc';
        $result = mysqli_query($db->conn, $sql);//执行查询
        $row =[];
        while ($res = mysqli_fetch_assoc($result)) {
            $res['img_num']  = rand(1,10);
            $row[] = $res;
        }
      return $row;
    }

    //新增talk
    public function addTalk($param)
    {
        if(!$_SESSION['user_id']){
            return ['code' => 1, 'msg' => 'please login', 'data' => []];
        }
        $title = $param['title'];
        $content = $param['content'];
        $addtime = date('Y-m-d H:i:s');
        $uid = $_SESSION['user_id'];
        $db = new Db();
        $sql = "INSERT INTO `talk` ( `title`, `content`, `addtime`, `uid`) VALUES ('$title', '$content', '$addtime', '$uid')";
        $result = mysqli_query($db->conn, $sql);
        $id = mysqli_insert_id($db->conn);
        return ['code' => 0, 'msg' => 'success', 'data' => []];
    }






}
