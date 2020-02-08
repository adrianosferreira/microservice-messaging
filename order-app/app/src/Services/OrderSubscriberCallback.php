<?php

namespace App\Services;

class OrderSubscriberCallback
{
    public function handle(\Redis $redis, string $channel, string $message): void
    {
        echo "Payload: $message\n";
        $order = (new OrderMessageConverter())->convert($message);

        if ( !$order ) {
            return;
        }

        (new OrderCreation())->create($order);
    }
}