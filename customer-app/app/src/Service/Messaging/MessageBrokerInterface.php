<?php

namespace App\Service\Messaging;

interface MessageBrokerInterface
{

    public function publish($channel, $data);
}