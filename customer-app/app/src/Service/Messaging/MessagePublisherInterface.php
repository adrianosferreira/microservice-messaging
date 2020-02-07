<?php

namespace App\Service\Messaging;

interface MessagePublisherInterface
{

    public function publish($channel, $data);
}