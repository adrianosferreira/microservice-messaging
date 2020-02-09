<?php

namespace App\Services;

use App\Entity\CustomerOrder;

class OrderCreation
{
    public function create(CustomerOrder $order): void
    {
        $entityManager = (new EntityManagerGetter())->get();
        $entityManager->persist($order);
        $entityManager->flush();
    }
}