<?php

namespace App\Core\Http\Response;

class ResponseMessage implements \JsonSerializable
{
    protected $statusCode;
    protected $message;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public static function create($statusCode, $message)
    {
        $instance = new self();
        $instance->statusCode = $statusCode;
        $instance->message = $message;

        return $instance;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
