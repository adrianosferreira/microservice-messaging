#!/usr/bin/env php
<?php

use App\Services\OrderSubscriberCallback;
use App\Services\Messaging\Redis;

ini_set('default_socket_timeout', -1);

require dirname(__DIR__).'/config/bootstrap.php';

(new Redis(new OrderSubscriberCallback()))->subscribe();