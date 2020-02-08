<?php

namespace App\Services;

use App\Kernel;
use App\Entity\CustomerOrder;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OrderCreation
{
    public function create(CustomerOrder $order): void
    {
        $kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
        $containerBuilder = $kernel->getContainer();
        $entityManager = $containerBuilder->get('doctrine.orm.entity_manager');
        var_dump($entityManager);
        $entityManager->persist($order);
        $entityManager->flush();
    }
}