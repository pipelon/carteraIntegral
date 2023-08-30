<?php

return [
    'adminEmail' => 'info@carteraintegral.com.co',
    'notificacionesJudicialesEmail' => 'notificacionesjudiciales@carteraintegral.com.co',
    'notificacionesJudicialesSender' => 'NOTIFICACIONES JUDICIALES CARTERA INTEGRAL',
    'senderEmail' => 'info@carteraintegral.com.co',
    'senderName' => 'INFO CARTERA INTEGRAL',
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
    'alertaEjecutivo_RecepcionDePoder' => [
        'tipo_alerta_id' => 9,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Recepción de poder.',
        'descripcion' => 'Recibir el poder.'
    ],
    'alertaEjecutivo_RadicacionDemanda' => [
        'tipo_alerta_id' => 10,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Radicación demanda.',
        'descripcion' => 'Radicación demanda.'
    ],
    'alertaEjecutivo_InadmisionDemanda' => [
        'tipo_alerta_id' => 11,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Inadmisión Demanda.',
        'descripcion' => 'Inadmisión Demanda.'
    ],
    'alertaEjecutivo_MandamientoPagoCorregiroReponer' => [
        'tipo_alerta_id' => 12,
        'activo' => true,
        'diasParaAlerta' => '2', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Mandamiento de pago corregir o reponer.',
        'descripcion' => 'Mandamiento de pago corregir o reponer.'
    ],
    'alertaEjecutivo_MandamientoPagoAvance60Dias' => [
        'tipo_alerta_id' => 13,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas:Ejecutivo Mandamiento de pago avance 60 días.',
        'descripcion' => 'Mandamiento de pago avance 60 días.'
    ],
    'alertaEjecutivo_Notificacion' => [
        'tipo_alerta_id' => 14,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Notificación jurídica ejecutiva.',
        'descripcion' => 'Notificación jurídica ejecutiva.'
    ],
    'alertaEjecutivo_Excepciones' => [
        'tipo_alerta_id' => 15,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo El despacho corre las excepciones y/o contestación de demanda.',
        'descripcion' => 'El despacho corre las excepciones y/o contestación de demanda.'
    ],
    'alertaEjecutivo_AudienciaInicial' => [
        'tipo_alerta_id' => 16,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Audiencia Inicial.',
        'descripcion' => 'Audiencia Inicial.'
    ],
    'alertaEjecutivo_AudienciaFallo' => [
        'tipo_alerta_id' => 17,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Audiencia de Fallo.',
        'descripcion' => 'Audiencia Audiencia de Fallo.'
    ],
    'alertaEjecutivo_SentenciaFavorableA' => [
        'tipo_alerta_id' => 18,
        'activo' => true,
        'diasParaAlerta' => '120', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Sentencia Favorable despues de las excepciones.',
        'descripcion' => 'Sentencia Favorable despues de las excepciones.'
    ],
    'alertaEjecutivo_SentenciaFavorableD' => [
        'tipo_alerta_id' => 19,
        'activo' => true,
        'diasParaAlerta' => '360', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Sentencia Favorable despues del radicado.',
        'descripcion' => 'Sentencia Favorable despues del radicado.'
    ],
    'alertaEjecutivo_LiquidacionCredito' => [
        'tipo_alerta_id' => 20,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Ejecutivo Liquidación Crédito.',
        'descripcion' => 'Liquidación Crédito.'
    ],
    'alertaVerbal_RecepcionDePoder' => [
        'tipo_alerta_id' => 21,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Verbal recepción de poder.',
        'descripcion' => 'Verbal recepción de poder.'
    ],
    // 'alertaVerbal_RadicacionDemanda' => [
    //     'tipo_alerta_id' => 22,
    //     'activo' => true,
    //     'diasParaAlerta' => '5', //dias habiles
    //     'asunto' => 'CILES - Alertas: Verbal Radicación demanda.',
    //     'descripcion' => 'Verbal Radicación demanda.'
    // ],
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
        'asunto' => 'CILES - Alertas: El despacho corre las excepciones y/o contestación de la demanda.',
        'descripcion' => 'El despacho corre las excepciones y/o contestación de la demanda.'
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
    // 'alertaVerbalSumario_RadicacionDemanda' => [
    //     'tipo_alerta_id' => 37,
    //     'activo' => true,
    //     'diasParaAlerta' => '5', //dias habiles
    //     'asunto' => 'CILES - Alertas: Verbal Sumario Radicación demanda.',
    //     'descripcion' => 'Verbal Sumario Radicación demanda.'
    // ],
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
        'asunto' => 'CILES - Alertas: Verbal Sumario - El despacho corre las excepciones y/o contestación demanda.',
        'descripcion' => 'Verbal Sumario - El despacho corre las excepciones y/o contestación demanda.'
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
    'alertaOrdinarioLaboral_RecepcionDePoder' => [
        'tipo_alerta_id' => 46,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Ordinario Laboral Recepcion De Poder.',
        'descripcion' => 'Ordinario Laboral Recepcion De Poder..'
    ],
    // 'alertaOrdinarioLaboral_RadicacionDemanda' => [
    //     'tipo_alerta_id' => 47,
    //     'activo' => true,
    //     'diasParaAlerta' => '5', //dias habiles
    //     'asunto' => 'CILES - Alertas: Ordinario Laboral Radicación demanda.',
    //     'descripcion' => 'Ordinario Laboral Radicación demanda.'
    // ], 
    'alertaOrdinarioLaboral_DevolucionDemanda' => [
        'tipo_alerta_id' => 47,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Ordinario Laboral Devolución demanda.',
        'descripcion' => 'Ordinario Laboral Devolución demanda.'
    ],
    'alertaOrdinarioLaboral_AdmisionDemanda' => [
        'tipo_alerta_id' => 48,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Ordinario Laboral Admisión Demanda.',
        'descripcion' => 'Ordinario Laboral Admisión Demanda.'
    ],
    'alertaOrdinarioLaboral_Notificacion' => [
        'tipo_alerta_id' => 49,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica ordinario laboral.',
        'descripcion' => 'Notificación jurídica ordinario laboral.'
    ],
    'alertaOrdinarioLaboral_ReformaDemanda' => [
        'tipo_alerta_id' => 50,
        'activo' => true,
        'diasParaAlerta' => '10', //dias habiles
        'asunto' => 'CILES - Alertas: Reforma demanda jurídica ordinario laboral.',
        'descripcion' => 'Reforma demanda jurídica ordinario laboral.'
    ],
    'alertaOrdinarioLaboral_AudienciaInicial' => [
        'tipo_alerta_id' => 51,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Ordinario Laboral Audiencia Inicial.',
        'descripcion' => 'Ordinario Laboral Audiencia Inicial.'
    ],
    'alertaOrdinarioLaboral_AudienciaTramiteJuzgamiento' => [
        'tipo_alerta_id' => 52,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Ordinario Laboral Audiencia Trámite y Juzgamiento.',
        'descripcion' => 'Ordinario Laboral Audiencia Trámite y Juzgamiento.'
    ],
    'alertaOrdinarioLaboral_SentenciaFavorableD' => [
        'tipo_alerta_id' => 53,
        'activo' => true,
        'diasParaAlerta' => '360', //dias habiles
        'asunto' => 'CILES - Alertas: Ordinario Laboral - Sentencia Favorable despues del radicado.',
        'descripcion' => 'Ordinario Laboral - Sentencia Favorable despues del radicado.'
    ],
    'alertaOrdinarioLaboral_EjecutivoContinuacion' => [
        'tipo_alerta_id' => 54,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Ordinario Laboral - Ejecutivo a Continuación.',
        'descripcion' => 'Ordinario Laboral - Ejecutivo a Continuación.'
    ],
    'alertaNulidad_RecepcionDePoder' => [
        'tipo_alerta_id' => 55,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Recepcion De Poder.',
        'descripcion' => 'Nulidad Recepcion De Poder..'
    ],
    // 'alertaNulidad_RadicacionDemanda' => [
    //     'tipo_alerta_id' => 56,
    //     'activo' => true,
    //     'diasParaAlerta' => '5', //dias habiles
    //     'asunto' => 'CILES - Alertas: Nulidad Radicación demanda.',
    //     'descripcion' => 'Nulidad Radicación demanda.'
    // ],
    'alertaNulidad_InadmisionDemanda' => [
        'tipo_alerta_id' => 57,
        'activo' => true,
        'diasParaAlerta' => '6', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Inadmisión Demanda.',
        'descripcion' => 'Nulidad Inadmisión Demanda.'
    ],
    'alertaNulidad_AdmisionDemanda' => [
        'tipo_alerta_id' => 58,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Admisión Demanda.',
        'descripcion' => 'Nulidad Admisión Demanda.'
    ],
    'alertaNulidad_Notificacion' => [
        'tipo_alerta_id' => 59,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica nulidad.',
        'descripcion' => 'Notificación jurídica nulidad.'
    ],
    'alertaNulidad_Contestacion' => [
        'tipo_alerta_id' => 60,
        'activo' => true,
        'diasParaAlerta' => '2', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad - Contestación demanda.',
        'descripcion' => 'Nulidad - Contestación demanda.'
    ],
    'alertaNulidad_AudienciaInicial' => [
        'tipo_alerta_id' => 61,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Audiencia Inicial.',
        'descripcion' => 'Nulidad Audiencia Inicial.'
    ],
    'alertaNulidad_AudienciaFallo' => [
        'tipo_alerta_id' => 62,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Audiencia de Fallo.',
        'descripcion' => 'Nulidad Audiencia de Fallo.'
    ],
    'alertaNulidad_SentenciaFavorableA' => [
        'tipo_alerta_id' => 63,
        'activo' => true,
        'diasParaAlerta' => '90', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad - Sentencia Favorable despues de las excepciones.',
        'descripcion' => 'Nulidad - Sentencia Favorable despues de las excepciones.'
    ],
    // 'alertaNulidad_EjecutivoContinuacion' => [
    //     'tipo_alerta_id' => 64, 
    //     'activo' => true,
    //     'diasParaAlerta' => '30', //dias habiles
    //     'asunto' => 'CILES - Alertas: Nulidad - Ejecutivo a Continuación.',
    //     'descripcion' => 'Nulidad - Ejecutivo a Continuación.'
    // ],                
    'alertaNulidadRestablecimiento_RecepcionDePoder' => [
        'tipo_alerta_id' => 65,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Recepcion De Poder.',
        'descripcion' => 'Nulidad Restablecimiento de derecho - Recepcion De Poder..'
    ],
    // 'alertaNulidadRestablecimiento_RadicacionDemanda' => [
    //     'tipo_alerta_id' => 66,
    //     'activo' => true,
    //     'diasParaAlerta' => '5', //dias habiles
    //     'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Radicación demanda.',
    //     'descripcion' => 'Nulidad Restablecimiento de derecho - Radicación demanda.'
    // ],
    'alertaNulidadRestablecimiento_InadmisionDemanda' => [
        'tipo_alerta_id' => 67,
        'activo' => true,
        'diasParaAlerta' => '6', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Inadmisión Demanda.',
        'descripcion' => 'Nulidad Restablecimiento de derecho - Inadmisión Demanda.'
    ],
    'alertaNulidadRestablecimiento_AdmisionDemanda' => [
        'tipo_alerta_id' => 68,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho -  Admisión Demanda.',
        'descripcion' => 'Nulidad Restablecimiento de derecho -  Admisión Demanda.'
    ],
    'alertaNulidadRestablecimiento_Notificacion' => [
        'tipo_alerta_id' => 69,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica nulidad Restablecimiento de derecho -  .',
        'descripcion' => 'Notificación jurídica nulidad Restablecimiento de derecho -  .'
    ],
    'alertaNulidadRestablecimiento_Contestacion' => [
        'tipo_alerta_id' => 70,
        'activo' => true,
        'diasParaAlerta' => '2', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Contestación demanda.',
        'descripcion' => 'Nulidad Restablecimiento de derecho - Contestación demanda.'
    ],
    'alertaNulidadRestablecimiento_AudienciaInicial' => [
        'tipo_alerta_id' => 71,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Audiencia Inicial.',
        'descripcion' => 'Nulidad Restablecimiento de derecho - Audiencia Inicial.'
    ],
    'alertaNulidadRestablecimiento_AudienciaFallo' => [
        'tipo_alerta_id' => 72,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Audiencia de Fallo.',
        'descripcion' => 'Nulidad Restablecimiento de derecho - Audiencia de Fallo.'
    ],
    'alertaNulidadRestablecimiento_SentenciaFavorableA' => [
        'tipo_alerta_id' => 73,
        'activo' => true,
        'diasParaAlerta' => '90', //dias habiles
        'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Sentencia Favorable despues de las excepciones.',
        'descripcion' => 'Nulidad Restablecimiento de derecho - Sentencia Favorable despues de las excepciones.'
    ],
    // 'alertaNulidadRestablecimiento_EjecutivoContinuacion' => [
    //     'tipo_alerta_id' => 74, 
    //     'activo' => true,
    //     'diasParaAlerta' => '30', //dias habiles
    //     'asunto' => 'CILES - Alertas: Nulidad Restablecimiento de derecho - Ejecutivo a Continuación.',
    //     'descripcion' => 'Nulidad Restablecimiento de derecho - Ejecutivo a Continuación.'
    // ],                
    'alertaReparacionDirecta_RecepcionDePoder' => [
        'tipo_alerta_id' => 75,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Recepcion De Poder.',
        'descripcion' => 'Reparación Directa - Recepcion De Poder.'
    ],
    'alertaReparacionDirecta_RadicacionDemanda' => [
        'tipo_alerta_id' => 76,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Radicación demanda.',
        'descripcion' => 'Reparación Directa - Radicación demanda.'
    ],
    'alertaReparacionDirecta_InadmisionDemanda' => [
        'tipo_alerta_id' => 77,
        'activo' => true,
        'diasParaAlerta' => '6', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Inadmisión Demanda.',
        'descripcion' => 'Reparación Directa - Inadmisión Demanda.'
    ],
    'alertaReparacionDirecta_AdmisionDemanda' => [
        'tipo_alerta_id' => 78,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa -  Admisión Demanda.',
        'descripcion' => 'Reparación Directa -  Admisión Demanda.'
    ],
    'alertaReparacionDirecta_Notificacion' => [
        'tipo_alerta_id' => 79,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica Reparación Directa.',
        'descripcion' => 'Notificación jurídica jurídica Reparación Directa.'
    ],
    'alertaReparacionDirecta_Contestacion' => [
        'tipo_alerta_id' => 80,
        'activo' => true,
        'diasParaAlerta' => '2', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Contestación demanda.',
        'descripcion' => 'Reparación Directa - Contestación demanda.'
    ],
    'alertaReparacionDirecta_AudienciaInicial' => [
        'tipo_alerta_id' => 81,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Audiencia Inicial.',
        'descripcion' => 'Reparación Directa - Audiencia Inicial.'
    ],
    'alertaReparacionDirecta_AudienciaFallo' => [
        'tipo_alerta_id' => 82,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Audiencia de Fallo.',
        'descripcion' => 'Reparación Directa - Audiencia de Fallo.'
    ],
    'alertaReparacionDirecta_SentenciaFavorableA' => [
        'tipo_alerta_id' => 83,
        'activo' => true,
        'diasParaAlerta' => '90', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Sentencia Favorable después de la contestación.',
        'descripcion' => 'Reparación Directa - Sentencia Favorable después de la contestación.'
    ],
    'alertaReparacionDirecta_EjecutivoContinuacion' => [
        'tipo_alerta_id' => 84,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Reparación Directa - Ejecutivo a Continuación.',
        'descripcion' => 'Reparación Directa - Ejecutivo a Continuación.'
    ],
    'alertaMonitorio_RecepcionDePoder' => [
        'tipo_alerta_id' => 85,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Recepción De Poder.',
        'descripcion' => 'Monitorio - Recepción De Poder.'
    ],
    'alertaMonitorio_RadicacionDemanda' => [
        'tipo_alerta_id' => 86,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Radicación demanda.',
        'descripcion' => 'Monitorio - Radicación demanda.'
    ],
    'alertaMonitorio_InadmisionDemanda' => [
        'tipo_alerta_id' => 87,
        'activo' => true,
        'diasParaAlerta' => '4', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Inadmisión Demanda.',
        'descripcion' => 'Monitorio - Inadmisión Demanda.'
    ],
    'alertaMonitorio_RequerimientoPago' => [
        'tipo_alerta_id' => 88,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Requerimiento de pago.',
        'descripcion' => 'Monitorio - Requerimiento de pago.'
    ],
    'alertaMonitorio_Notificacion' => [
        'tipo_alerta_id' => 89,
        'activo' => true,
        'diasParaAlerta' => '15', //dias habiles
        'asunto' => 'CILES - Alertas: Notificación jurídica Monitorio.',
        'descripcion' => 'Notificación jurídica jurídica Monitorio.'
    ],
    'alertaMonitorio_AudienciaUnica' => [
        'tipo_alerta_id' => 90,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Audiencia única.',
        'descripcion' => 'Monitorio - Audiencia única.'
    ],
    'alertaMonitorio_SentenciaFavorableA' => [
        'tipo_alerta_id' => 91,
        'activo' => true,
        'diasParaAlerta' => '120', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Sentencia Favorable despues de la contestación de la demanda.',
        'descripcion' => 'Verbal Monitorio - Sentencia Favorable despues de la contestación de la demanda.'
    ],
    'alertaMonitorio_SentenciaFavorableD' => [
        'tipo_alerta_id' => 92,
        'activo' => true,
        'diasParaAlerta' => '360', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Sentencia Favorable despues del radicado.',
        'descripcion' => 'Verbal Monitorio - Sentencia Favorable despues del radicado.'
    ],
    'alertaMonitorio_LiquidacionCredito' => [
        'tipo_alerta_id' => 93,
        'activo' => true,
        'diasParaAlerta' => '30', //dias habiles
        'asunto' => 'CILES - Alertas: Monitorio - Liquidación Crédito.',
        'descripcion' => 'Monitorio - Liquidación Crédito.'
    ],
    'alertaTutela_Fallo' => [
        'tipo_alerta_id' => 94,
        'activo' => true,
        'diasParaAlerta' => '9', //dias habiles
        'asunto' => 'CILES - Alertas: Tutela - Fallo.',
        'descripcion' => 'Tutela - Fallo.'
    ],
    'alertaTutela_Impugnacion' => [
        'tipo_alerta_id' => 95,
        'activo' => true,
        'diasParaAlerta' => '1', //dias habiles
        'asunto' => 'CILES - Alertas: Tutela - Impugnación.',
        'descripcion' => 'Tutela - Impugnación.'
    ],
    'alertaInsolvenciaPersonaNatural_AcuerdoPago' => [
        'tipo_alerta_id' => 96,
        'activo' => true,
        'diasParaAlerta' => '60', //dias habiles
        'asunto' => 'CILES - Alertas: Insolvencia Persona Natural - AcuerdoPago.',
        'descripcion' => 'Insolvencia Persona Natural - AcuerdoPago.'
    ],
    'alertaInsolvenciaLey1116_Objeciones' => [
        'tipo_alerta_id' => 97,
        'activo' => true,
        'diasParaAlerta' => '3', //dias habiles
        'asunto' => 'CILES - Alertas: Insolvencia Ley 1116 - Objeciones.',
        'descripcion' => 'Insolvencia Ley 1116 - Objeciones.'
    ],
    'alertaInsolvenciaLey1116_AcuerdoReorganizacion' => [
        'tipo_alerta_id' => 98,
        'activo' => true,
        'diasParaAlerta' => '120', //dias habiles
        'asunto' => 'CILES - Alertas: Insolvencia Ley 1116 - Acuerdo de Reorganización.',
        'descripcion' => 'Insolvencia Ley 1116 - Acuerdo de Reorganización.'
    ],
    'alertaInsolvenciaLey1116_AcuerdoReorganizacionConfirmacion' => [
        'tipo_alerta_id' => 99,
        'activo' => true,
        'diasParaAlerta' => '4', //dias habiles
        'asunto' => 'CILES - Alertas: Insolvencia Ley 1116 - Confirmación del Acuerdo de Reorganización.',
        'descripcion' => 'Insolvencia Ley 1116 - Confirmación del Acuerdo de Reorganización.'
    ],
    'alertaLiquidacionEntidadesSalud_RecursoReposicion' => [
        'tipo_alerta_id' => 100,
        'activo' => true,
        'diasParaAlerta' => '5', //dias habiles
        'asunto' => 'CILES - Alertas: Liquidacion de Entidades de Salud - Recurso Reposicion.',
        'descripcion' => 'Liquidacion de Entidades de Salud - Recurso Reposicion.'
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
        'jur_radicado' => 'jur_radicado',
        'estrec_probabilidad_recuperacion' => 'estrec_probabilidad_recuperacion',
        'estado_proceso_id' => 'estado_proceso_id',
        'jur_anio_radicado' => 'jur_anio_radicado',
        'jur_consecutivo_proceso' => 'jur_consecutivo_proceso',
        'jur_instancia_radicado' => 'jur_instancia_radicado',
        'jur_comentario_radicado_1' => 'jur_comentario_radicado_1',
        'jur_comentario_radicado_2' => 'jur_comentario_radicado_2',
        'jur_comentario_radicado_3' => 'jur_comentario_radicado_3'
    ],
    'cartaLiquidacionDeuda' => [
        "encabezado" => "%s <br /><br /> CIM – 23 - 27 <br /> Medellín, %s de %s de %s"
        . "<br /><br /> Señores <br /> %s <br /> %s <br /> %s <br /> %s"
        . "<br /><br /> Cordial Saludo, <br /><br />",
        "cuerpo" => "Mediante comunicación del (%s de %s de %s), %s., autorizó
                    a CARTERA INTEGRAL S.A.S., para adelantar la gestión y cobro de las facturas que a la
                    fecha adeuda a la mencionada sociedad.
                    <br /><br />
                    Anexamos el estado de cartera con corte al (%s de %s de %s), por valor de
                    (%s); para que sea analizado y se proceda con el pago de las facturas vencidas,
                    se comparen los saldos pendientes y nos informen las observaciones a que de lugar.
                    <br /><br />
                    Si existen facturas canceladas y pendientes de cruzar por %s, le
                    solicitamos enviarnos los soportes con la fecha de pago con el fin de realizar los ajustes
                    necesarios.
                    <br /><br />
                    En caso tal de no haberla pagado en su totalidad, les solicitamos acercarse a la carrera
                    66B N° 32B – 29 de Medellín antes del (<b>%s de %s de %s</b>) para establecer la forma de pago de la acreencia
                    relacionada.
                    <br /><br />
                    La no asistencia a esta convocatoria dentro de la fecha establecida dará lugar al cobro
                    judicial de lo adeudado.
                    <br /><br />
                    Cualquier duda o aclaración, con mucho gusto será atendida.
                    <br /><br />",
        "pie" => "Atentamente,<br /> %s <br />LUIS ELKIN PÉREZ ORTIZ<br />"
        . "Director Operativo<br />eperez@carteraintegral.com.co<br />Tel. 4448131"
    ],
    'cartaDeudaAutorizacion' => [
        "encabezado" => "%s <br /><br />Medellín, %s de %s de %s"
        . "<br /><br /><br /><br /> Señores <br /> JUZGADO: %s <br /> E.S.D <br /> DEMANDANTE: %s <br />" 
        . "DEMANDADO: %s <br /> RADICADO: %s"
        . "<br /><br /><br /><br /> ASUNTO: Autorización <br /><br />",
        "cuerpo" => "JOHN JAIRO OSPINA PENAGOS, mayor y vecino de Itagüí, identificado con 
        cédula de ciudadanía Nro. 98.525.657 de Itagüí -Antioquia y con tarjeta profesional 
        Nro. 133.396 del Consejo Superior de la Judicatura, en calidad de apoderado 
        judicial de la parte demandante en el proceso de la referencia, muy 
        respetuosamente, por medio de la presente me permito autorizar al abogado JAIME 
        ALONSO ACEVEDO,  identificado con Cédula de Ciudadanía Nro. 98.715.628, 
        con tarjeta profesional Nro. 293.183 del Consejo Superior de la Judicatura, para revisar 
        el expediente, solicitar copias, retirar copias, solicitar el desarchivo del proceso, 
        retirar o acceder a los despachos comisorios, oficios, retirar la demanda y 
        desgloses, entre otras consultas o trámites que se requieran.<br /><br /><br /><br /><br /><br />",
        "pie" => "Cordialmente,<br /> %s <br />JOHN JAIRO OSPINA PENAGOS<br />"
        . "Cédula de ciudadanía Nro. 98.525.657 <br />
        Tarjeta profesional Nro. 133.396 del C. S de la Judicatura."
    ],
    'cartaRelacionTitulosJudiciales' => [
        "encabezado" => "%s <br /><br />Medellín, %s de %s de %s"
        . "<br /><br /><br /><br /> Señores <br /> JUZGADO: %s <br /> E.S.D <br /> DEMANDANTE: %s <br />" 
        . "DEMANDADO: %s <br /> RADICADO: %s"
        . "<br /><br /><br /><br /> ASUNTO: SOLICITUD RELACIÓN DE TITULOS JUDICIALES <br /><br />",
        "cuerpo" => "JOHN JAIRO OSPINA PENAGOS, mayor y vecino de Itagüí, identificado con 
        cédula de ciudadanía Nro. 98.525.657 de Itagüí -Antioquia y con 
        tarjeta profesional Nro. 133.396 del Consejo Superior de la Judicatura, en calidad de 
        apoderado judicial de la parte demandante muy respetuosamente, me permito 
        solicitar al despacho relación de títulos judiciales del proceso de la referencia.<br /><br /><br /><br /><br /><br />",
        "pie" => "Cordialmente,<br /> %s <br />JOHN JAIRO OSPINA PENAGOS<br />"
        . "Cédula de ciudadanía Nro. 98.525.657 <br />
        Tarjeta profesional Nro. 133.396 del C. S de la Judicatura."
    ],
    'TiposCartas'=>[
        'Autorizacion' => 'Autorización',
        'RelacionTitulosJudiciales' => 'Relación Títulos Judiciales'
    ]
];
