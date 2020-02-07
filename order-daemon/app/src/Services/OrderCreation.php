<?php

namespace App\Services;

use App\Entity\CustomerOrder;
use App\Services\Database\EntityManagerFactory;

class OrderCreation
{
    public function create(CustomerOrder $order): void
    {
        $entityManager = (new EntityManagerFactory())->get();
        $entityManager->persist($order);
        $entityManager->flush();
    }
}