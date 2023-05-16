<?php
include("businesslogic/simpleLogic.php");

$param = "";
$method = "";
//$_REQUEST 他既能接收get请求 也能接收post $_GET $_POST
isset($_REQUEST["method"]) ? $method = $_REQUEST["method"] : false;
isset($_REQUEST["param"]) ? $param = $_REQUEST["param"] : false;

$logic = new SimpleLogic();
$result = $logic->handleRequest($method, $param);
response($result['code'], $result['msg'], $result['data']);

//统一进行返回数据处理
function response($code, $msg, $data)
{
    header('Content-Type: application/json');
    echo(json_encode(['code' => $code, 'msg' => $msg, 'data' => $data]));

}
