<?php

namespace App\Service\Messaging;

class Redis implements MessagePublisherInterface
{
    private $redis;

    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('message-broker', 6379);
    }

    public function publish($channel, $data)
    {
        $this->redis->publish($channel, $data);
    }
}