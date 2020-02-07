<?php

namespace App\Services\Messaging;

interface MessageSubscriberInterface
{
    public function subscribe();
}