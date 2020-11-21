<?php

namespace Zjybb\Response;

return [

    BaseCode::SUCCESS => '',

    BaseCode::UNAUTHORIZED => '非法访问',

    BaseCode::PERMISSION_DENIED => '无访问权限',

    BaseCode::UNSUPPORTED_ACTION => '不支持的操作',

    BaseCode::UNKNOWN => '未知错误',

    BaseCode::MSG_ERROR => '',

    BaseCode::INVALID_USER_OR_PASS => '无效用户或密码',

    BaseCode::DISABLED_ACCOUNT => '账号已被停用',

    BaseCode::VALIDATION_FAIL => '输入的数据有误',

    BaseCode::INVALID_PARAMETER => '无效数据',

    BaseCode::NOT_ALLOW_DELETE => '不允许删除',

    BaseCode::NOT_ALLOW_EDIT => '不允许更改',

    BaseCode::INVALID_TIMESTAMP => '非法请求时间',

    BaseCode::INCORRECT_SIGNATURE => '签名错误',
];