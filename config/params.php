<?php

return [
    'adminEmail' => 'info@carteraintegral.com.co',
    'senderEmail' => 'info@carteraintegral.com.co',
    'senderName' => 'INFO CARTERA',
    'asuntoAlertasProceso' => 'CILES: alerta de gestion de procesos',
    'alertaPREJuridico_CartaEnviada' => [
        'tipo_alerta_id' => 1,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Enviar carta al cliente',
        'descripcion' => 'Tienes pendiente enviar la(s) carta(s) al cliente.'
    ],
    'alertaPrejuridico_LlamadaRealizada' => [
        'tipo_alerta_id' => 2,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Hacer llamada al cliente',
        'descripcion' => 'Tienes pendiente hacer la(s) llamada(s) al cliente.'
    ],
    'alertaPrejuridico_VisitaDomiciliaria' => [
        'tipo_alerta_id' => 3,
        'activo' => true,
        'diasParaAlerta' => '10', //dias habiles
        'asunto' => 'CILES - Alertas: Hacer visita al cliente',
        'descripcion' => 'Tienes pendiente hacer la(s) visita(s) al cliente.'
    ],
    'alertaPrejuridico_AcuerdosDePago' => [
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
    'alertaJuridico_RecepcionDePoder' => [
        'tipo_alerta_id' => 9,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Recepción de poder.',
        'descripcion' => 'Recibir el poder.'
    ],
    'alertaJuridico_RadicacionDemanda' => [
        'tipo_alerta_id' => 10,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Radicación demanda.',
        'descripcion' => 'Radicación demanda.'
    ],
    'alertaJuridico_InadmisionDemanda' => [
        'tipo_alerta_id' => 11,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Inadmisión Demanda.',
        'descripcion' => 'Inadmisión Demanda.'
    ],
    'alertaJuridico_MandamientoPagoCorregiroReponer' => [
        'tipo_alerta_id' => 12,
        'activo' => true,
        'diasParaAlerta' => '2', //dias habiles
        'asunto' => 'CILES - Alertas: Mandamiento de pago corregir o reponer.',
        'descripcion' => 'Mandamiento de pago corregir o reponer.'
    ],    
    'alertaJuridico_MandamientoPagoAvance60Dias' => [
        'tipo_alerta_id' => 13,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Mandamiento de pago avance 60 días.',
        'descripcion' => 'Mandamiento de pago avance 60 días.'
    ],    
    'alertaJuridico_Notificacion' => [
        'tipo_alerta_id' => 14,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica ejecutiva.',
        'descripcion' => 'Notificación jurídica ejecutiva.'
    ],        
    'alertaJuridico_Excepciones' => [
        'tipo_alerta_id' => 15, 
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: El despacho corre las excepciones.',
        'descripcion' => 'El despacho corre las excepciones.'
    ],        
    'alertaJuridico_AudienciaInicial' => [
        'tipo_alerta_id' => 16, 
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Audiencia Inicial.',
        'descripcion' => 'Audiencia Inicial.'
    ],            
    'alertaJuridico_AudienciaFallo' => [
        'tipo_alerta_id' => 17, 
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Audiencia de Fallo.',
        'descripcion' => 'Audiencia Audiencia de Fallo.'
    ],            
    'alertaJuridico_SentenciaFavorableA' => [
        'tipo_alerta_id' => 18, 
        'activo' => true,
        'diasParaAlerta' => '120', //dias habiles
        'asunto' => 'CILES - Alertas: Sentencia Favorable despues de las excepciones.',
        'descripcion' => 'Sentencia Favorable despues de las excepciones.'
    ],            
    'alertaJuridico_SentenciaFavorableD' => [
        'tipo_alerta_id' => 19, 
        'activo' => true,
        'diasParaAlerta' => '360', //dias habiles
        'asunto' => 'CILES - Alertas: Sentencia Favorable despues del radicado.',
        'descripcion' => 'Sentencia Favorable despues del radicado.'
    ],            
    'alertaJuridico_LiquidacionCredito' => [
        'tipo_alerta_id' => 20, 
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Liquidación Crédito.',
        'descripcion' => 'Liquidación Crédito.'
    ],            
    'alertaVerbal_RecepcionDePoder' => [
        'tipo_alerta_id' => 21, 
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal recepción de poder.',
        'descripcion' => 'Verbal recepción de poder.'
    ],
    'alertaVerbal_RadicacionDemanda' => [
        'tipo_alerta_id' => 22,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Radicación demanda.',
        'descripcion' => 'Verbal Radicación demanda.'
    ],
    'alertaVerbal_InadmisionDemanda' => [
        'tipo_alerta_id' => 23,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Inadmisión Demanda.',
        'descripcion' => 'Verbal Inadmisión Demanda.'
    ],    
    'alertaVerbal_AdmisionDemanda' => [
        'tipo_alerta_id' => 24,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Admisión Demanda.',
        'descripcion' => 'Verbal Admisión Demanda.'
    ],    
    'alertaVerbal_Notificacion' => [
        'tipo_alerta_id' => 25,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica verbal.',
        'descripcion' => 'Notificación jurídica verbal.'
    ],        
    'alertaVerbal_Excepciones' => [
        'tipo_alerta_id' => 26, 
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: El despacho corre las excepciones.',
        'descripcion' => 'El despacho corre las excepciones.'
    ],        
    'alertaVerbal_AudienciaInicial' => [
        'tipo_alerta_id' => 27, 
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Audiencia Inicial.',
        'descripcion' => 'Verbal Audiencia Inicial.'
    ],            
    'alertaVerbal_AudienciaFallo' => [
        'tipo_alerta_id' => 28, 
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Audiencia de Fallo.',
        'descripcion' => 'Verbal Audiencia Audiencia de Fallo.'
    ],            
    'alertaVerbal_SentenciaFavorableA' => [
        'tipo_alerta_id' => 29, 
        'activo' => true,
        'diasParaAlerta' => '120', //dias habiles
        'asunto' => 'CILES - Alertas: Sentencia Favorable despues de las excepciones.',
        'descripcion' => 'Sentencia Favorable despues de las excepciones.'
    ],            
    'alertaVerbal_SentenciaFavorableD' => [
        'tipo_alerta_id' => 30, 
        'activo' => true,
        'diasParaAlerta' => '360', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal - Sentencia Favorable despues del radicado.',
        'descripcion' => 'Verbal - Sentencia Favorable despues del radicado.'
    ],            
    'alertaVerbal_EjecutivoContinuacion' => [
        'tipo_alerta_id' => 31, 
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal - Ejecutivo Continuación.',
        'descripcion' => 'Verbal - Ejecutivo Continuación.'
    ],                 
    'alertaConciliacionExtraJudicial_RecepcionDePoder' => [
        'tipo_alerta_id' => 32, 
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Conciliación ExtraJudicial Recepcion de Poder.',
        'descripcion' => 'Alertas: Conciliación ExtraJudicial Recepcion de Poder.'
    ],                    
    'alertaConciliacionExtraJudicial_RadicacionConciliacion' => [
        'tipo_alerta_id' => 33, 
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Conciliación ExtraJudicial Radicación.',
        'descripcion' => 'Alertas: Conciliación ExtraJudicial Radicación.'
    ],                    
    'alertaConciliacionExtraJudicial_FijacionFechaAudicencia' => [
        'tipo_alerta_id' => 34, 
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Conciliación ExtraJudicial Fijación Fecha Audicencia.',
        'descripcion' => 'Alertas: Conciliación ExtraJudicial Fijación Fecha Audicencia.'
    ],                    
    'alertaConciliacionExtraJudicial_RadicacionDemanda' => [
        'tipo_alerta_id' => 35, 
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Conciliación ExtraJudicial Radicación Demanda.',
        'descripcion' => 'Alertas: Conciliación ExtraJudicial Radicación Demanda.'
    ],            
    'alertaVerbalSumario_RecepcionDePoder' => [
        'tipo_alerta_id' => 36, 
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal sumario recepción de poder.',
        'descripcion' => 'Verbal sumario recepción de poder.'
    ],
    'alertaVerbalSumario_RadicacionDemanda' => [
        'tipo_alerta_id' => 37,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario Radicación demanda.',
        'descripcion' => 'Verbal Sumario Radicación demanda.'
    ],
    'alertaVerbalSumario_InadmisionDemanda' => [
        'tipo_alerta_id' => 38,
        'activo' => true,
        'diasParaAlerta' => '4', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario Inadmisión Demanda.',
        'descripcion' => 'Verbal Sumario Inadmisión Demanda.'
    ],    
    'alertaVerbalSumario_AdmisionDemanda' => [
        'tipo_alerta_id' => 39,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario Admisión Demanda.',
        'descripcion' => 'Verbal sumario Admisión Demanda.'
    ],    
    'alertaVerbalSumario_Notificacion' => [
        'tipo_alerta_id' => 40,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica verbal sumario.',
        'descripcion' => 'Notificación jurídica verbal sumario.'
    ],        
    'alertaVerbalSumario_Excepciones' => [
        'tipo_alerta_id' => 41, 
        'activo' => true,
        'diasParaAlerta' => '2', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario - El despacho corre las excepciones.',
        'descripcion' => 'Verbal Sumario - El despacho corre las excepciones.'
    ],        
    'alertaVerbalSumario_AudienciaUnica' => [
        'tipo_alerta_id' => 42, 
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario Audiencia Unica.',
        'descripcion' => 'Verbal Sumario Audiencia Unica.'
    ],            
    'alertaVerbalSumario_SentenciaFavorableA' => [
        'tipo_alerta_id' => 43, 
        'activo' => true,
        'diasParaAlerta' => '120', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario - Sentencia Favorable despues de las excepciones.',
        'descripcion' => 'Verbal Sumario - Sentencia Favorable despues de las excepciones.'
    ],            
    'alertaVerbalSumario_SentenciaFavorableD' => [
        'tipo_alerta_id' => 44, 
        'activo' => true,
        'diasParaAlerta' => '360', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario - Sentencia Favorable despues del radicado.',
        'descripcion' => 'Verbal Sumario- Sentencia Favorable despues del radicado.'
    ],            
    'alertaVerbalSumario_EjecutivoContinuacion' => [
        'tipo_alerta_id' => 45, 
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal Sumario - Ejecutivo a Continuación.',
        'descripcion' => 'Verbal Sumario - Ejecutivo a Continuación.'
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
        'jur_radicado'=> 'jur_radicado',
        'estrec_probabilidad_recuperacion' => 'estrec_probabilidad_recuperacion',
        'estado_proceso_id' => 'estado_proceso_id',
        'jur_anio_radicado' => 'jur_anio_radicado',
        'jur_consecutivo_proceso' => 'jur_consecutivo_proceso',
        'jur_instancia_radicado' => 'jur_instancia_radicado'
    ]
];
