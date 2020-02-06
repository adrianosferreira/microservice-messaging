<?php

namespace App\Controller;

use App\Repository\CustomerOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CustomerOrderController extends AbstractController
{
    public function showOrders(CustomerOrderRepository $orders, SerializerInterface $serializer): Response
    {
        return new Response( $serializer->serialize($orders->findAll(), 'json') );
    }
}
