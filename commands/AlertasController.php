<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Alertas controller
 */
class AlertasController extends Controller {

    /**
     * Init function: Esta función iniciará el proceso de todas las alertas
     * de cartera integral (Alertas prejuridico, aleras juridico, alertas taras,
     * etc)
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co
     */
    public function actionInitProcesarAlertas() {

        // Array con todas las alertas por proceso
        $alertasPorProceso = [];

        // Objetos en estado de gestion
        $procesos = \app\models\Procesos::find()
                ->where(["estado_proceso_id" => 1])
                ->all();

        //Para cada proceso
        foreach ($procesos as $proceso) {

            #=======================================================================
            # ALERTAS PREJURIDICAS
            #=======================================================================
            #
            //Esta alerta validará el envío de la carta al cliente
            if (\Yii::$app->params['alertaPREJuridico_Carta']['activo']) {
                //Procesar las alertas prejuridicas de carta
                $hayAlertasCartas = $this->alertaPrejuridico_CartaEnviada($proceso);
                if ($hayAlertasCartas) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_Carta']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_Carta']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará la llamada al cliente
            if (\Yii::$app->params['alertaPREJuridico_Llamada']['activo']) {
                //Procesar las alertas prejuridicas de llamadas
                $hayAlertaLlamada = $this->alertaPrejuridico_LlamadaRealizada($proceso);
                if ($hayAlertaLlamada) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_Llamada']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_Llamada']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará la llamada al cliente
            if (\Yii::$app->params['alertaPREJuridico_Llamada']['activo']) {
                //Procesar las alertas prejuridicas de llamadas
                $hayAlertaLlamada = $this->alertaPrejuridico_LlamadaRealizada($proceso);
                if ($hayAlertaLlamada) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_Llamada']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_Llamada']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará la visita al cliente
            if (\Yii::$app->params['alertaPREJuridico_Visita']['activo']) {
                //Procesar las alertas prejuridicas de visitas
                $hayAlertaVisita = $this->alertaPrejuridico_VisitaDomiciliaria($proceso);
                if ($hayAlertaVisita) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_Visita']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_Visita']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará los pagos comprometidos del cliente
            if (\Yii::$app->params['alertaPREJuridico_Pagos']['activo']) {
                //Procesar las alertas prejuridicas de pagos
                $hayAlertaPagos = $this->alertaPrejuridico_AcuerdosDePago($proceso);
                if ($hayAlertaPagos) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_Pagos']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_Pagos']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará si no hubo acuerdo de pago, y entonces debe remitirse a juridico
            if (\Yii::$app->params['alertaPREJuridico_SinAcuerdoDePago']['activo']) {
                //Procesar las alertas prejuridicas de pagos
                $hayAlertaRemitir = $this->alertaPrejuridico_SinAcuerdoDePago($proceso);
                if ($hayAlertaRemitir) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_SinAcuerdoDePago']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_SinAcuerdoDePago']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará si el estudio de bienes fue positivo, y entonces debe remitirse a juridico
            if (\Yii::$app->params['alertaPREJuridico_EstudioBienesPositivo']['activo']) {
                //Procesar las alertas prejuridicas de pagos
                $hayAlertaEstudioPositivo = $this->alertaPrejuridico_EstudioBienesPositivo($proceso);
                if ($hayAlertaEstudioPositivo) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_EstudioBienesPositivo']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_EstudioBienesPositivo']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará si el estudio de bienes fue negativo, y entonces debe envairse informe de inviabilidad o castigo
            if (\Yii::$app->params['alertaPREJuridico_EstudioBienesNegativo']['activo']) {
                //Procesar las alertas prejuridicas de pagos
                $hayAlertaEstudioNegativo = $this->alertaPrejuridico_EstudioBienesNegativo($proceso);
                if ($hayAlertaEstudioNegativo) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_EstudioBienesNegativo']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_EstudioBienesNegativo']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }

            //Esta alerta validará si el estudio de bienes fue negativo, y entonces debe enviarse carta de inviabilidad o castigo
            if (\Yii::$app->params['alertaPREJuridico_CartaDeCastigo']['activo']) {
                //Procesar las alertas prejuridicas de pagos
                $hayAlertaCartaDeCastigo = $this->alertaPrejuridico_CartaDeCastigo($proceso);
                if ($hayAlertaCartaDeCastigo) {
                    // Asunto de la alerta
                    $asunto = Yii::$app->params['alertaPREJuridico_CartaDeCastigo']['asunto'];
                    // Asunto de la alerta
                    $descripcion = Yii::$app->params['alertaPREJuridico_CartaDeCastigo']['descripcion'];
                    $alertasPorProceso[$proceso->id]["alertas"][] = [
                        "asunto" => $asunto,
                        "descripcion" => $descripcion
                    ];
                }
            }




            #=======================================================================
            # ALERTAS JURIDICAS
            #=======================================================================

            #=======================================================================
            # OTRAS ALERTAS
            #=======================================================================


            /*
             * Si este proceso tiene alertas para enviar obtengo 
             * sus colaboradore y su lider
             */
            if (count($alertasPorProceso) > 0) {
                // Colaboradores del proceso
                $colaboradores = $proceso->procesosXColaboradores;
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

        //Si hay alertas luego de terminado todo el proceso las envío todas
        if (count($alertasPorProceso) > 0) {
            //Insertar las alertas en la base de datos
            $this->insertarAlertasColaboradores($alertasPorProceso);
            //Enviar las alertas a cada colabroador
            $this->enviarEmail($alertasPorProceso);
        }
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
    private function alertaPrejuridico_CartaEnviada($proceso) {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaCarta = \Yii::$app->params['alertaPREJuridico_Carta']['diasParaAlerta'];

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
    private function alertaPrejuridico_LlamadaRealizada($proceso) {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaLlamada = \Yii::$app->params['alertaPREJuridico_Llamada']['diasParaAlerta'];

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
    private function alertaPrejuridico_VisitaDomiciliaria($proceso) {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaVisita = \Yii::$app->params['alertaPREJuridico_Visita']['diasParaAlerta'];

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
    private function alertaPrejuridico_AcuerdosDePago($proceso) {
        
        //Si hay acuerdos de pago, entonces cosultar la tabla consolidado_pagos_prejuridicos para saber el estado de los pagos
        if ($proceso->prejur_acuerdo_pago == "SI") {
            //buscar registros en consolidado_pagos_prejuridicos
            $acuerdosPagos = $this->validarAcuerdosPagos($proceso->id);
            
            //si hay acuerdos de pagos sin cumplir
            if ($acuerdosPagos){
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
    private function alertaPrejuridico_SinAcuerdoDePago($proceso) {
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
    private function alertaPrejuridico_EstudioBienesPositivo($proceso) {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaRemitir = \Yii::$app->params['alertaPREJuridico_EstudioBienesPositivo']['diasParaAlerta'];
        // Se obtiene la fecha para enviar la alerta
        $fechaAlertaRemitir = $this->hallarFechaAlerta($proceso->prejur_fecha_estudio_bienes, $diasHabilesParaRemitir);

        //Si no hubo acuerdo de pago, y han pasado 3 días luego de haberlo marcado, alertar
        if ($proceso->prejur_estudio_bienes == "POSITIVO" && $fechaAlertaRemitir <= $hoy && !(isset($proceso->jur_fecha_recepcion))) {
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
    private function alertaPrejuridico_EstudioBienesNegativo($proceso) {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaRemitir = \Yii::$app->params['alertaPREJuridico_EstudioBienesNegativo']['diasParaAlerta'];
        // Se obtiene la fecha para enviar la alerta
        $fechaAlertaRemitir = $this->hallarFechaAlerta($proceso->prejur_fecha_estudio_bienes, $diasHabilesParaRemitir);

        //Si no hubo acuerdo de pago, y han pasado 3 días luego de haberlo marcado, alertar
        if ($proceso->prejur_estudio_bienes == "NEGATIVO" && $fechaAlertaRemitir <= $hoy && $proceso->prejur_informe_castigo_enviado == "NO") {
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
    private function alertaPrejuridico_CartaDeCastigo($proceso) {
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
    private function insertarAlertasColaboradores($alertasPorProceso) {

        foreach ($alertasPorProceso as $proceso => $alertas) {
            foreach ($alertas["alertas"] as $alerta) {
                foreach ($alertas["destinatarios"] as $usuario => $v) {
                    $modeloAlerta = new \app\models\Alertas();
                    $modeloAlerta->usuario_id = $usuario;
                    $modeloAlerta->proceso_id = $proceso;
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
    private function hallarFechaAlerta($fechaInicial, $dias) {
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
    private function obtenerFechasNoHabiles($fechaInicial) {
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
    private function validarAcuerdosPagos($procesoID) {
        $hoy = date('Y-m-d');
        $pagosProceso = \app\models\ConsolidadoPagosPrejuridicos::find()
                ->where(['proceso_id', $procesoID])
                ->asArray()
                ->all();
        
                foreach ($pagosProceso as $pago){
                    if (($pago->fecha_acuerdo_pago <= $hoy) && !(isset($pago->fecha_pago_realizado))){
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
    private function enviarEmail($alertasPorProceso) {

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
            </body>
          </center>
          </html>
        ';
var_dump(Yii::$app->mailer);
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
