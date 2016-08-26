<?php
/**
 * Project: MessageSender
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace MessageSender\MessageHandler;


interface MessageHandlerInterface
{

    public function send($message);

    public function sendByTemplate($message, $template, array $option = array());

}