<?php

namespace App\Service;

use App\Entity\Customer;
use App\Service\Messaging\MessageBrokerInterface;

class CustomerSender
{
    private const CHANNEL = 'customer-creation';

    private $messageBroker;

    public function __construct(MessageBrokerInterface $messageBroker)
    {
        $this->messageBroker = $messageBroker;
    }

    public function send(Customer $customer)
    {
        $this->messageBroker->publish(self::CHANNEL, json_encode([
            'id'      => $customer->getId(),
            'name'    => $customer->getName(),
            'surname' => $customer->getSurname()
        ], JSON_PRETTY_PRINT));
    }
}