<?php
/**
 * Project: MessageSender
 * Author: hao.huang<hao.huang@aliyun.com>
 * Copyright: 403studio<https://github.com/403studio>
 */

namespace MessageSender\Support;


class Collection implements \ArrayAccess
{
    private $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    public function get($offset)
    {
        return $this->offsetExists($offset) ? $this->item[$offset] : null;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->item);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->item[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    public function __get($offset)
    {
        return $this->offsetExists($offset) ? $this->item[$offset] : null;
    }
}