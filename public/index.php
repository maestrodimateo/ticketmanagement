<?php

require "../bootstrap.php";

require '../routes/web.php';

$container->call([$router, 'run']);