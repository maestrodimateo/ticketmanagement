<?php

use Http\Request;

use function DI\create;
use Services\MailHandler\Mailer;

return [
    Request::class => Request::createFromGlobals()
];
