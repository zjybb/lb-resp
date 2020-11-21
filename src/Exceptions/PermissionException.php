<?php

namespace Zjybb\Response\Exceptions;

use Zjybb\Response\Resp;

class PermissionException extends \Exception
{
    public function render()
    {
        return Resp::noPermission();
    }

}