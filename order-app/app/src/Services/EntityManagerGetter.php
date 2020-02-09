<?php

namespace App\Services;

use App\Kernel;

class EntityManagerGetter
{
    public function get()
    {
        $kernel = new Kernel($_SERVER['APP_ENV'], (bool)$_SERVER['APP_DEBUG']);
        $kernel->boot();

        return $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }
}