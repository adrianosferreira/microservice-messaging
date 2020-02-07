<?php

namespace App\Service;

use App\Entity\Customer;
use App\Service\Messaging\MessagePublisherInterface;
use Symfony\Component\HttpFoundation\Request;

class CustomerSender
{
    private const CHANNEL = 'customer-creation';

    private $publisher;

    public function __construct(MessagePublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public function send(Customer $customer, Request $request): void
    {
        $this->publisher->publish(self::CHANNEL, json_encode([
            'id' => $customer->getId(),
            'request' => $request->request->all()
        ], JSON_PRETTY_PRINT));
    }
}