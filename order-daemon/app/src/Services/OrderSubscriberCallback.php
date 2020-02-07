<?php

namespace App\Services;

use App\Entity\CustomerOrder;
use App\Services\Messaging\Redis;

class OrderSubscriberCallback
{
    public function handle(\Redis $redis, string $channel, string $message): void
    {
        $redis->connect(Redis::HOST, Redis::PORT);
        $decodedMessage = json_decode($message, true);

        $order = new CustomerOrder();
        $order->setCustomerId($decodedMessage['id']);
        $order->setStatus(1);
        $order->setTotal(1000);

        (new OrderCreation())->create($order);
    }
}