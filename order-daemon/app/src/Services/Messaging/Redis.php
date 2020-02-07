<?php

namespace App\Services\Messaging;

use App\Services\OrderSubscriberCallback;

class Redis implements MessageSubscriberInterface
{
    public const PORT = 6379;
    public const HOST = 'message-broker';

    private $redis;
    private $orderSubscriberCallback;

    public function __construct(OrderSubscriberCallback $orderSubscriberCallback)
    {
        $this->redis                   = new \Redis();
        $this->orderSubscriberCallback = $orderSubscriberCallback;
    }

    public function subscribe(): void
    {
        $connected = $this->redis->connect(self::HOST, self::PORT);

        if ($connected) {
            echo 'Connected to '. self::HOST .' on redis: ' . self::PORT . "\n";
            $this->redis->subscribe(['customer-creation'], [$this->orderSubscriberCallback, 'subscribe']);
        } else {
            echo "Could not connect to redis.\n";
        }

    }
}