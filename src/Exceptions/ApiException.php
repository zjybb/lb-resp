<?php

namespace Zjybb\Response\Exceptions;

use Zjybb\Response\Resp;

class ApiException extends \Exception
{
    protected array $data = [];

    public function __construct($code, $msg = '', $data = [], $previous = null)
    {
        parent::__construct($msg, $code, $previous);
        $this->data = $data;
    }

    public function render()
    {
        return Resp::error($this->getCode(), $this->getMessage(), $this->data);
    }

}
