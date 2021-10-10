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

        #=======================================================================
        # ALERTAS PREJURIDICAS
        #=======================================================================
        //Esta alerta validará el envío de la carta al cliente
        if (\Yii::$app->params['alertaPREJuridico_Carta']['activo']) {

            // Asunto de la alerta
            $asunto = isset(Yii::$app->params['alertaPREJuridico_Carta']['asunto']) ?
                    Yii::$app->params['alertaPREJuridico_Carta']['asunto'] :
                    "CILES - Alertas: Enviar carta al cliente";

            // Asunto de la alerta
            $descripcion = isset(Yii::$app->params['alertaPREJuridico_Carta']['descripcion']) ?
                    Yii::$app->params['alertaPREJuridico_Carta']['descripcion'] :
                    "";

            //Procesar las alertas prejuridicas
            $alertasCartas = $this->alertaPrejuridico_CartaEnviada();

            //si hay alertas para carta se procede a enviarlas
            if ($alertasCartas && count($alertasCartas) > 0) {

                //Insertar las alertas en la base de datos
                $this->insertarAlertasColaboradores($alertasCartas, $asunto);

                //Enviar las alertas a cada colabroador
                $this->enviarEmail($alertasCartas, $asunto, $descripcion);
            }
        }

        //Esta alerta validará la llamada al cliente
        if (!\Yii::$app->params['alertaPREJuridico_Llamada']['activo']) {
            //Procesar las alertas prejuridicas
            $this->alertaPrejuridico_LlamadaRealizada();
        }

        #=======================================================================
        # ALERTAS JURIDICAS
        #=======================================================================
        #=======================================================================
        # OTRAS ALERTAS
        #=======================================================================
    }
    

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes al
     * envio de la carta en la estapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return array
     */
    private function alertaPrejuridico_CartaEnviada() {
        $hoy = date('Y-m-d');
        // Se obtienen los dias para alertar
        $diasHabilesParaCarta = \Yii::$app->params['alertaPREJuridico_Carta']['diasParaAlerta'];
        // Inicializar el array de procesos que cumplen con las condiciones para ser enviados en el correo de alerta
        $procesosEnviarCarta = array();

        // Objetos en estado de gestion
        $procesos = \app\models\Procesos::find()
                ->where(["estado_proceso_id" => 1])
                ->all();

        //Para cada proceso
        foreach ($procesos as $proceso) {

            //Si la carta ya fue enviada, pasar al siguiente registro
            if ($proceso->prejur_carta_enviada == "SI") {
                continue;
            }

            //Por cada proceso obtener la fecha de cuando se le debe enviar la alerta prejuridica            
            $fechaAlertaCarta = $this->hallarFechaAlerta($proceso->prejur_fecha_recepcion, $diasHabilesParaCarta);

            //Si no es tiempo de la alerta continuar con el siguiente proceso
            if ($fechaAlertaCarta > $hoy) {
                continue;
            }

            //Colaboradores del proceso
            $colaboradores = $proceso->procesosXColaboradores;

            //Lider del proceso
            $procesosEnviarCarta[$proceso->id]["destinatarios"][$proceso->jefe_id]["nombre"] = strtolower($proceso->jefe->name);
            $procesosEnviarCarta[$proceso->id]["destinatarios"][$proceso->jefe_id]["email"] = strtolower($proceso->jefe->mail);

            //Para cada colaborador obtengo su email y nombre
            foreach ($colaboradores as $col) {
                $id = $col->user->id;
                $procesosEnviarCarta[$proceso->id]["destinatarios"][$id]["nombre"] = strtolower($col->user->name);
                $procesosEnviarCarta[$proceso->id]["destinatarios"][$id]["email"] = strtolower($col->user->mail);
            }
        }
        return $procesosEnviarCarta;
    }

    /**
     * Esta funcion se encargará de procesar todas las alertas referentes a la
     * llamada de un cliente en la estapa prejuridica de un proceso.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co     
     * @return array
     */
    private function alertaPrejuridico_LlamadaRealizada($proceso) {
        //se obtienen los dias para alertar
        $diasHabilesParaAlerta = \Yii::$app->params['alertaPREJuridico_Llamada']['diasParaAlerta'];
        //ya con estos dias se hace el calculo necesario 
    }

    /**
     * Esta funcion inserará las alertas a la base de datos de alertas.
     * 
     * @author Diego Castano <proyectos@onicsoft.com.co>
     * @copyright 2021 CARTERA INTEGRAL S.A.S.
     * @link http://www.carteraintegral.com.co      
     * @param type $destinatariosXproceso
     * @param type $asunto
     */
    private function insertarAlertasColaboradores($destinatariosXproceso, $asunto) {
        foreach ($destinatariosXproceso as $proceso => $value) {
            foreach ($value["destinatarios"] as $usuario => $v) {
                $modeloAlerta = new \app\models\Alertas();
                $modeloAlerta->usuario_id = $usuario;
                $modeloAlerta->proceso_id = $proceso;
                $modeloAlerta->descripcion_alerta = $asunto;
                $modeloAlerta->save();
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
    private function enviarEmail($destinatariosXproceso, $asunto, $descripcion) {

        foreach ($destinatariosXproceso as $procesoID => $destinatarios) {

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
                  <div>' . $descripcion . '</div><br>
                        <table>
                          <thead>
                            <tr>
                              <th style="width:10px">ID Proceso</th> 
                              <th><center>Pendiente</center></th>
                            </tr>
                          </thead>   
                          <tbody>';

            $mensaje .= '<tr>
          <td><center><a href="http://carteraintegral.com.co/ciles/web/procesos/update?id=' . $procesoID . '" class="edit_btn" >Ir al proceso</a></center></td>
            <td><center>' . $asunto . '</center> </td>
          </tr>';
            //}

            $mensaje .= '</tbody>
                </table>
              </div>
            </body>
          </center>
          </html>
        ';

            $emails = array_column($destinatarios["destinatarios"], "email");

            Yii::$app->mailer->compose()
                    ->setFrom(\Yii::$app->params['adminEmail'])
                    ->setTo($emails)
                    ->setSubject($asunto)
                    //->setTextBody($asunto) 'Contenido en texto plano'
                    ->setHtmlBody($mensaje) //'<b>Contenido HTML</b>'
                    ->send();
        }
    }

}
