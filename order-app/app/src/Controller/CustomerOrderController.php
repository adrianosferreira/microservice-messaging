<?php

namespace App\Controller;

use App\Entity\CustomerOrder;
use App\Repository\CustomerOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerOrderController extends AbstractController
{
    public function showOrders(CustomerOrderRepository $orders): JsonResponse
    {
        return new JsonResponse(array_map([$this, 'objToArray'], $orders->findAll()));
    }

    private function objToArray(CustomerOrder $order): array
    {
        return [
            'id'          => $order->getId(),
            'customer_id' => $order->getCustomerId(),
            'status'      => $order->getStatus(),
            'total'       => $order->getTotal(),
        ];
    }
}
