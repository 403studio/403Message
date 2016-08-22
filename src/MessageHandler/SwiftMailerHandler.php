<?php
/**
 * Project: 403Message
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace Message403\MessageHandler;

class SwiftMailerHandler implements MessageHandlerInterface
{
    private $config;
    private $transport;
    private $mailer;

    public function __construct(array $config)
    {
        $this->config = $config;
        switch ($this->config['transport']) {
            case 'smtp':
                $this->transport = \Swift_SmtpTransport::newInstance($this->config['host'], $this->config['port'], $this->config['ssl'])
                    ->setUsername($this->config['username'])
                    ->setPassword($this->config['password']);
                $this->mailer = \Swift_Mailer::newInstance($this->transport);
                break;
            default:
                throw new \Swift_TransportException(
                    'Transport is not supported'
                );
        }
    }

    public function send($message)
    {
        $messageObj = \Swift_Message::newInstance()
            ->setSubject($this->config['subject'])
            ->setFrom($this->config['from'])
            ->setTo($this->config['to'])
            ->setBody($message);
        $result = $this->mailer->send($messageObj);
    }

    public function __call($name, $arguments)
    {
        $mapArr = array(
            'subject' => 'subject',
            'from' => 'from',
            'to' => 'to',
        );
        if (isset($mapArr[$name])) {
            $this->config[$mapArr[$name]] = array_shift($arguments);
        }
        return $this;
    }

    public function sendByTemplate($message, $template, array $option = array())
    {

    }
}