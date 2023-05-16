<?php
include("handlerLogic.php");//加载处理类

class SimpleLogic
{
    function handleRequest($method, $param)
    {
        $newClass = new handlerLogic();

        switch ($method) {
            //获取所有
            case "talk_list":
                $res =$newClass->talk_list();
                return ['code' => 0, 'msg' => 'suc', 'data' => $res];
                break;

                //新增话题
            case "addTalk":
                $res =$newClass->addTalk($param);
                return $res;
                break;
                //提交
            case "addTalk":
                $res =$newClass->addTalk2($param);
                return $res;
                break;
            case "login":
                $res =$newClass->login($param);
                return $res;
                break;
            case "register":
                $res =$newClass->register($param);
                return $res;
                break;
                //检查登录
            case "checkLogin":
                $res =$newClass->checkLogin($param);
                return $res;
                break;

                //退出登录
            case "loginOut":
                $res =$newClass->loginOut($param);
                return $res;
                break;
                //删除
            case "del":
                $res =$newClass->del($param);
                return $res;
                break;


            default:
                $res = null;
                break;
        }
        return $res;
    }
}
