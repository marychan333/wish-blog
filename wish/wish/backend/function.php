<?php
//返回正确 信息
function success($data = [], $msg = 'suc', $code = 0)
{
    $data = [
        'data' => $data,
        'msg' => $msg,
        'code' => $code
    ];
    return json_encode($data);
}

//返回错误信息
function error($msg = 'error', $code = 1, $data = [])
{
    $data = [
        'data' => $data,
        'msg' => $msg,
        'code' => $code
    ];
    return json_encode($data);
}