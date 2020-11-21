<?php

namespace Zjybb\Response\Exceptions;

use Zjybb\Response\Resp;

class UnauthorizedException extends \Exception
{
    public function render()
    {
        return Resp::unauthorized();
    }
}