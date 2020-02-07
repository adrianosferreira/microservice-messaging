<?php

namespace App\Service;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CustomerCreation
{
    private $manager;
    private $request;
    private $customerSender;

    public function __construct(
        EntityManagerInterface $manager,
        RequestStack $request,
        CustomerSender $customerSender
    ) {
        $this->manager        = $manager;
        $this->request        = $request;
        $this->customerSender = $customerSender;
    }

    public function createFromRequest()
    {
        $request = $this->request->getCurrentRequest();

        if ( ! $request) {
            throw new \BadMethodCallException("Request can't be empty");
        }

        $customer = new Customer();
        $customer->setName($request->get('name'))
            ->setSurname($request->get('surname'));

        $this->manager->persist($customer);
        $this->manager->flush();

        $this->customerSender->send($customer);

        return $customer;
    }
}