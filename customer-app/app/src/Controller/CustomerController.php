<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Service\CustomerCreation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CustomerController extends AbstractController
{
    private $serializer;
    private $customerRepository;
    private $customerCreation;

    public function __construct(
        SerializerInterface $serializer,
        CustomerRepository $customerRepository,
        CustomerCreation $customerCreation
    ) {
        $this->serializer         = $serializer;
        $this->customerRepository = $customerRepository;
        $this->customerCreation   = $customerCreation;
    }

    public function showCustomers(): Response
    {
        return new Response($this->serializer->serialize($this->customerRepository->findAll(),
            'json'));
    }

    public function createCustomer(): Response
    {
        $this->customerCreation->createFromRequest();

        return new Response($this->serializer->serialize(['msg' => 'Customer created.'],
            'json'));
    }
}
