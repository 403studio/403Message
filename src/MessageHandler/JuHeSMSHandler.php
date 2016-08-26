<?php
/**
 * Project: MessageSender
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace MessageSender\MessageHandler;

use Curl\Curl;
use MessageSender\MessageHandler\MessageHandlerInterface;
use MessageSender\Support\Collection;


class JuHeSMSHandler implements MessageHandlerInterface
{
    private $curl;
    protected $requiredArr = ['mobile', 'tpl_id'];
    protected $configArr = array();

    public function __construct(array $optionArr)
    {
        $this->curl = new Curl();
        $this->configArr = $optionArr;
    }

    public function send($message)
    {

    }

    public function __call($name, $arguments)
    {
        $mapArr = array(
            'to' => 'mobile',
            'mobile' => 'mobile',
            'tpl_id' => 'tpl_id',
            'template' => 'tpl_id',
        );
        if (isset($mapArr[$name])) {
            $this->configArr[$mapArr[$name]] = array_shift($arguments);
        }
        return $this;
    }

    public function sendByTemplate($message, $template = null, array $option = array())
    {
        $tpl_value = '';
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $tpl_value .= '#'.$key.'#='.$value.'&';
            }
        }
        $template = is_null($template) ? $this->configArr['tpl_id'] : $template;
        $arr = array('tpl_id' => $template, 'tpl_value' => urlencode($tpl_value));
        $arr = array_merge($this->configArr, $arr);
        $request = '';
        foreach ($arr as $key => $value) {
            $request .= $key.'='.$value.'&';
        }
        $this->curl->get($this->configArr['appUrl'], $arr);
        $result = json_decode($this->curl->response, true);
        return new Collection($result);
    }
}