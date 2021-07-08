<?php

namespace Zjybb\Response;

class BaseCode
{
    const SUCCESS = 1;

    //---- HTTP ----

    const HTTP_INTERNAL_SERVER_ERROR = 500;

    const HTTP_PAGE_NOT_FOUND = 404;

    const HTTP_UNAUTHORIZED = 401;

    const HTTP_PERMISSION_DENIED = 403;

    const HTTP_OK = 200;


    //---- 系统操作相关 ----

    const MSG_ERROR = -1;

    const UNKNOWN = -2;

    const UNSUPPORTED_ACTION = -3;

    const UNAUTHORIZED = -4;

    const PERMISSION_DENIED = -5;

    const INVALID_USER_OR_PASS = -6;

    const DISABLED_ACCOUNT = -7;

    const NOT_ACTIVE = -8;


    //---- 后台相关 100 起 ----

    //验证错误
    const VALIDATION_FAIL = -100;

    //不允许删除
    const NOT_ALLOW_DELETE = -101;

    //不允许更改
    const NOT_ALLOW_EDIT = -102;


    //---- 接口相关错误 1000 起 ----

    //提交参数错误
    const INVALID_PARAMETER = -1000;

    //时间戳失效
    const INVALID_TIMESTAMP = -1001;

    //验签错误
    const INCORRECT_SIGNATURE = -1002;

}
