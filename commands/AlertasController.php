<?php

namespace app\commands;

use app\models\DiasNoHabiles;
use Yii;
use yii\console\Controller;


/**
 * Test controller
 */
class AlertasController extends Controller
{

    /**
     * ESTA FUNCION PROCESA Y ENVIA TODAS LAS ALERTAS DEL DIA
     */
    public function actionEnviaralertas()
    {
        //Si la alerta para carta enviada está activa se trabaja, sino NO
        if (\Yii::$app->params['alertaPREJuridico_Carta']['activo']) {
            $asunto = Yii::$app->params['alertaPREJuridico_Carta']['asunto'] ? Yii::$app->params['alertaPREJuridico_Carta']['asunto'] : "";
            //Procesar las alertas prejuridicas
            $alertasCartas = $this->actionAlertasprejuridico("carta");
            //si hay alertas para carta se procede a enviarlas
            if ($alertasCartas && count($alertasCartas) > 0) {

                foreach ($alertasCartas as $key => $value) {
                    $colaboradores = $value["destinatarios"];
                    //print_r($colaboradores);
                    //realizar los inserts de las alertas
                    $this->insertarAlertasColaboradores($colaboradores, $key,$asunto);
                }
                $alertasXUsuario = $this->alertasXUsuario();
                //enviar las alertas a cada colabroador
                $this->enviarEmail($colaboradores, $key,$asunto);

            } else {
                echo "No hubo alertas de liquidación y generación de cartas 5 días hábiles luego de la llegada del proceso";
            }
        }
        //Si la alerta para llamada está activa se trabaja, sino NO
        if (!\Yii::$app->params['alertaPREJuridico_Llamada']['activo']) {
            //Procesar las alertas prejuridicas
            $this->actionAlertasprejuridico("llamada");
        }
    }
    /**
     * ESTA FUNCION DEBERIA FUNCIONAR SOLO PARA PREJURIDICO Y HACER OTRA PARA JURIDICO
     */
    public function actionAlertasprejuridico($tipoAlerta)
    {

        $hoy =  date('Y-m-d');
        //se obtienen los dias para alertar
        $diasHabilesParaCarta = \Yii::$app->params['alertaPREJuridico_Carta']['diasParaAlerta'];
        //echo "diasHabilesParaCarta: " . $diasHabilesParaCarta . "\n";
        //Inicializar el array de procesos que cumplen con las condiciones para ser enviados en el correo de alerta
        $procesosEnviarCarta = array();


        //TRAER TODOS LOS PROCESOS COMO UN OBJETO
        $procesos = \app\models\Procesos::find()
            ->where(["estado_proceso_id" => 1])
            ->all();

        foreach ($procesos as $proceso) {
            //Si la carta ya fue enviada, pasar al siguiente registro
            if ($proceso->prejur_carta_enviada == "SI") {
                continue;
            }

            //por cada proceso obtener la fecha de cuando se le debe enviar la alerta prejuridica            
            //primero las cartas
            $fechaAlertaCarta = $this->hallarFechaAlerta($proceso->prejur_fecha_recepcion, $diasHabilesParaCarta);
            //echo "fechaAlerta: " . $fechaAlertaCarta . "\n";

            if ($fechaAlertaCarta < $hoy) {
                $procesosEnviarCarta[$proceso->id] =  array();
                //$procesosEnviarCarta[$proceso->id]["id"]=$proceso->id;
            }

            //obtener los colaboradores y el jefe a quienes seran los destinatarios de la alerta
            $colaboradores = $proceso->procesosXColaboradores;
            $lider = \app\models\Users::findIdentity($proceso->jefe_id);


            $procesosEnviarCarta[$proceso->id]["destinatarios"][$proceso->jefe_id]["nombre"] = $lider->name;
            $procesosEnviarCarta[$proceso->id]["destinatarios"][$proceso->jefe_id]["email"] = $lider->mail;

            //LUEGO HACESUN FOREACH PARA CADA COLABORADOR Y COGES SU NOMBRE Y SU EMAIL USANDO LAS MISMAS RELACIONES ANIDADAS
            foreach ($colaboradores as $col) {
                //en este caso un colaborador tiene una relacion con el usuario
                $nombre = $col->user->name;
                $email = $col->user->mail;
                $id = $col->user->id;
                $procesosEnviarCarta[$proceso->id]["destinatarios"][$id]["nombre"] = $nombre;
                $procesosEnviarCarta[$proceso->id]["destinatarios"][$id]["email"] = $email;
            }
        }
        return $procesosEnviarCarta;
    }

    /**
     * ESTA FUNCION DEBERIA FUNCIONAR SOLO PARA PREJURIDICO Y HACER OTRA PARA JURIDICO
     */
    public function actionAlertasjuridico()
    {
        // Si la alerta para llamadarealizada está activa se trabaja
        if (!\Yii::$app->params['alertaPREJuridico_Llamada']['activo']) {
            return;
            //$this->alertaPrejuridico_LlamadaRealizada($proceso);
        }

        //TRAER TODOS LOS PROCESOS COMO UN OBJETO
        //TODO: Deberían ser los procesos en estado castigado??
        $procesos = \app\models\Procesos::find()
            ->where(["estado_proceso_id" => 1])
            ->all();

        foreach ($procesos as $proceso) {
        }
    }

    private function alertaPrejuridico_CartaEnviada($proceso)
    {
    }


    private function alertaPrejuridico_LlamadaRealizada($proceso)
    {
        //se obtienen los dias para alertar
        $diasHabilesParaAlerta = \Yii::$app->params['alertaPREJuridico_Llamada']['diasParaAlerta'];
        //ya con estos dias se hace el calculo necesario 
    }

    private function insertarAlertasColaboradores($destinatarios, $id, $asunto)
    {
        //PASO 2: guardar la alerta en la DB
        //$modeloAlerta = new \app\models\Alertas();
        $fecha = date('Y-m-d');
        foreach ($destinatarios as $key => $value) {
            // Yii::$app->db->createCommand()
            // ->batchInsert('alertas',
            //  ['proceso_id', 'usuario_id','descripcion_alerta','created','created_by','modified','modified_by'], 
            //  [ [$id, $key, $asunto,$fecha,'admin',$fecha,'admin']])->execute();
            $modeloAlerta = new \app\models\Alertas();
            $modeloAlerta->usuario_id = $key;
            $modeloAlerta->proceso_id = $id;
            $modeloAlerta->descripcion_alerta = $asunto;
            $modeloAlerta->save();
        }
    }

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

    private function obtenerFechasNoHabiles($fechaInicial)
    {
        $diasNohabilesArray = \app\models\DiasNoHabiles::find()
            ->select("fecha_no_habil")
            ->where(['>=', 'fecha_no_habil', $fechaInicial])
            ->asArray()
            ->all();
        return array_column($diasNohabilesArray, "fecha_no_habil");
    }

    private function alertasXUsuario()
    {
        $hoy =  date('Y-m-d');

        $alertasXUsuario = \app\models\Alertas::find()
            ->where(['>=', 'created', $hoy])
            ->asArray()
            ->all();
        //var_dump($alertasXUsuario);
        return $alertasXUsuario;

    }


    private function enviarEmail($destinatarios,$procesoID,$asunto)
    {
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
                  <div>Tienes pendiente hacer esta(s) liquidaci&oacute;n(es) y generar la(s) carta(s) correspondiente(s).</div><br>
                        <table>
                          <thead>
                            <tr>
                              <th style="width:10px">ID Proceso</th> 
                              <th><center>Pendiente</center></th>
                            </tr>
                          </thead>   
                          <tbody>';
  
      //foreach ($alertas as $key => $value) {
  
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
        
        $emails = "";

        foreach ($destinatarios as $key => $value) {
            $value['email'] = strtolower($value['email']);
            $emails .="{$value['email']},";

        }
         
        //$emails = substr($emails, 0, -1);
        $emails = 'dcastanom@gmail.com';
        echo $emails."\n";
        echo \Yii::$app->params['adminEmail']."\n";
        //PASO 1: ENVIAR EMAIL
        Yii::$app->mailer->compose()
            ->setFrom(\Yii::$app->params['adminEmail']) 
            ->setTo($emails)
            ->setSubject($asunto)
            //->setTextBody($asunto) 'Contenido en texto plano'
            ->setHtmlBody($mensaje) //'<b>Contenido HTML</b>'
            ->send();
  
      
  
    }
}
