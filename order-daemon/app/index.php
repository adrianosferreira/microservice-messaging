<?php
#!/usr/bin/env php

use App\Services\OrderSubscriberCallback;
use App\Services\Messaging\Redis;

ini_set('default_socket_timeout', -1);

require __DIR__.'/vendor/autoload.php';

(new Redis(new OrderSubscriberCallback()))->subscribe();