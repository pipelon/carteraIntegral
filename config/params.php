<?php

return [
    'adminEmail' => 'info@carteraintegral.com.co',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'alertaPREJuridico_Carta' => [
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Enviar carta al cliente'
    ],
    'alertaPREJuridico_Llamada' => [
        'activo' => false,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Hacer llamada al cliente'
    ]
];
