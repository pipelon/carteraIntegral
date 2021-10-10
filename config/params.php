<?php

return [
    'adminEmail' => 'info@carteraintegral.com.co',
    'senderEmail' => 'info@carteraintegral.com.co',
    'senderName' => 'INFO CARTERA',
    'asuntoAlertasProceso' => 'CILES: alerta de gestion de procesos',
    'alertaPREJuridico_Carta' => [
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Enviar carta al cliente',
        'descripcion' => 'Tienes pendiente enviar la(s) carta(s) al cliente.'
    ],
    'alertaPREJuridico_Llamada' => [
        'activo' => false,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Hacer llamada al cliente',
        'descripcion' => 'Tienes pendiente hacer la(s) llamada(s) al cliente.'
    ]
];
