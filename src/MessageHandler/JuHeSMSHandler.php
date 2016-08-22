<?php
/**
 * Project: 403Message
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace Studio403\MessageHandler;

use Curl\Curl;
use Studio403\MessageHandler\MessageHandlerInterface;


class JuHeSMSHandler implements MessageHandlerInterface
{
    private $curl;
    protected $configArr = array();

    public function __construct(array $optionArr, $type)
    {
        $this->curl = new Curl();
        $this->configArr = $optionArr;
    }

    public function send($message)
    {

    }

    public function sendByTemplate($message, $template, array $option = array())
    {
        $tpl_value = '';
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $tpl_value .= '#'.$key.'#='.$value.'&';
            }
        }
        $arr = array('tpl_id' => $template, 'tpl_value' => urlencode($tpl_value));
        $arr = array_merge($this->configArr, $arr);
        $request = '';
        foreach ($arr as $key => $value) {
            $request .= $key.'='.$value.'&';
        }
        $this->curl->get($this->configArr['appUrl'], $arr);
        $request = json_decode($this->curl->response);
        var_dump(json_decode($this->curl->response));
    }
}