<?php

return [
    'adminEmail' => 'info@carteraintegral.com.co',
    'senderEmail' => 'info@carteraintegral.com.co',
    'senderName' => 'INFO CARTERA',
    'asuntoAlertasProceso' => 'CILES: alerta de gestion de procesos',
    'alertaPREJuridico_Carta' => [
        'tipo_alerta_id' => 1,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Enviar carta al cliente',
        'descripcion' => 'Tienes pendiente enviar la(s) carta(s) al cliente.'
    ],
    'alertaPREJuridico_Llamada' => [
        'tipo_alerta_id' => 2,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Hacer llamada al cliente',
        'descripcion' => 'Tienes pendiente hacer la(s) llamada(s) al cliente.'
    ],
    'alertaPREJuridico_Visita' => [
        'tipo_alerta_id' => 3,
        'activo' => true,
        'diasParaAlerta' => '10', //dias habiles
        'asunto' => 'CILES - Alertas: Hacer visita al cliente',
        'descripcion' => 'Tienes pendiente hacer la(s) visita(s) al cliente.'
    ],
    'alertaPREJuridico_Pagos' => [
        'tipo_alerta_id' => 4,
        'activo' => true,
        'diasParaAlerta' => '', //dias habiles
        'asunto' => 'CILES - Alertas: El cliente debe hacer un pago hoy',
        'descripcion' => 'Hoy debes registrar un pago del cliente.'
    ],
    'alertaPREJuridico_SinAcuerdoDePago' => [
        'tipo_alerta_id' => 5,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: No hubo acuerdo de pago. Pasar a jurídico',
        'descripcion' => 'No hubo acuerdo de pago. Pasar a jurídico.'
    ],
    'alertaPREJuridico_EstudioBienesPositivo' => [
        'tipo_alerta_id' => 6,
        'activo' => true,
        'diasParaAlerta' => '1', //dias habiles
        'asunto' => 'CILES - Alertas: Estudio de bienes positivo. Pasar a jurídico',
        'descripcion' => 'Estudio de bienes positivo. Pasar a jurídico.'
    ],
    'alertaPREJuridico_EstudioBienesNegativo' => [
        'tipo_alerta_id' => 7,
        'activo' => true,
        'diasParaAlerta' => '1', //dias habiles
        'asunto' => 'CILES - Alertas: Estudio de bienes negativo. Generar informe de inviabilidad o castigo',
        'descripcion' => 'Estudio de bienes negativo. Generar informe de inviabilidad o castigo.'
    ],
    'alertaPREJuridico_CartaDeCastigo' => [
        'tipo_alerta_id' => 8,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Generar carta de castigo, el proceso fue inviable.',
        'descripcion' => 'Generar carta de castigo, el proceso fue inviable.'
    ],
    'alertaJuridico_RecepcionPoder' => [
        'tipo_alerta_id' => 9,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Recepción de poder.',
        'descripcion' => 'Recibir el poder.'
    ],
    'ayudas' => [
        'default' => 'Default',
        'clientes' => 'Clientes',
        'deudores' => 'deudores',
        'plataforma' => 'plataforma',
        'jefe_id' => 'jefe_id',
        'colaboradores' => 'colaboradores',
        'prejur_fecha_recepcion' => 'prejur_fecha_recepcion',
        'prejur_tipo_caso' => 'prejur_tipo_caso',
        'prejur_valor_activacion' => 'prejur_valor_activacion',
        'prejur_saldo_actual' => 'prejur_saldo_actual',
        'prejur_carta_enviada' => 'prejur_carta_enviada',
        'prejur_comentarios_carta' => 'prejur_comentarios_carta',
        'prejur_llamada_realizada' => 'prejur_llamada_realizada',
        'prejur_comentarios_llamada' => 'prejur_comentarios_llamada',
        'prejur_visita_domiciliaria' => 'prejur_visita_domiciliaria',
        'prejur_comentarios_visita' => 'prejur_comentarios_visita',
        'prejur_acuerdo_pago' => 'prejur_acuerdo_pago',
        'prejur_fecha_no_acuerdo_pago' => 'prejur_fecha_no_acuerdo_pago',
        'prejur_consulta_rama_judicial' => 'prejur_consulta_rama_judicial',
        'prejur_consulta_entidad_reguladora' => 'prejur_consulta_entidad_reguladora',
        'prejur_resultado_estudio_bienes' => 'prejur_resultado_estudio_bienes',
        'prejur_estudio_bienes' => 'prejur_estudio_bienes',
        'prejur_informe_castigo_enviado' => 'prejur_informe_castigo_enviado',
        'prejur_carta_castigo_enviada' => 'prejur_carta_castigo_enviada',
        'prejur_concepto_viabilidad' => 'prejur_concepto_viabilidad',
        'prejur_gestion_prejuridica' => 'prejur_gestion_prejuridica',
        'prejur_otros' => 'prejur_otros',
        'jur_documentos_activacion' => 'jur_documentos_activacion',
        'jur_demandados' => 'jur_demandados',
        'jur_gestion_juridica' => 'jur_gestion_juridica',
        'estrec_pretenciones' => 'estrec_pretenciones',
        'estrec_tiempo_recuperacion' => 'estrec_tiempo_recuperacion',
        'estrec_comentarios' => 'estrec_comentarios',
        'carpeta' => 'carpeta',
        'jur_valor_activacion' => 'jur_valor_activacion',
        'jur_saldo_actual' => 'jur_saldo_actual',
        'jur_tipo_proceso_id' => 'jur_tipo_proceso_id',
        'jur_etapas_procesal_id' => 'jur_etapas_procesal_id',
        'jur_departamento_id' => 'jur_departamento_id',
        'jur_ciudad_id' => 'jur_ciudad_id',
        'jur_jurisdiccion_competent_id' => 'jur_jurisdiccion_competent_id',
        'jur_juzgado' => 'jur_juzgado',
        'estrec_probabilidad_recuperacion' => 'estrec_probabilidad_recuperacion',
        'estado_proceso_id' => 'estado_proceso_id'
    ]
];
