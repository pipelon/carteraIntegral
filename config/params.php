<?php

return [
    'adminEmail' => 'info@carteraintegral.com.co',
    'senderEmail' => 'info@carteraintegral.com.co',
    'senderName' => 'INFO CARTERA',
    'alertaPREJuridico_Carta' => [
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Enviar carta al cliente',
        'descripcion' => 'Tienes pendiente hacer esta(s) liquidaci&oacute;n(es) y generar la(s) carta(s) correspondiente(s).'
    ],
    'alertaPREJuridico_Llamada' => [
        'activo' => false,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Hacer llamada al cliente',
        'descripcion' => 'Tienes pendiente hacer esta(s) liquidaci&oacute;n(es) y generar la(s) carta(s) correspondiente(s).'
    ]
];
