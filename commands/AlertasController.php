<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Alertas controller
 */
class AlertasController extends Controller
{

    /**
     * Init function: Esta función iniciará el proceso de todas las alertas
     * de cartera integral (Alertas prejuridico, aleras juridico, alertas taras,
     * etc)
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co
     */
    public function actionInitProcesarAlertas()
    {

        // Array con todas las alertas por proceso
        $alertasPorProceso = [];

        // Objetos en estado de gestion
        $procesos = \app\models\Procesos::find()
            //->where(["estado_proceso_id" => 1])
            ->where(array('or', 'estado_proceso_id = 1', 'estado_proceso_id = 5'))
            ->all();

        //Para cada proceso
        foreach ($procesos as $proceso) {
            #=======================================================================
            # ALERTAS PREJURIDICAS
            #=======================================================================
            #
            if ($proceso->estado_proceso_id == 1){
                //Esta alerta validará el envío de la carta al cliente
                $arraydeAlertas = $this->hallarAlertas('alertaPREJuridico_CartaEnviada',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;
                
                //Esta alerta validará la llamada al cliente
                $arraydeAlertas = $this->hallarAlertas('alertaPrejuridico_LlamadaRealizada',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;
                
                //Esta alerta validará la visita al cliente
                $arraydeAlertas = $this->hallarAlertas('alertaPrejuridico_VisitaDomiciliaria',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará los pagos comprometidos del cliente
                $arraydeAlertas = $this->hallarAlertas('alertaPrejuridico_AcuerdosDePago',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si no hubo acuerdo de pago, y entonces debe remitirse a juridico
                $arraydeAlertas = $this->hallarAlertas('alertaPREJuridico_SinAcuerdoDePago',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si el estudio de bienes fue positivo, y entonces debe remitirse a juridico
                $arraydeAlertas = $this->hallarAlertas('alertaPREJuridico_EstudioBienesPositivo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si el estudio de bienes fue negativo, y entonces debe envairse informe de inviabilidad o castigo
                $arraydeAlertas = $this->hallarAlertas('alertaPREJuridico_EstudioBienesNegativo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si el estudio de bienes fue negativo, y entonces debe enviarse carta de inviabilidad o castigo
                $arraydeAlertas = $this->hallarAlertas('alertaPREJuridico_CartaDeCastigo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;
            }
            
            #=======================================================================
            # ALERTAS JURIDICAS
            #=======================================================================
            if ($proceso->estado_proceso_id == 5){
                #=======================================================================
                # ALERTAS EJECUTIVAS
                #=======================================================================
                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_RadicacionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_InadmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se envió mandamiento de pago
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_MandamientoPagoCorregiroReponer',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará el avance de 60 días de mandamiento de pago
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_MandamientoPagoAvance60Dias',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene notificación del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene excepciones del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_Excepciones',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia Inicial del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_AudienciaInicial',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia de Fallo del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_AudienciaFallo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de la primera audiencia
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_SentenciaFavorableA',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de radicada la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_SentenciaFavorableD',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe hacer la liquidacion de credito 15 dias despues de la sentencia
                $arraydeAlertas = $this->hallarAlertas('alertaEjecutivo_LiquidacionCredito',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                #=======================================================================
                # ALERTAS VERBALES
                #=======================================================================

                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                // $arraydeAlertas = $this->hallarAlertas('alertaVerbal_RadicacionDemanda',$proceso);
                // if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_InadmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_AdmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene notificación del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene excepciones del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_Excepciones',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia Inicial del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_AudienciaInicial',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia de fallo del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_AudienciaFallo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de la primera audiencia
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_SentenciaFavorableA',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de radicada la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_SentenciaFavorableD',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe hacer la liquidacion de credito 15 dias despues de la sentencia
                $arraydeAlertas = $this->hallarAlertas('alertaVerbal_EjecutivoContinuacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                #=======================================================================
                # ALERTAS CONCILIACION EXTRAJUDICIAL
                #=======================================================================

                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaConciliacionExtraJudicial_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si debe generarse la radicacion
                $arraydeAlertas = $this->hallarAlertas('alertaConciliacionExtraJudicial_RadicacionConciliacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si debe generarse la fijacion de fecha de audiencia
                $arraydeAlertas = $this->hallarAlertas('alertaConciliacionExtraJudicial_FijacionFechaAudicencia',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si debe generarse la fijacion de fecha de audiencia
                $arraydeAlertas = $this->hallarAlertas('alertaConciliacionExtraJudicial_RadicacionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;
            
                #=======================================================================
                # ALERTAS VERBALES SUMARIO
                #=======================================================================

                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                // $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_RadicacionDemanda',$proceso);
                // if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_InadmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_AdmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene excepciones del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_Excepciones',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia Unica del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_AudienciaUnica',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de las excepciones
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_SentenciaFavorableA',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de radicada la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_SentenciaFavorableD',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe enviar a ejecutivo a continuacion despues de la sentencia
                $arraydeAlertas = $this->hallarAlertas('alertaVerbalSumario_EjecutivoContinuacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                #=======================================================================
                # ALERTAS ORDINARIO LABORAL
                #=======================================================================

                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                // $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_RadicacionDemanda',$proceso);
                // if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_DevolucionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_AdmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas; 
                
                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_ReformaDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia Inicial del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_AudienciaInicial',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia de trámite y juzgamiento del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_AudienciaTramiteJuzgamiento',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de radicada la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_SentenciaFavorableD',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe enviar a ejecutivo a continuacion despues de la sentencia
                $arraydeAlertas = $this->hallarAlertas('alertaOrdinarioLaboral_EjecutivoContinuacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                #=======================================================================
                # ALERTAS NULIDAD
                #=======================================================================

                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                // $arraydeAlertas = $this->hallarAlertas('alertaNulidad_RadicacionDemanda',$proceso);
                // if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_InadmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_AdmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene excepciones / contestación demanda del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_Contestacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia Inicial del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_AudienciaInicial',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia de fallo del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_AudienciaFallo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de las excepciones
                $arraydeAlertas = $this->hallarAlertas('alertaNulidad_SentenciaFavorableA',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe enviar a ejecutivo a continuacion despues de la sentencia
                // $arraydeAlertas = $this->hallarAlertas('alertaNulidad_EjecutivoContinuacion',$proceso);
                // if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;


                #=======================================================================
                # ALERTAS NULIDAD RESTABLECIMIENTO DERECHO
                #=======================================================================

                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                // $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_RadicacionDemanda',$proceso);
                // if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_InadmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_AdmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se notifico la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene excepciones del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_Contestacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia Inicial del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_AudienciaInicial',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia de fallo del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_AudienciaFallo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de las excepciones
                $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_SentenciaFavorableA',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe enviar a ejecutivo a continuacion despues de la sentencia
                // $arraydeAlertas = $this->hallarAlertas('alertaNulidadRestablecimiento_EjecutivoContinuacion',$proceso);
                // if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                #=======================================================================
                # ALERTAS REPARACION DIRECTA
                #=======================================================================

                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;    

                //Esta alerta validará si se radicó la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_RadicacionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;  
                
                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_InadmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;   
                
                //Esta alerta validará si se admitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_AdmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se notifico la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;
                
                //Esta alerta validará si se tiene excepciones del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_Contestacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia Inicial del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_AudienciaInicial',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene Audiencia de fallo del proceso
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_AudienciaFallo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de las excepciones
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_SentenciaFavorableA',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe enviar a ejecutivo a continuacion despues de la sentencia
                $arraydeAlertas = $this->hallarAlertas('alertaReparacionDirecta_EjecutivoContinuacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;
                
                #=======================================================================
                # ALERTAS MONITORIO
                #=======================================================================
                //Esta alerta validará si debe generarse la recepción del poder
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_RecepcionDePoder',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se radicó la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_RadicacionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;  

                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_InadmisionDemanda',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se inadmitió demanda
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_RequerimientoPago',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se notifico la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_Notificacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene audiencia unica
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_AudienciaUnica',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de la contestacion
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_SentenciaFavorableA',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se tiene sentencia favorable despues de radicada la demanda
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_SentenciaFavorableD',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si se debe hacer la liquidacion de credito 15 dias despues de la sentencia
                $arraydeAlertas = $this->hallarAlertas('alertaMonitorio_LiquidacionCredito',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                #=======================================================================
                # ALERTAS TUTELA
                #=======================================================================
                //Esta alerta validará si debe generarse el fallo de la tutela
                $arraydeAlertas = $this->hallarAlertas('alertaTutela_Fallo',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;  

                //Esta alerta validará si debe generarse la impugnacion de la tutela
                $arraydeAlertas = $this->hallarAlertas('alertaTutela_Impugnacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas; 

                #=======================================================================
                # ALERTAS INSOLVENCIA PERSONA NATURAL
                #=======================================================================
                //Esta alerta validará si debe generarse el acuerdo de pago
                $arraydeAlertas = $this->hallarAlertas('alertaInsolvenciaPersonaNatural_AcuerdoPago',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;   
                
                
                #=======================================================================
                # ALERTAS INSOLVENCIA Ley 1116
                #=======================================================================
                //Esta alerta validará si debe generarse la objeción
                $arraydeAlertas = $this->hallarAlertas('alertaInsolvenciaLey1116_Objeciones',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si debe generarse el acuerdo de reorganizacion
                $arraydeAlertas = $this->hallarAlertas('alertaInsolvenciaLey1116_AcuerdoReorganizacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                //Esta alerta validará si debe generarse la confirmacion del acuerdo de reorganizacion
                $arraydeAlertas = $this->hallarAlertas('alertaInsolvenciaLey1116_AcuerdoReorganizacionConfirmacion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;

                #=======================================================================
                # ALERTAS LIQUIDACION ENTIDADES DE SALUD
                #=======================================================================
                //Esta alerta validará si debe generarse el recurso de reposicion
                $arraydeAlertas = $this->hallarAlertas('alertaLiquidacionEntidadesSalud_RecursoReposicion',$proceso);
                if ($arraydeAlertas) $alertasPorProceso[$proceso->id]["alertas"][] = $arraydeAlertas;
                

                

                
                
                


        }

            #=======================================================================
            # VALIDAR QUE HAYA ALERTAS Y ACUMULARLAS PARA DESPUES ENVIARLAS DE A UNA
            #=======================================================================
            /*
             * Si este proceso tiene alertas para enviar obtengo 
             * sus colaboradores y su lider
             */
            if (count($alertasPorProceso) > 0) {
                $ids_procesos = array_keys($alertasPorProceso);
                // Colaboradores del proceso
                $colaboradores = $proceso->procesosXColaboradores;
                if (in_array($proceso->id, $ids_procesos)) {
                    //Lider del proceso
                    $alertasPorProceso[$proceso->id]["destinatarios"][$proceso->jefe_id]["nombre"] = strtolower($proceso->jefe->name);
                    $alertasPorProceso[$proceso->id]["destinatarios"][$proceso->jefe_id]["email"] = strtolower($proceso->jefe->mail);
                    //Para cada colaborador obtengo su email y nombre
                    foreach ($colaboradores as $col) {

                        $id = $col->user->id;
                        $alertasPorProceso[$proceso->id]["destinatarios"][$id]["nombre"] = strtolower($col->user->name);
                        $alertasPorProceso[$proceso->id]["destinatarios"][$id]["email"] = strtolower($col->user->mail);
                    }
                }
            }
        }
        //Si hay alertas luego de terminado todo el proceso las envío todas
        if (count($alertasPorProceso) > 0) {
            //Insertar las alertas en la base de datos
            $this->insertarAlertasColaboradores($alertasPorProceso);
            //Enviar las alertas a cada colabroador
            $this->enviarEmail($alertasPorProceso);
        }
    }
    
    /**
     * ESTA SERIA LA NUEVA FUNCION USANDO LA BASE DE DATOS
     * 
     * Para llamarla coge desde los params de una vez el id de la alerta y eso es lo q envias a la fucion
     * 
     * Ejemplo:
     * 
     * $idAlerta = \Yii::$app->params['alertaPrejuridico_LlamadaRealizada']['tipo_alerta_id']; // Ejemplo 2
     * $proceso = "9";
     * $this->hallarAlertas($idAlerta, $proceso)
     * 
     * @param type $idAlerta
     * @param type $proceso
     * @return boolean
     */
    private function hallarAlertas2($idAlerta, $proceso) {
        $dataAlerta = \app\models\TiposAlertas::findOne($idAlerta); //Aqui tienes toda la info de la alerta        
        if ($dataAlerta->activa) {
            if (self::$tipoAlerta($proceso)) {
                return [
                    "asunto" => $dataAlerta->asunto,
                    "descripcion" => $dataAlerta->descripcion,
                    "tipo_alerta_id" => $dataAlerta->tipo_alerta_id
                ];
            }
        }
        return false;
    }

    /**
     * Esta funcion se encargará de hallar si hay alertas de cierto tipo para el proceso indicado
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver una fecha o un false sino se encuentra el proceso anterior)
     */
    private function hallarAlertas($tipoAlerta,$proceso){
        //Esta funcion es la que evaluar si hay alertas de cierto tipo para el proceso indicado
        if (\Yii::$app->params[$tipoAlerta]['activo']) {
            //saber si hay alerta ejecutando la funciona apropiada segun el parametrto tipoAlerta
            $hayAlerta = self::$tipoAlerta($proceso);
            if ($hayAlerta) {
                // Asunto de la alerta
                $asunto = Yii::$app->params[$tipoAlerta]['asunto'];
                // Descripción de la alerta
                $descripcion = Yii::$app->params[$tipoAlerta]['descripcion'];
                //id de la alerta
                $tipo_alerta_id = Yii::$app->params[$tipoAlerta]['tipo_alerta_id'];

                return [
                         "asunto" => $asunto,
                         "descripcion" => $descripcion,
                         "tipo_alerta_id" => $tipo_alerta_id
                     ];
            }
        }
        return false;
    }

    /**
     * Esta funcion se encargará de hallar las fechas del estado o etapa del proceso el cual se debe tener como referencia
     * para calcular los días de cualquier alerta
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver una fecha o un false sino se encuentra el proceso anterior)
     */
    private function hallarFechaProcesoAnterior($proceso_id, $tipo_proceso_id, $etapa_procesal_id)
    {
        // Historial de estados de los procesos
        $estado_proceso = \app\models\HistorialEstadosXProceso::find()
            ->where(array('and', 'proceso_id=' . $proceso_id, 'etapa_procesal_id=' . $etapa_procesal_id, 'tipo_proceso_id=' . $tipo_proceso_id))
            ->orderBy('created DESC')
            ->limit(1)
            ->all();

        // sino hay registros se retorna false
        if (!$estado_proceso) {
            return false;
        }
        $estado_proceso = $estado_proceso[0];

        //si se encuentra el registro o registros se retorna el primero        
        return $estado_proceso->created;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaEjecutivo_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 53 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha del mandamiento de pago para poder calcular los días para enviar esta alerta.
        $fechaMandamiento = $this->hallarFechaProcesoAnterior($proceso->id, 6, 52);

        if (!$fechaMandamiento) return false; // no se tiene mandamiento

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaMandamiento, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaVerbal_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 12 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaAdmisionDemanda = $this->hallarFechaProcesoAnterior($proceso->id, 3, 11);

        if (!$fechaAdmisionDemanda) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaAdmisionDemanda, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaVerbalSumario_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 28 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaAdmisionDemanda = $this->hallarFechaProcesoAnterior($proceso->id, 4, 27);

        if (!$fechaAdmisionDemanda) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaAdmisionDemanda, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }

    
    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * Acuerdo Reorganizacion, en los procesos jurídicos de tipo Insolvencia Ley 1116.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaInsolvenciaLey1116_AcuerdoReorganizacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAcuerdoReorganizacion = \Yii::$app->params['alertaInsolvenciaLey1116_Objeciones']['diasParaAlerta'];

        //Si el acuerdo ya fue generado, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 18 && $proceso->jur_etapas_procesal_id == 214 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia negociacion de deudas para poder calcular los 15 días para enviar esta alerta.
        $fechaCalificacionCreditos = $this->hallarFechaProcesoAnterior($proceso->id, 18, 211);

        if (!$fechaCalificacionCreditos) return false; // no se tiene Audiencia Negociacion Deudas

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAcuerdoReorganizacion = $this->hallarFechaAlerta($fechaCalificacionCreditos, $diasHabilesAcuerdoReorganizacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAcuerdoReorganizacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     *recurso de reposicion, en los procesos jurídicos de tipo liquidacion entidad estatal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaLiquidacionEntidadesSalud_RecursoReposicion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecursoReposicion = \Yii::$app->params['alertaLiquidacionEntidadesSalud_RecursoReposicion']['diasParaAlerta'];

        //Si el acuerdo ya fue generado, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 19 && $proceso->jur_etapas_procesal_id == 218 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia negociacion de deudas para poder calcular los 15 días para enviar esta alerta.
        $fechaAcuerdoReorganizacion = $this->hallarFechaProcesoAnterior($proceso->id, 19, 217);

        if (!$fechaAcuerdoReorganizacion) return false; // no se tiene Audiencia Negociacion Deudas

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAcuerdoReorganizacionConfirmacion = $this->hallarFechaAlerta($fechaAcuerdoReorganizacion, $diasHabilesRecursoReposicion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAcuerdoReorganizacionConfirmacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * Acuerdo Reorganizacion, en los procesos jurídicos de tipo Insolvencia Ley 1116.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaInsolvenciaLey1116_AcuerdoReorganizacionConfirmacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAcuerdoReorganizacionConfirmacion = \Yii::$app->params['alertaInsolvenciaLey1116_AcuerdoReorganizacionConfirmacion']['diasParaAlerta'];

        //Si el acuerdo ya fue generado, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 18 && $proceso->jur_etapas_procesal_id == 215 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia negociacion de deudas para poder calcular los 15 días para enviar esta alerta.
        $fechaAcuerdoReorganizacion = $this->hallarFechaProcesoAnterior($proceso->id, 18, 214);

        if (!$fechaAcuerdoReorganizacion) return false; // no se tiene Audiencia Negociacion Deudas

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAcuerdoReorganizacionConfirmacion = $this->hallarFechaAlerta($fechaAcuerdoReorganizacion, $diasHabilesAcuerdoReorganizacionConfirmacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAcuerdoReorganizacionConfirmacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * objeciones, en los procesos jurídicos de tipo Insolvencia Ley 1116.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaInsolvenciaLey1116_Objeciones($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesObjeciones = \Yii::$app->params['alertaInsolvenciaLey1116_Objeciones']['diasParaAlerta'];

        //Si el acuerdo ya fue generado, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 18 && $proceso->jur_etapas_procesal_id == 212 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia negociacion de deudas para poder calcular los 15 días para enviar esta alerta.
        $fechaCalificacionCreditos = $this->hallarFechaProcesoAnterior($proceso->id, 18, 211);

        if (!$fechaCalificacionCreditos) return false; // no se tiene Audiencia Negociacion Deudas

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaObjeciones = $this->hallarFechaAlerta($fechaCalificacionCreditos, $diasHabilesObjeciones);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaObjeciones > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * acuerdo de pago, en los procesos jurídicos de tipo insolvencia persona natural.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaInsolvenciaPersonaNatural_AcuerdoPago($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAcuerdoPago = \Yii::$app->params['alertaInsolvenciaPersonaNatural_AcuerdoPago']['diasParaAlerta'];

        //Si el acuerdo ya fue generado, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 13 && $proceso->jur_etapas_procesal_id == 207 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia negociacion de deudas para poder calcular los 15 días para enviar esta alerta.
        $fechaAudienciaNegociacionDeudas = $this->hallarFechaProcesoAnterior($proceso->id, 13, 206);

        if (!$fechaAudienciaNegociacionDeudas) return false; // no se tiene Audiencia Negociacion Deudas

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAcuerdoPago = $this->hallarFechaAlerta($fechaAudienciaNegociacionDeudas, $diasHabilesAcuerdoPago);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAcuerdoPago > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaNulidad_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 93 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaAdmisionDemanda = $this->hallarFechaProcesoAnterior($proceso->id, 9, 92);

        if (!$fechaAdmisionDemanda) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaAdmisionDemanda, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo nulidad restablecimiento.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaNulidadRestablecimiento_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 106 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaAdmisionDemanda = $this->hallarFechaProcesoAnterior($proceso->id, 10, 105);

        if (!$fechaAdmisionDemanda) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaAdmisionDemanda, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo reparacion directa.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaReparacionDirecta_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 119 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaAdmisionDemanda = $this->hallarFechaProcesoAnterior($proceso->id, 11, 118);

        if (!$fechaAdmisionDemanda) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaAdmisionDemanda, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo monitorio.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaMonitorio_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 40 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaAdmisionDemanda = $this->hallarFechaProcesoAnterior($proceso->id, 5, 39);

        if (!$fechaAdmisionDemanda) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaAdmisionDemanda, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }


    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la reforma de la demanda, en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_ReformaDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesReforma = \Yii::$app->params['alertaOrdinarioLaboral_ReformaDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 181 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaNotificacion = $this->hallarFechaProcesoAnterior($proceso->id, 8, 80);

        if (!$fechaNotificacion) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaReforma = $this->hallarFechaAlerta($fechaNotificacion, $diasHabilesReforma);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaReforma > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la notificación, en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_Notificacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesNotificacion = \Yii::$app->params['alertaOrdinarioLaboral_Notificacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 80 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 15 días para enviar esta alerta.
        $fechaAdmisionDemanda = $this->hallarFechaProcesoAnterior($proceso->id, 8, 79);

        if (!$fechaAdmisionDemanda) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaNotificacion = $this->hallarFechaAlerta($fechaAdmisionDemanda, $diasHabilesNotificacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaNotificacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * verbal ejecutivo a continuacion, en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_EjecutivoContinuacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesEjecutivo = \Yii::$app->params['alertaVerbal_EjecutivoContinuacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 171 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la sentencia para poder calcular los 30 días para enviar esta alerta.
        $fechaSentencia = $this->hallarFechaProcesoAnterior($proceso->id, 3, 17);

        if (!$fechaSentencia) return false; // no se tiene sentencia, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaEjecutivo = $this->hallarFechaAlerta($fechaSentencia, $diasHabilesEjecutivo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaEjecutivo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * verbal sumario ejecutivo a continuacion, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_EjecutivoContinuacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesEjecutivo = \Yii::$app->params['alertaVerbalSumario_EjecutivoContinuacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 178 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la sentencia para poder calcular los 30 días para enviar esta alerta.
        $fechaSentencia = $this->hallarFechaProcesoAnterior($proceso->id, 4, 32);

        if (!$fechaSentencia) return false; // no se tiene sentencia, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaEjecutivo = $this->hallarFechaAlerta($fechaSentencia, $diasHabilesEjecutivo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaEjecutivo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * ejecutivo a continuacion, en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_EjecutivoContinuacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesEjecutivo = \Yii::$app->params['alertaOrdinarioLaboral_EjecutivoContinuacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 183 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la sentencia para poder calcular los 30 días para enviar esta alerta.
        $fechaSentencia = $this->hallarFechaProcesoAnterior($proceso->id, 8, 84);

        if (!$fechaSentencia) return false; // no se tiene sentencia, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaEjecutivo = $this->hallarFechaAlerta($fechaSentencia, $diasHabilesEjecutivo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaEjecutivo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * ejecutivo a continuacion, en los procesos jurídicos de tipo nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_EjecutivoContinuacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesEjecutivo = \Yii::$app->params['alertaNulidad_EjecutivoContinuacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 187 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la sentencia para poder calcular los 30 días para enviar esta alerta.
        $fechaSentencia = $this->hallarFechaProcesoAnterior($proceso->id, 9, 97);

        if (!$fechaSentencia) return false; // no se tiene sentencia, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaEjecutivo = $this->hallarFechaAlerta($fechaSentencia, $diasHabilesEjecutivo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaEjecutivo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * ejecutivo a continuacion, en los procesos jurídicos de tipo nulidad restablecimiento de derecho.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_EjecutivoContinuacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesEjecutivo = \Yii::$app->params['alertaNulidadRestablecimiento_EjecutivoContinuacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 191 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la sentencia para poder calcular los 30 días para enviar esta alerta.
        $fechaSentencia = $this->hallarFechaProcesoAnterior($proceso->id, 10, 110);

        if (!$fechaSentencia) return false; // no se tiene sentencia, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaEjecutivo = $this->hallarFechaAlerta($fechaSentencia, $diasHabilesEjecutivo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaEjecutivo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * ejecutivo a continuacion, en los procesos jurídicos de tipo nulidad restablecimiento de derecho.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_EjecutivoContinuacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesEjecutivo = \Yii::$app->params['alertaReparacionDirecta_EjecutivoContinuacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 195 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la sentencia para poder calcular los 30 días para enviar esta alerta.
        $fechaSentencia = $this->hallarFechaProcesoAnterior($proceso->id, 11, 123);

        if (!$fechaSentencia) return false; // no se tiene sentencia, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaEjecutivo = $this->hallarFechaAlerta($fechaSentencia, $diasHabilesEjecutivo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaEjecutivo > $hoy) {
            return false;
        }

        return true;
    }


    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia de Fallo, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_AudienciaFallo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaFallo = \Yii::$app->params['alertaEjecutivo_AudienciaFallo']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 56 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 60 días para enviar esta alerta.
        $fechaAudienciaInicial = $this->hallarFechaProcesoAnterior($proceso->id, 6, 55);

        if (!$fechaAudienciaInicial) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaFallo = $this->hallarFechaAlerta($fechaAudienciaInicial, $diasAudienciaFallo);
        //$fechaAudienciaFallo = $this->hallarFechaAlerta($proceso->jur_fecha_etapa_procesal, $diasAudienciaFallo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaFallo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia de Fallo, en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_AudienciaFallo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaFallo = \Yii::$app->params['alertaVerbal_AudienciaFallo']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 15 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 60 días para enviar esta alerta.
        $fechaAudienciaInicial = $this->hallarFechaProcesoAnterior($proceso->id, 3, 14);

        if (!$fechaAudienciaInicial) return false; // no se tiene audiencia inicial, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaFallo = $this->hallarFechaAlerta($fechaAudienciaInicial, $diasAudienciaFallo);
        //$fechaAudienciaFallo = $this->hallarFechaAlerta($proceso->jur_fecha_etapa_procesal, $diasAudienciaFallo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaFallo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia de Fallo, en los procesos jurídicos de tipo nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_AudienciaFallo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaFallo = \Yii::$app->params['alertaNulidad_AudienciaFallo']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 96 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 60 días para enviar esta alerta.
        $fechaAudienciaInicial = $this->hallarFechaProcesoAnterior($proceso->id, 9, 95);

        if (!$fechaAudienciaInicial) return false; // no se tiene audiencia inicial, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaFallo = $this->hallarFechaAlerta($fechaAudienciaInicial, $diasAudienciaFallo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaFallo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia de Fallo, en los procesos jurídicos de tipo nulidad restablecimiento de derecho.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_AudienciaFallo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaFallo = \Yii::$app->params['alertaNulidadRestablecimiento_AudienciaFallo']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 109 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 60 días para enviar esta alerta.
        $fechaAudienciaInicial = $this->hallarFechaProcesoAnterior($proceso->id, 10, 108);

        if (!$fechaAudienciaInicial) return false; // no se tiene audiencia inicial, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaFallo = $this->hallarFechaAlerta($fechaAudienciaInicial, $diasAudienciaFallo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaFallo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia de Fallo, en los procesos jurídicos de tipo nulidad restablecimiento de derecho.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_AudienciaFallo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaFallo = \Yii::$app->params['alertaReparacionDirecta_AudienciaFallo']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 122 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 60 días para enviar esta alerta.
        $fechaAudienciaInicial = $this->hallarFechaProcesoAnterior($proceso->id, 11, 121);

        if (!$fechaAudienciaInicial) return false; // no se tiene audiencia inicial, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaFallo = $this->hallarFechaAlerta($fechaAudienciaInicial, $diasAudienciaFallo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaFallo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia de Trámite y Juzgamiento, en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_AudienciaTramiteJuzgamiento($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaTramite = \Yii::$app->params['alertaOrdinarioLaboral_AudienciaTramiteJuzgamiento']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 182 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 60 días para enviar esta alerta.
        $fechaAudienciaInicial = $this->hallarFechaProcesoAnterior($proceso->id, 8, 82);

        if (!$fechaAudienciaInicial) return false; // no se tiene audiencia inicial, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaTramite = $this->hallarFechaAlerta($fechaAudienciaInicial, $diasAudienciaTramite);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaTramite > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia Unica, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_AudienciaUnica($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaUnica = \Yii::$app->params['alertaVerbalSumario_AudienciaUnica']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 30 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepciones para poder calcular los 60 días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 4, 177);

        if (!$fechaExcepciones) return false; // no se tiene audiencia inicial, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaFallo = $this->hallarFechaAlerta($fechaExcepciones, $diasAudienciaUnica);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaFallo > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la Audiencia Unica, en los procesos jurídicos de tipo monitorio.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_AudienciaUnica($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaUnica = \Yii::$app->params['alertaMonitorio_AudienciaUnica']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 42 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las contestacion para poder calcular los 60 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 5, 41);

        if (!$fechaContestacion) return false; // no se tiene contestacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaUnica = $this->hallarFechaAlerta($fechaContestacion, $diasAudienciaUnica);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaUnica > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaEjecutivo_SentenciaFavorable despues de la primera audiencia, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_SentenciaFavorableA($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableA = \Yii::$app->params['alertaEjecutivo_SentenciaFavorableA']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 58 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 120 días para enviar esta alerta.
        $fechaAudienciaInicial = $this->hallarFechaProcesoAnterior($proceso->id, 6, 55);

        if (!$fechaAudienciaInicial) return false; // no se tiene audiencia inicial no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableA = $this->hallarFechaAlerta($fechaAudienciaInicial, $diasSentenciaFavorableA);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableA > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaEjecutivo_SentenciaFavorable despues de radicarse la demanda, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_SentenciaFavorableD($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableD = \Yii::$app->params['alertaEjecutivo_SentenciaFavorableD']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 58 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha del radicado para poder calcular los 360 días para enviar esta alerta.
        $fechaRadicado = $this->hallarFechaProcesoAnterior($proceso->id, 6, 51);

        if (!$fechaRadicado) return false; // no se tiene radicado, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableD = $this->hallarFechaAlerta($fechaRadicado, $diasSentenciaFavorableD);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableD > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaEjecutivo_SentenciaFavorable despues de las excepciones, en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_SentenciaFavorableA($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableA = \Yii::$app->params['alertaVerbal_SentenciaFavorableA']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 17 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepciones para poder calcular los 120 días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 3, 170);

        if (!$fechaExcepciones) return false; // no se tiene excepciones

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableA = $this->hallarFechaAlerta($fechaExcepciones, $diasSentenciaFavorableA);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableA > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaVerbalSumario_SentenciaFavorable despues de las excepciones, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_SentenciaFavorableA($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableA = \Yii::$app->params['alertaVerbalSumario_SentenciaFavorableA']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 32 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepciones para poder calcular los 120 días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 4, 177);

        if (!$fechaExcepciones) return false; // no se tiene excepciones

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableA = $this->hallarFechaAlerta($fechaExcepciones, $diasSentenciaFavorableA);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableA > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta SentenciaFavorable despues de la contestacion, en los procesos jurídicos de tipo monitorio.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_SentenciaFavorableA($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableA = \Yii::$app->params['alertaMonitorio_SentenciaFavorableA']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 45 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las Contestacion para poder calcular los 120 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 5, 41);

        if (!$fechaContestacion) return false; // no se tiene Contestacion

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableA = $this->hallarFechaAlerta($fechaContestacion, $diasSentenciaFavorableA);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableA > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta Nulidad Sentencia Favorable despues de las excepciones, en los procesos jurídicos de tipo nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_SentenciaFavorableA($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableA = \Yii::$app->params['alertaNulidad_SentenciaFavorableA']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 97 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las contestación para poder calcular los 90 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 9, 186);

        if (!$fechaContestacion) return false; // no se tiene contestación

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableA = $this->hallarFechaAlerta($fechaContestacion, $diasSentenciaFavorableA);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableA > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta Nulidad Sentencia Favorable despues de las excepciones, en los procesos jurídicos de tipo nulidad restablecimiento de derecho.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_SentenciaFavorableA($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableA = \Yii::$app->params['alertaNulidadRestablecimiento_SentenciaFavorableA']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 110 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las Contestacion para poder calcular los 120 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 10, 190);

        if (!$fechaContestacion) return false; // no se tiene Contestacion

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableA = $this->hallarFechaAlerta($fechaContestacion, $diasSentenciaFavorableA);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableA > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta Nulidad Sentencia Favorable despues de las excepciones, en los procesos jurídicos de tipo nulidad restablecimiento de derecho.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_SentenciaFavorableA($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableA = \Yii::$app->params['alertaReparacionDirecta_SentenciaFavorableA']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 123 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las contestacion para poder calcular los 120 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 11, 194);

        if (!$fechaContestacion) return false; // no se tiene Contestacion

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableA = $this->hallarFechaAlerta($fechaContestacion, $diasSentenciaFavorableA);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableA > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaVerbalSumario_SentenciaFavorable despues de radicarse la demanda, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_SentenciaFavorableD($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableD = \Yii::$app->params['alertaVerbalSumario_SentenciaFavorableD']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 32 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha del radicado para poder calcular los 360 días para enviar esta alerta.
        $fechaRadicado = $this->hallarFechaProcesoAnterior($proceso->id, 4, 26);

        if (!$fechaRadicado) return false; // no se tiene radicado, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableD = $this->hallarFechaAlerta($fechaRadicado, $diasSentenciaFavorableD);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableD > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta Sentencia Favorable despues de radicarse la demanda, en los procesos jurídicos de tipo monitorio.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_SentenciaFavorableD($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableD = \Yii::$app->params['alertaMonitorio_SentenciaFavorableD']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 45 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha del radicado para poder calcular los 360 días para enviar esta alerta.
        $fechaRadicado = $this->hallarFechaProcesoAnterior($proceso->id, 5, 38);

        if (!$fechaRadicado) return false; // no se tiene radicado, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableD = $this->hallarFechaAlerta($fechaRadicado, $diasSentenciaFavorableD);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableD > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta sentencia favorable despues de radicarse la demanda, en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_SentenciaFavorableD($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableD = \Yii::$app->params['alertaOrdinarioLaboral_SentenciaFavorableD']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 84 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha del radicado para poder calcular los 360 días para enviar esta alerta.
        $fechaRadicado = $this->hallarFechaProcesoAnterior($proceso->id, 8, 78);

        if (!$fechaRadicado) return false; // no se tiene radicado, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableD = $this->hallarFechaAlerta($fechaRadicado, $diasSentenciaFavorableD);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableD > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaEjecutivo_SentenciaFavorable despues de radicarse la demanda, en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_SentenciaFavorableD($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasSentenciaFavorableD = \Yii::$app->params['alertaVerbal_SentenciaFavorableD']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 17 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha del radicado para poder calcular los 360 días para enviar esta alerta.
        $fechaRadicado = $this->hallarFechaProcesoAnterior($proceso->id, 3, 10);

        if (!$fechaRadicado) return false; // no se tiene radicado, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaSentenciaFavorableD = $this->hallarFechaAlerta($fechaRadicado, $diasSentenciaFavorableD);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaSentenciaFavorableD > $hoy) {
            return false;
        }

        return true;
    }

    
    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaJuridico de Liquidación de Crédito 15 días despues de la sentencia, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_LiquidacionCredito($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasLiquidacionCredito = \Yii::$app->params['alertaEjecutivo_LiquidacionCredito']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 62 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 120 días para enviar esta alerta.
        $fechaSentenciaFavorable = $this->hallarFechaProcesoAnterior($proceso->id, 6, 58);

        if (!$fechaSentenciaFavorable) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechadiasLiquidacionCredito = $this->hallarFechaAlerta($fechaSentenciaFavorable, $diasLiquidacionCredito);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechadiasLiquidacionCredito > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta fallo de tutela, en los procesos jurídicos de tipo tutela.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaTutela_Fallo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAlertaFallo = \Yii::$app->params['alertaTutela_Fallo']['diasParaAlerta'];

        //Si el fallo ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 17 && $proceso->jur_etapas_procesal_id == 204 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de radicacion para poder calcular los días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 17, 201);

        if (!$fechaRadicacion) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaFalloTutela = $this->hallarFechaAlerta($fechaRadicacion, $diasAlertaFallo);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaFalloTutela > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alerta impugnación de tutela, en los procesos jurídicos de tipo tutela.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaTutela_Impugnacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAlertaImpugnacion = \Yii::$app->params['alertaTutela_Impugnacion']['diasParaAlerta'];

        //Si la impugnacion ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 17 && $proceso->jur_etapas_procesal_id == 205 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de fallo para poder calcular los días para enviar esta alerta.
        $fechaFallo = $this->hallarFechaProcesoAnterior($proceso->id, 17, 204);

        if (!$fechaFallo) return false; // no se tiene fallo

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaImpugnacionTutela = $this->hallarFechaAlerta($fechaFallo, $diasAlertaImpugnacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaImpugnacionTutela > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la alertaJuridico de Liquidación de Crédito 15 días despues de la sentencia, en los procesos jurídicos de tipo monitorio.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_LiquidacionCredito($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasLiquidacionCredito = \Yii::$app->params['alertaMonitorio_LiquidacionCredito']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 200 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la la audiencia inicial para poder calcular los 120 días para enviar esta alerta.
        $fechaSentenciaFavorable = $this->hallarFechaProcesoAnterior($proceso->id, 5, 45);

        if (!$fechaSentenciaFavorable) return false; // no se tiene audiencia inicial

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechadiasLiquidacionCredito = $this->hallarFechaAlerta($fechaSentenciaFavorable, $diasLiquidacionCredito);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechadiasLiquidacionCredito > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las audiencias iniciales, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_AudienciaInicial($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaInicial = \Yii::$app->params['alertaEjecutivo_AudienciaInicial']['diasParaAlerta'];

        //Si la audiencia inicial ya se hizo, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 55 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los 30 días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 6, 167);
        if (!$fechaExcepciones) { // no se tiene excepciones , preguntar por la fecha de inadmision de la demanda
            //Obtener la fecha de la inadmision de la demanda para poder calcular los 30 días para enviar esta alerta.
            $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 6, 166);
            if (!$fechaExcepciones) return false; // no se tiene tampoco fecha de inadmision , no se alerta
        }

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaInicial = $this->hallarFechaAlerta($fechaExcepciones, $diasAudienciaInicial);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaInicial > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las audiencias iniciales, en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_AudienciaInicial($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaInicial = \Yii::$app->params['alertaOrdinarioLaboral_AudienciaInicial']['diasParaAlerta'];

        //Si la audiencia inicial ya se hizo, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 82 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los 30 días para enviar esta alerta.
        $fechaNotificacion = $this->hallarFechaProcesoAnterior($proceso->id, 8, 80);

        if (!$fechaNotificacion) return false; // no se tiene tampoco fecha de notificacion , no se alerta


        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaInicial = $this->hallarFechaAlerta($fechaNotificacion, $diasAudienciaInicial);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaInicial > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las audiencias iniciales, en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_AudienciaInicial($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaInicial = \Yii::$app->params['alertaVerbal_AudienciaInicial']['diasParaAlerta'];

        //Si la audiencia inicial ya se hizo, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 14 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los 30 días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 3, 170);

        if (!$fechaExcepciones) return false; // no se tiene excepciones

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaInicial = $this->hallarFechaAlerta($fechaExcepciones, $diasAudienciaInicial);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaInicial > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las audiencias iniciales, en los procesos jurídicos de nulidad restablecimiento de derecho.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_AudienciaInicial($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaInicial = \Yii::$app->params['alertaNulidadRestablecimiento_AudienciaInicial']['diasParaAlerta'];

        //Si la audiencia inicial ya se hizo, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 108 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las contestacion para poder calcular los 30 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 10, 190);

        if (!$fechaContestacion) return false; // no se tiene Contestacion

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaInicial = $this->hallarFechaAlerta($fechaContestacion, $diasAudienciaInicial);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaInicial > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las audiencias iniciales, en los procesos jurídicos de reparación directa.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_AudienciaInicial($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaInicial = \Yii::$app->params['alertaReparacionDirecta_AudienciaInicial']['diasParaAlerta'];

        //Si la audiencia inicial ya se hizo, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 121 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las fechaContestacion para poder calcular los 30 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 11, 194);

        if (!$fechaContestacion) return false; // no se tiene fechaContestacion

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaInicial = $this->hallarFechaAlerta($fechaContestacion, $diasAudienciaInicial);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaInicial > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las audiencias iniciales, en los procesos jurídicos de nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_AudienciaInicial($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasAudienciaInicial = \Yii::$app->params['alertaNulidad_AudienciaInicial']['diasParaAlerta'];

        //Si la audiencia inicial ya se hizo, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 95 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los 30 días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 9, 186);

        if (!$fechaContestacion) return false; // no se tiene fechaContestacion

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAudienciaInicial = $this->hallarFechaAlerta($fechaContestacion, $diasAudienciaInicial);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAudienciaInicial > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las excepciones del despacho, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_Excepciones($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesExcepciones = \Yii::$app->params['alertaEjecutivo_Excepciones']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 167 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 6, 167);

        if (!$fechaExcepciones) return false; // no se tiene excepciones no es esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaExcepciones = $this->hallarFechaAlerta($fechaExcepciones, $diasHabilesExcepciones);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaExcepciones > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las excepciones del despacho, en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_Excepciones($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesExcepciones = \Yii::$app->params['alertaVerbal_Excepciones']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 170 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 3, 170);

        if (!$fechaExcepciones) return false; // no se tiene excepciones no es esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaExcepciones = $this->hallarFechaAlerta($fechaExcepciones, $diasHabilesExcepciones);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaExcepciones > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las excepciones del despacho, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_Excepciones($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesExcepciones = \Yii::$app->params['alertaVerbalSumario_Excepciones']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 177 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los días para enviar esta alerta.
        $fechaExcepciones = $this->hallarFechaProcesoAnterior($proceso->id, 4, 177);

        if (!$fechaExcepciones) return false; // no se tiene excepciones no es esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaExcepciones = $this->hallarFechaAlerta($fechaExcepciones, $diasHabilesExcepciones);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaExcepciones > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las Contestacion de la demanda, en los procesos jurídicos de tipo nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_Contestacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesContestacion = \Yii::$app->params['alertaNulidad_Contestacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 186 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las excepcione para poder calcular los días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 9, 186);

        if (!$fechaContestacion) return false; // no se tiene Contestacion no es esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaContestacion = $this->hallarFechaAlerta($fechaContestacion, $diasHabilesContestacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaContestacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las excepciones del despacho, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_Contestacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesContestacion = \Yii::$app->params['alertaNulidadRestablecimiento_Contestacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 190 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las Contestacion para poder calcular los días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 10, 190);

        if (!$fechaContestacion) return false; // no se tiene Contestacion no es esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaContestacion = $this->hallarFechaAlerta($fechaContestacion, $diasHabilesContestacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaContestacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * las excepciones del despacho, en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_Contestacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesContestacion = \Yii::$app->params['alertaReparacionDirecta_Contestacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 194 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de las Contestacion para poder calcular los días para enviar esta alerta.
        $fechaContestacion = $this->hallarFechaProcesoAnterior($proceso->id, 11, 194);

        if (!$fechaContestacion) return false; // no se tiene Contestacion no es esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaContestacion = $this->hallarFechaAlerta($fechaContestacion, $diasHabilesContestacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaContestacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * avance de 60 días del Mandamiento de Pago , en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_MandamientoPagoAvance60Dias($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesMandamientoPagoAvance60Dias = \Yii::$app->params['alertaEjecutivo_MandamientoPagoAvance60Dias']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 52 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la radicacion para poder calcular los días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 6, 51);

        if (!$fechaRadicacion) return false; // no se tiene radicacion no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaMandamientoPagoAvance60Dias = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesMandamientoPagoAvance60Dias);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaMandamientoPagoAvance60Dias > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * Mandamiento de Pago para Corregir o Reponer, en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_MandamientoPagoCorregiroReponer($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesMandamientoPagoCorregiroReponer = \Yii::$app->params['alertaEjecutivo_MandamientoPagoCorregiroReponer']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 52 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha del mandamiento de pago para poder calcular los días para enviar esta alerta.
        $fechaMandamiento = $this->hallarFechaProcesoAnterior($proceso->id, 6, 52);

        if (!$fechaMandamiento) return false; // no se tiene mandamiento de pago no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaMandamientoPagoCorregiroReponer = $this->hallarFechaAlerta($fechaMandamiento, $diasHabilesMandamientoPagoCorregiroReponer);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaMandamientoPagoCorregiroReponer > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * la fijacion de fecha de audiencia en los procesos jurídicos de tipo conciliación extrajudicial. 
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaConciliacionExtraJudicial_FijacionFechaAudicencia($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesFijacionFecha = \Yii::$app->params['alertaConciliacionExtraJudicial_FijacionFechaAudicencia']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 2 && $proceso->jur_etapas_procesal_id == 173 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 2, 2);

        if (!$fechaRadicacion) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaFijacionFecha = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesFijacionFecha);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaFijacionFecha > $hoy) {
            return false;
        }

        return true;
    }


    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo ordinario laboral. Esta alerta se sale del molde 
     * que usan casi todas donde se consulta por le fecha del estado anterior para calcular cuando se envía la
     * alerta.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaOrdinarioLaboral_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 179 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 8, 179);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

     /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo nulidad. Esta alerta se sale del molde 
     * que usan casi todas donde se consulta por le fecha del estado anterior para calcular cuando se envía la
     * alerta.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaNulidad_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 184 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 9, 184);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo nulidad restablecimiento de derecho. Esta alerta se sale del molde 
     * que usan casi todas donde se consulta por le fecha del estado anterior para calcular cuando se envía la
     * alerta.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaNulidadRestablecimiento_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 188 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 10, 188);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo reparacion directa. Esta alerta se sale del molde 
     * que usan casi todas donde se consulta por le fecha del estado anterior para calcular cuando se envía la
     * alerta.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaReparacionDirecta_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 192 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 11, 192);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo monitorio. Esta alerta se sale del molde 
     * que usan casi todas donde se consulta por le fecha del estado anterior para calcular cuando se envía la
     * alerta.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaMonitorio_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 197 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 5, 197);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo conciliación extrajudicial. Esta alerta se sale del molde 
     * que usan casi todas donde se consulta por le fecha del estado anterior para calcular cuando se envía la
     * alerta.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaConciliacionExtraJudicial_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaConciliacionExtraJudicial_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 2 && $proceso->jur_etapas_procesal_id == 172 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 2, 172);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo ejecutivo. Esta alerta se sale del molde 
     * que usan casi todas donde se consulta por le fecha del estado anterior para calcular cuando se envía la
     * alerta.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaEjecutivo_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 165 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 6, 165);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaVerbal_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 168 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 3, 168);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * recepción del poder en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_RecepcionDePoder($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRecepcionPoder = \Yii::$app->params['alertaVerbalSumario_RecepcionDePoder']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 175 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de recepcion del poder para poder calcular los 3 días para enviar esta alerta.
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id, 4, 175);

        if ($fechaRecepcionPoder) return false; // tiene recepción de poder no hay que alertar

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaPoder = $this->hallarFechaAlerta($proceso->jur_fecha_recepcion, $diasHabilesRecepcionPoder);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaPoder > $hoy) {
            return false;
        }

        return true;
    }
    

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la conciliacion en los procesos jurídicos de tipo conciliación extrajudicial.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaConciliacionExtraJudicial_RadicacionConciliacion($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionconciliacion = \Yii::$app->params['alertaConciliacionExtraJudicial_RadicacionConciliacion']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 2 && $proceso->jur_etapas_procesal_id == 2 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,2,172);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionconciliacion);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo conciliacion demanda.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaConciliacionExtraJudicial_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaConciliacionExtraJudicial_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 2 && $proceso->jur_etapas_procesal_id == 174 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de conciliacion parcial o conciliacion fallida para poder calcular los 30 días para enviar esta alerta.
        $fechaConciliacion = $this->hallarFechaProcesoAnterior($proceso->id, 2, 4);
        if (!$fechaConciliacion) { // no se tiene conciliacion parcial, preguntar por la conciliacion fallida
            //Obtener la fecha de la conciliacion fallida
            $fechaConciliacion = $this->hallarFechaProcesoAnterior($proceso->id, 2, 6);
            if (!$fechaConciliacion) return false; // no se tiene tampoco fecha de fallida , no se alerta
        }

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaConciliacion, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaEjecutivo_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 51 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,6,165);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaVerbal_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 10 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,3,168);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaVerbalSumario_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 26 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,4,175);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la devolución de la demanda en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_DevolucionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesDevolucionDemanda = \Yii::$app->params['alertaOrdinarioLaboral_DevolucionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 180 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaDevolucion = $this->hallarFechaProcesoAnterior($proceso->id,8,180);

        if (!$fechaDevolucion) return false; // no tiene fecha de devolucion, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaDevolucion = $this->hallarFechaAlerta($fechaDevolucion, $diasHabilesDevolucionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaDevolucion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaOrdinarioLaboral_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 78 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,8,179);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo nulidad restablecimiento.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaNulidadRestablecimiento_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 104 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,10,188);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo reparacion directa.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaReparacionDirecta_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 117 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,11,192);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo monitorio.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaMonitorio_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 38 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,5,197);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la radicación de la demanda en los procesos jurídicos de tipo nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_RadicacionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRadicacionDemanda = \Yii::$app->params['alertaNulidad_RadicacionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 91 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        // Validar cuando se envío el poder
        $fechaRecepcionPoder = $this->hallarFechaProcesoAnterior($proceso->id,9,184);

        if (!$fechaRecepcionPoder) return false; // no tiene fecha de recepción, no se evalua esta alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAlertaRadicacion = $this->hallarFechaAlerta($fechaRecepcionPoder, $diasHabilesRadicacionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaRadicacion > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la inadmision de la demanda en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_InadmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesInadmisionDemanda = \Yii::$app->params['alertaVerbal_InadmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 169 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la inadmision para poder calcular los días para enviar esta alerta.
        $fechaInadmision = $this->hallarFechaProcesoAnterior($proceso->id, 3, 169);

        if (!$fechaInadmision) return false; // no se tiene inadmision, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaInadmisionDemanda = $this->hallarFechaAlerta($fechaInadmision, $diasHabilesInadmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaInadmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la inadmision de la demanda en los procesos jurídicos de tipo verbal sumario .
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_InadmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesInadmisionDemanda = \Yii::$app->params['alertaVerbalSumario_InadmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 176 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la inadmision para poder calcular los días para enviar esta alerta.
        $fechaInadmision = $this->hallarFechaProcesoAnterior($proceso->id, 4, 176);

        if (!$fechaInadmision) return false; // no se tiene inadmision, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaInadmisionDemanda = $this->hallarFechaAlerta($fechaInadmision, $diasHabilesInadmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaInadmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la inadmision de la demanda en los procesos jurídicos de tipo nulidad .
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_InadmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesInadmisionDemanda = \Yii::$app->params['alertaNulidad_InadmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 185 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la inadmision para poder calcular los días para enviar esta alerta.
        $fechaInadmision = $this->hallarFechaProcesoAnterior($proceso->id, 9, 185);

        if (!$fechaInadmision) return false; // no se tiene inadmision, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaInadmisionDemanda = $this->hallarFechaAlerta($fechaInadmision, $diasHabilesInadmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaInadmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la inadmision de la demanda en los procesos jurídicos de tipo nulidad .
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_InadmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesInadmisionDemanda = \Yii::$app->params['alertaNulidadRestablecimiento_InadmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 189 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la inadmision para poder calcular los días para enviar esta alerta.
        $fechaInadmision = $this->hallarFechaProcesoAnterior($proceso->id, 10, 189);

        if (!$fechaInadmision) return false; // no se tiene inadmision, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaInadmisionDemanda = $this->hallarFechaAlerta($fechaInadmision, $diasHabilesInadmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaInadmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la inadmision de la demanda en los procesos jurídicos de tipo reparacion directa .
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_InadmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesInadmisionDemanda = \Yii::$app->params['alertaReparacionDirecta_InadmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 193 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la inadmision para poder calcular los días para enviar esta alerta.
        $fechaInadmision = $this->hallarFechaProcesoAnterior($proceso->id, 11, 193);

        if (!$fechaInadmision) return false; // no se tiene inadmision, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaInadmisionDemanda = $this->hallarFechaAlerta($fechaInadmision, $diasHabilesInadmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaInadmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la inadmision de la demanda en los procesos jurídicos de tipo monitorio .
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_InadmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesInadmisionDemanda = \Yii::$app->params['alertaMonitorio_InadmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 198 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la inadmision para poder calcular los días para enviar esta alerta.
        $fechaInadmision = $this->hallarFechaProcesoAnterior($proceso->id, 5, 198);

        if (!$fechaInadmision) return false; // no se tiene inadmision, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaInadmisionDemanda = $this->hallarFechaAlerta($fechaInadmision, $diasHabilesInadmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaInadmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la requerimiento de pago en los procesos jurídicos de tipo monitorio .
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaMonitorio_RequerimientoPago($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesRequerimientoPago = \Yii::$app->params['alertaMonitorio_RequerimientoPago']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 5 && $proceso->jur_etapas_procesal_id == 199 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la Radicacion para poder calcular los días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 5, 38);

        if (!$fechaRadicacion) return false; // no se tiene radicacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaRequerimientoPago = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesRequerimientoPago);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaRequerimientoPago > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la admisión de la demanda en los procesos jurídicos de tipo verbal.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbal_AdmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAdmisionDemanda = \Yii::$app->params['alertaVerbal_AdmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 3 && $proceso->jur_etapas_procesal_id == 11 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la radicación para poder calcular los 60 días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 3, 10);

        if (!$fechaRadicacion) return false; // no se tiene radicacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAdmisionDemanda = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesAdmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAdmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }
    
    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la admisión de la demanda en los procesos jurídicos de tipo ordinario laboral.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaOrdinarioLaboral_AdmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAdmisionDemanda = \Yii::$app->params['alertaOrdinarioLaboral_AdmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 8 && $proceso->jur_etapas_procesal_id == 79 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la radicación para poder calcular los 60 días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 8, 78);

        if (!$fechaRadicacion) return false; // no se tiene radicacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAdmisionDemanda = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesAdmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAdmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la admisión de la demanda en los procesos jurídicos de tipo verbal sumario.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaVerbalSumario_AdmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAdmisionDemanda = \Yii::$app->params['alertaVerbalSumario_AdmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 4 && $proceso->jur_etapas_procesal_id == 27 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la radicación para poder calcular los 60 días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 4, 26);

        if (!$fechaRadicacion) return false; // no se tiene radicacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAdmisionDemanda = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesAdmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAdmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la admisión de la demanda en los procesos jurídicos de tipo nulidad.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidad_AdmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAdmisionDemanda = \Yii::$app->params['alertaNulidad_AdmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 9 && $proceso->jur_etapas_procesal_id == 92 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la radicación para poder calcular los 60 días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 9, 91);

        if (!$fechaRadicacion) return false; // no se tiene radicacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAdmisionDemanda = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesAdmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAdmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la admisión de la demanda en los procesos jurídicos de tipo nulidad restablecimiento.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaNulidadRestablecimiento_AdmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAdmisionDemanda = \Yii::$app->params['alertaNulidadRestablecimiento_AdmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 10 && $proceso->jur_etapas_procesal_id == 105 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la radicación para poder calcular los 60 días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 10, 104);

        if (!$fechaRadicacion) return false; // no se tiene radicacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAdmisionDemanda = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesAdmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAdmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la admisión de la demanda en los procesos jurídicos de tipo nulidad restablecimiento.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaReparacionDirecta_AdmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesAdmisionDemanda = \Yii::$app->params['alertaReparacionDirecta_AdmisionDemanda']['diasParaAlerta'];

        //Si el poder ya fue recibido, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 11 && $proceso->jur_etapas_procesal_id == 118 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la radicación para poder calcular los 60 días para enviar esta alerta.
        $fechaRadicacion = $this->hallarFechaProcesoAnterior($proceso->id, 11, 117);

        if (!$fechaRadicacion) return false; // no se tiene radicacion, no se alerta

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaAdmisionDemanda = $this->hallarFechaAlerta($fechaRadicacion, $diasHabilesAdmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAdmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a
     * la inadmision de la demanda en los procesos jurídicos de tipo ejecutivo.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaEjecutivo_InadmisionDemanda($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesInadmisionDemanda = \Yii::$app->params['alertaEjecutivo_InadmisionDemanda']['diasParaAlerta'];

        //Si ya está en inadmision demanda, pasar al siguiente registro
        if ($proceso->jur_tipo_proceso_id == 6 && $proceso->jur_etapas_procesal_id == 166 && isset($proceso->jur_fecha_etapa_procesal) && $proceso->jur_fecha_etapa_procesal != "") {
            return false;
        }

        //Obtener la fecha de la inadmision para poder calcular los días para enviar esta alerta.
        $fechaInadmision = $this->hallarFechaProcesoAnterior($proceso->id, 6, 166);

        if (!$fechaInadmision) return false; // no se tiene inadmision

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta juridica            
        $fechaInadmisionDemanda = $this->hallarFechaAlerta($fechaInadmision, $diasHabilesInadmisionDemanda);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaInadmisionDemanda > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * envio de la carta en la estapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaPrejuridico_CartaEnviada($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaCarta = \Yii::$app->params['alertaPREJuridico_CartaEnviada']['diasParaAlerta'];

        //Si la carta ya fue enviada, pasar al siguiente registro
        if ($proceso->prejur_carta_enviada == "SI") {
            return false;
        }

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta prejuridica            
        $fechaAlertaCarta = $this->hallarFechaAlerta($proceso->prejur_fecha_recepcion, $diasHabilesParaCarta);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaCarta > $hoy) {
            return false;
        }

        return true;
    }


    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a la
     * llamada de un cliente en la estapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas) 
     */
    private function alertaPrejuridico_LlamadaRealizada($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaLlamada = \Yii::$app->params['alertaPrejuridico_LlamadaRealizada']['diasParaAlerta'];

        //Si la llamada ya fue realizada, pasar al siguiente registro
        if ($proceso->prejur_llamada_realizada == "SI") {
            return false;
        }

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta prejuridica            
        $fechaAlertaLlamada = $this->hallarFechaAlerta($proceso->prejur_fecha_recepcion, $diasHabilesParaLlamada);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaLlamada > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a 
     * la visita domiciliaria en la etapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaPrejuridico_VisitaDomiciliaria($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaVisita = \Yii::$app->params['alertaPrejuridico_VisitaDomiciliaria']['diasParaAlerta'];

        //Si la visita ya fue realizada, pasar al siguiente registro
        if ($proceso->prejur_visita_domiciliaria == "SI" || $proceso->prejur_carta_enviada == "SI" || $proceso->prejur_llamada_realizada == "SI") {
            return false;
        }

        //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta prejuridica            
        $fechaAlertaVisita = $this->hallarFechaAlerta($proceso->prejur_fecha_recepcion, $diasHabilesParaVisita);

        //Si no es tiempo de la alerta continuar con el siguiente proceso
        if ($fechaAlertaVisita > $hoy) {
            return false;
        }

        return true;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a 
     * los acuerdos de pagos en la etapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaPrejuridico_AcuerdosDePago($proceso)
    {

        //Si hay acuerdos de pago, entonces cosultar la tabla consolidado_pagos_prejuridicos para saber el estado de los pagos
        if ($proceso->prejur_acuerdo_pago == "SI") {
            //buscar registros en consolidado_pagos_prejuridicos
            $acuerdosPagos = $this->validarAcuerdosPagos($proceso->id);

            //si hay acuerdos de pagos sin cumplir
            if ($acuerdosPagos) {
                return true;
            }
        }
        return false;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a 
     * la remisión de los procesos a juridico dado que no hubo acuerdo de pago en la etapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaPrejuridico_SinAcuerdoDePago($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaRemitir = \Yii::$app->params['alertaPREJuridico_SinAcuerdoDePago']['diasParaAlerta'];
        // Se obtiene la fecha para enviar la alerta
        $fechaAlertaRemitir = $this->hallarFechaAlerta($proceso->prejur_fecha_no_acuerdo_pago, $diasHabilesParaRemitir);

        //Si no hubo acuerdo de pago, y han pasado 3 días luego de haberlo marcado, alertar
        if ($proceso->prejur_acuerdo_pago == "NO" && $fechaAlertaRemitir <= $hoy && !(isset($proceso->jur_fecha_recepcion))) {
            return true;
        }

        return false;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a 
     * la remisión de los procesos a juridico dado que el estudio de bienes fue positivo en la etapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaPrejuridico_EstudioBienesPositivo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaRemitir = \Yii::$app->params['alertaPREJuridico_EstudioBienesPositivo']['diasParaAlerta'];
        // Se obtiene la fecha para enviar la alerta
        $fechaAlertaRemitir = $this->hallarFechaAlerta($proceso->prejur_fecha_estudio_bienes, $diasHabilesParaRemitir);

        //Si no hubo acuerdo de pago, y han pasado 3 días luego de haberlo marcado, alertar
        if ($proceso->prejur_resultado_estudio_bienes == "POSITIVO" && $fechaAlertaRemitir <= $hoy && !(isset($proceso->jur_fecha_recepcion))) {
            return true;
        }

        return false;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a 
     * la generación del informe de inviabilidad castigo dado que el estudio de bienes fue negativo en la etapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaPrejuridico_EstudioBienesNegativo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaRemitir = \Yii::$app->params['alertaPREJuridico_EstudioBienesNegativo']['diasParaAlerta'];
        // Se obtiene la fecha para enviar la alerta
        $fechaAlertaRemitir = $this->hallarFechaAlerta($proceso->prejur_fecha_estudio_bienes, $diasHabilesParaRemitir);

        //Si no hubo acuerdo de pago, y han pasado 3 días luego de haberlo marcado, alertar
        if ($proceso->prejur_resultado_estudio_bienes == "NEGATIVO" && $fechaAlertaRemitir <= $hoy && $proceso->prejur_informe_castigo_enviado == "NO") {
            return true;
        }

        return false;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a 
     * la generación de cartas de castigo dado que el estudio de bienes fue negativo y ya se envioó el informe al 
     * cliente en la etapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return boolean (Este metodo debe devolver un true o un false dependiente de si hay o no alertas)
     */
    private function alertaPrejuridico_CartaDeCastigo($proceso)
    {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaCarta = \Yii::$app->params['alertaPREJuridico_CartaDeCastigo']['diasParaAlerta'];
        // Se obtiene la fecha para enviar la alerta
        $fechaAlertaCarta = $this->hallarFechaAlerta($proceso->prejur_fecha_estudio_bienes, $diasHabilesParaCarta);

        //Si no hubo acuerdo de pago, y han pasado 3 días luego de haberlo marcado, alertar
        if ($fechaAlertaCarta <= $hoy && $proceso->prejur_carta_castigo_enviada == "NO") {
            return true;
        }

        return false;
    }


    /**
     * Esta funcion insertará las alertas a la base de datos de alertas.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co      
     * @param type $destinatariosXproceso
     * @param type $asunto
     */
    private function insertarAlertasColaboradores($alertasPorProceso)
    {
        foreach ($alertasPorProceso as $proceso => $alertas) {
            if (!isset($alertas["alertas"])) continue;
            foreach ($alertas["alertas"] as $alerta) {
                foreach ($alertas["destinatarios"] as $usuario => $v) {
                    $modeloAlerta = new \app\models\Alertas();
                    $modeloAlerta->usuario_id = $usuario;
                    $modeloAlerta->proceso_id = $proceso;
                    $modeloAlerta->tipo_alerta_id = $alerta["tipo_alerta_id"];
                    $modeloAlerta->descripcion_alerta = $alerta["asunto"];
                    $modeloAlerta->save();
                }
            }
        }
    }

    /**
     * Esta funcion calcula la fecha exacta en la que se debe mandar una alerta
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co  
     * @param type $fechaInicial
     * @param type $dias
     * @return type
     */
    private function hallarFechaAlerta($fechaInicial, $dias)
    {
        $fechasNoHabiles = $this->obtenerFechasNoHabiles($fechaInicial, $dias);
        $i = 1;
        while ($i <= $dias) {
            $fecha = strtotime("{$fechaInicial} +1 day");
            $dia = date("l", $fecha);
            $fechaInicial = date('Y-m-d', $fecha);
            if (!in_array($fechaInicial, $fechasNoHabiles) && $dia != "Sunday" && $dia != "Saturday") {
                $i++;
            }
        }
        return $fechaInicial;
    }

    /**
     * Funcion para obtener la lista de los dias no habiles
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co 
     * @param type $fechaInicial
     * @return type
     */
    private function obtenerFechasNoHabiles($fechaInicial)
    {
        $diasNohabilesArray = \app\models\DiasNoHabiles::find()
            ->select("fecha_no_habil")
            ->where(['>=', 'fecha_no_habil', $fechaInicial])
            ->asArray()
            ->all();
        return array_column($diasNohabilesArray, "fecha_no_habil");
    }

    /**
     * Funcion para obtener la lista de pagos hechos o pactados de un proceso
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co 
     * @param type $procesoID Identificador del proceso a consultar los pagos
     * @return type
     */
    private function validarAcuerdosPagos($procesoID)
    {
        $hoy = date('Y-m-d');
        $pagosProceso = \app\models\ConsolidadoPagosPrejuridicos::find()
            ->where(['proceso_id' => $procesoID])
            ->asArray()
            ->all();

        foreach ($pagosProceso as $pago) {
            if (($pago['fecha_acuerdo_pago'] <= $hoy) && !(isset($pago['fecha_pago_realizado']))) {
                return true;
            }
        }
        return false;
    }


    /**
     * Esta funcion enviará los correos electroncos a los colaboradores 
     * y lideres de un proceso
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co  
     * @param type $destinatariosXproceso
     * @param type $asunto
     * @param type $descripcion
     */
    private function enviarEmail($alertasPorProceso)
    {

        foreach ($alertasPorProceso as $proceso => $value) {

            //Todos los destinatarios listos para ponerlos en el CC del correo
            $emails = array_column($value["destinatarios"], "email");

            // mensaje
            $mensaje = '
            <!DOCTYPE html>
            <html>   
                <head>
                    <style>
                    .content {
                        max-width: auto;
                        margin: auto;
                        }
                        table {
                        width: 100%;
                        border: 1px solid #000;
                    }
                    th, td {
                        width: 25%;
                        text-align: left;
                        vertical-align: top;
                        border: 1px solid #000;
                        border-collapse: collapse;
                        padding: 0.3em;
                        caption-side: bottom;
                    }
                    caption {
                        padding: 0.3em;
                        color: #fff;
                        background: #000;
                    }
                    th {
                        background: #eee;
                    }
                    </style>       
                </head>   
                <center>
                    <body>
                        <div class="content"> 
                            <div>Alertas de gestion de procesos</div><br>
                                    <table>
                                        <thead>
                                            <tr>
                                            <th style="width:10px">ID Proceso</th> 
                                            <th><center>Descripción</center></th>
                                            </tr>
                                        </thead>   
                                        <tbody>';

            foreach ($value["alertas"] as $alerta) {
                $mensaje .= '<tr>
                                                            <td><center><a href="http://carteraintegral.com.co/ciles/web/procesos/update?id=' . $proceso . '" class="edit_btn" >Ir al proceso</a></center></td>
                                                            <td><center>' . $alerta["descripcion"] . '</center> </td>
                                                        </tr>';
                //}
            }

            $mensaje .= '</tbody>
                                    </table>
                            </div>
                        </div>
                    </body>
                </center>
            </html>';
            //var_dump(Yii::$app->mailer);
            Yii::$app->mailer->compose()
                ->setFrom(\Yii::$app->params['adminEmail'])
                ->setTo($emails)
                ->setSubject(\Yii::$app->params['asuntoAlertasProceso'])
                //->setTextBody($asunto) 'Contenido en texto plano'
                ->setHtmlBody($mensaje) //'<b>Contenido HTML</b>'
                ->send();
        }
    }
}
