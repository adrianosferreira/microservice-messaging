<?php

namespace App\Services;

use App\Entity\CustomerOrder;

class OrderMessageConverter
{
    public function convert($message): ?CustomerOrder
    {
        $decodedMessage = json_decode($message, true);
        $order = new CustomerOrder();
        foreach (['status', 'total'] as $requiredParam) {
            if ( ! isset($decodedMessage['request'][$requiredParam])) {
                echo("The parameter {$requiredParam} is required for this operation. Order could not be processed.\n");
                return null;
            }
        }

        $order->setCustomerId($decodedMessage['id']);
        $order->setStatus($decodedMessage['request']['status']);
        $order->setTotal($decodedMessage['request']['total']);

        return $order;
    }
}