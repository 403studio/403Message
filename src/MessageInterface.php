<?php
/**
 * Project: 403Message
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace Studio403\Message;


interface MessageInterface
{
    public function init(array $option = array());

    public function send($message);

    public function sendByTemplate($message, $template, array $option = array());

}