<?php

namespace Zjybb\Response;

use Illuminate\Support\Facades\Facade;

/**
 * Class Resp
 *
 * @method static responseJson(array $data, $errCode = BaseCode::SUCCESS, $httpCode = BaseCode::HTTP_OK, $msg = '', array $headers = [], $option = 0)
 * @method static msg($msg, $data = [])
 * @method static success(string $msg = '')
 * @method static resource($data)
 * @method static error(int $error, string $msg = '', array $data = [])
 * @method static unauthorized()
 * @method static noPermission()
 */
class Resp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'resp';
    }
}
