<?php
/**
 * Project: MessageSender
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace MessageSender\MessageHandler;

use MessageSender\MessageHandler\MessageHandlerInterface;
use EasyWeChat\Foundation\Application;


class EasyWeChatHandler implements MessageHandlerInterface
{
    public $app;
    protected $notice;
    protected $requiredArr = ['app_id', 'secret', 'cache'];
    protected $configArr;
    public function __construct(array $optionArr)
    {
        foreach ($optionArr as $key => $value) {
            if (!in_array($key, $this->requiredArr, true) && empty($value)) {
                throw new Exception("Attribute '$key' can not be empty!");
            }
        }
        $this->app = new Application($optionArr);
        $this->notice = $this->app->notice;

    }

    public function __call($name, $arguments)
    {
        $mapArr = array(
            'to' => 'to',
            'template' => 'template',
        );
        if (isset($mapArr[$name])) {
            $this->configArr[$mapArr[$name]] = array_shift($arguments);
        }
        return $this;
    }

    public function send($message)
    {
        // TODO: Implement send() method.
    }

    public function sendByTemplate($message, $template = null, array $option = array())
    {
        $template = is_null($template) ? $this->configArr['template'] : $template;
        $to = $this->configArr['to'];
        $result = $this->notice->data($message)->templateId($template)->to($to)->send();
        return $result;
    }
}