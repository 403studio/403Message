<?php
/**
 * Project: 403Message
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace Message403\MessageHandler;

use Message403\MessageHandler\MessageHandlerInterface;


class WeChatHandler implements MessageHandlerInterface
{
    public function __construct()
    {

    }

    public function send($message)
    {
        // TODO: Implement send() method.
    }

    public function sendByTemplate($message, $template, array $option = array())
    {
        // TODO: Implement sendByTemplate() method.
    }
}