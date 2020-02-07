<?php

namespace App\Services\Database;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class EntityManagerFactory
{

    public function get() {
        $dbParams = array(
            'host'     => 'order-db:3306',
            'driver'   => 'pdo_mysql',
            'user'     => 'admin',
            'password' => 'admin',
            'dbname'   => 'app',
        );

        $paths = array(__DIR__.'/src/Entity');
        $isDevMode = false;

        try {
            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
            $entityManager = EntityManager::create($dbParams, $config);
        } catch (\RedisException $e) {

        }

        return $entityManager;
    }
}