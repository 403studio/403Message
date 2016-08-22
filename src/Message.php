<?php
/**
 * Project: 403Message
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace Studio403;

use Studio403\MessageHandler\MessageHandlerInterface;


class Message
{
    const SMS = 1;
    const WECHAT = 2;
    const EMAIL = 3;
    const WEBSOCKET = 4;

    protected static $type = array(
        self::SMS => 'SMS',
    );

    protected $handlerArr = array();

    public function __construct()
    {

    }

    public function pushHandler(MessageHandlerInterface $handler)
    {
        array_unshift($this->handlerArr, $handler);
    }

    public function sendByTemplate($message, $template, array $option = array())
    {
        while ($handler = current($this->handlerArr)) {
            $handler->sendByTemplate($message, $template, $option);
            next($this->handlerArr);
        }
    }

    public function send($message)
    {
        while ($handler = current($this->handlerArr)) {
            $handler->send($message);
            next($this->handlerArr);
        }
    }
}