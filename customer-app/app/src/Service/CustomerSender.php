<?php

namespace App\Service;

use App\Entity\Customer;
use App\Service\Messaging\MessagePublisherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CustomerSender
{
    private const CHANNEL = 'customer-creation';

    private $publisher;

    public function __construct(MessagePublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public function send(Customer $customer)
    {
        $this->publisher->publish(self::CHANNEL, json_encode([
            'id' => $customer->getId(),
        ], JSON_PRETTY_PRINT));
    }
}