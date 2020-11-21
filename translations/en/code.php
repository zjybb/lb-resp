<?php

namespace Zjybb\Response;

return [

    BaseCode::SUCCESS => '',

    BaseCode::UNAUTHORIZED => 'unauthorized.',

    BaseCode::PERMISSION_DENIED => 'permission denied.',

    //不支持的操作
    BaseCode::UNSUPPORTED_ACTION => 'unsupported action.',

    //未知错误
    BaseCode::UNKNOWN => 'unknown error.',

    BaseCode::MSG_ERROR => '',

    // 用户密码错误
    BaseCode::INVALID_USER_OR_PASS => 'Invalid username or password.',

    // 账号已被停用
    BaseCode::DISABLED_ACCOUNT => 'The account has been disabled.',

    //验证错误
    BaseCode::VALIDATION_FAIL => 'The given data was invalid.',

    //提交参数错误
    BaseCode::INVALID_PARAMETER => 'Invalid parameter.',

    //不允许删除
    BaseCode::NOT_ALLOW_DELETE => 'Not allow delete.',

    //不允许更改
    BaseCode::NOT_ALLOW_EDIT => 'Not allow edit.',

    //时间戳失效
    BaseCode::INVALID_TIMESTAMP => 'Invalid timestamp.',

    //验签错误
    BaseCode::INCORRECT_SIGNATURE => 'Incorrect signature.',
];