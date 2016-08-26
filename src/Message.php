<?php
/**
 * Project: 403Message
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace MessageSender;

use MessageSender\MessageHandler\MessageHandlerInterface;


class Message
{
    const SMS = 1;
    const WECHAT = 2;
    const EMAIL = 3;
    const WEBSOCKET = 4;
    public $resut;

    protected static $messageType = array(
        self::SMS => 'SMS',
        self::WECHAT => 'WECHAT',
        self::EMAIL => 'EMAIL',
    );

    protected $handlerArr = array();

    public function __construct()
    {

    }

    public function pushHandler(MessageHandlerInterface $handler, $type)
    {
        array_unshift($this->handlerArr, array('handler' => $handler, 'type' => $type));
    }

    public function sendByTemplate($message, $template = null, array $option = array())
    {
        while ($handler = current($this->handlerArr)) {
            $type = $handler['type'];
            $result = $handler['handler']->sendByTemplate($message[$type], $template, $option);
            $resultKey = self::$messageType[$type];
            $this->resut[$resultKey] = $result;
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