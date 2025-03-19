<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'cors' => [
        'allowedOrigins' => ['http://test-app.loc:81'],
        'allowedMethods' => ['GET', 'POST', 'PUT', 'OPTIONS'],
        'allowedHeaders' => ['*'],
        'allowedCredentials' => true
    ],
];