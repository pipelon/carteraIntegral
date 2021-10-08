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
     * ESTA FUNCION DEBERIA FUNCIONAR SOLO PARA PREJURIDICO Y HACER OTRA PARA JURIDICO
     */
    public function actionAlertasprejuridico()
    {

        //TRAER TODOS LOS PROCESOS COMO UN OBJETO
        $procesos = \app\models\Procesos::find()
            ->where(["estado_proceso_id" => 1])
            ->all();

        //TODO: agregar condiciones para no tener en cuenta procesos terminados, castigados, cancelados, etc (preguntar Pedro)

        foreach ($procesos as $proceso) {
            //OBETENER LA FECHA DE RECEPCIÓN DE CADA PROCESO
            //$fechaR = $proceso->prejur_fecha_recepcion;
            //TODO: desarrollar la regla de negocio dependiente de la fecha de recepcion
            /*
             * TODO: En esta variable '$proceso' están todos los campos necesarios para 
             * trabajar las alertas como si se envió la carta ($proceso->prejur_carta_enviada)
             * Si se realizó la llamada ($proceso->prejur_llamada_realizada)
             * si se hizo la visita domiciliaria ($proceso->prejur_visita_domiciliaria)
             */

            /*
             * NOTA: vamos a usar el archivo params.php (/config/params.php) para la configuracion de las alertas.
             * Esto nos ayudará que el dia de mañana será muy facil deshabilitar alertas 
             * o cambiarles los dias desde un archivo central sin necesidad de
             * entrar a este codigo a hacer cambiso.
             * 
             * por ejemplo, si fueramos a procesar la alerta de la carta enviada
             * primero preguntamos si esta activada y luego obtenemos los dias configurados.
             * algo asi:
             */
            //Si la alerta para carta enviada está activa se trabaja
            if (\Yii::$app->params['alertaPREJuridico_Carta']['activo']) {
                $this->alertaPrejuridico_CartaEnviada($proceso);
            }

            //Si la alerta para llamadarealizada está activa se trabaja
            if (\Yii::$app->params['alertaPREJuridico_Llamada']['activo']) {
                $this->alertaPrejuridico_LlamadaRealizada($proceso);
            }



            /*
             * EN ESTA VARIABLE SE PUEDE HACER UNA RELACION DIRECTA CON LOS
             * PAGOS EN EL PREJURUDICO Y ASI SE PODRIA SABER SI SE PAGO A TIEMPO
             * O SI ESTA PENDIENTE POR PAGO Y ALERTAR             * 
             */
            //$consolidadoPagos = $proceso->consolidadoPagosPrejuridicos;



            //PARA USAR RELACIONES (por ejemplo los procesos tienen colaboradores)
            //SIMPLEMENTE LLAMAS A LA RELACION            
            //aca tienes la lista de ID decolaboradores
            //$colaboradores = $proceso->procesosXColaboradores;

            //LUEGO HACESUN FOREACH PARA CADA COLABORADOR Y COGES SU NOMBRE Y SU EMAIL USANDO LAS MISMAS RELACIONES ANIDADAS
            // foreach ($colaboradores as $col) {
            //     //en este caso un colaborador tiene una relacion con el usuario
            //     $nombre = $col->user->name;
            //     $email = $col->user->mail;
            //     $descripcion = "Alerta por XYZ";
            //     $this->enviarEmail($nombre, $email, $descripcion,"");
            // }
        }
    }

    private function alertaPrejuridico_CartaEnviada($proceso)
    {
        //se obtienen los dias para alertar
        $diasHabilesParaAlerta = \Yii::$app->params['alertaPREJuridico_Carta']['diasParaAlerta'];
        if ($proceso->prejur_carta_enviada == "SI") {
            return;
        }
        $hoy =  date('Y-m-d');
        $fechaAlerta = $this->hallarFechaAlerta($proceso->prejur_fecha_recepcion, $diasHabilesParaAlerta);

        if ($fechaAlerta != $hoy) {
            return;
        }

        $colaboradores = $proceso->procesosXColaboradores;
        $lider = $proceso->jefe_id;
        //LUEGO HACESUN FOREACH PARA CADA COLABORADOR Y COGES SU NOMBRE Y SU EMAIL USANDO LAS MISMAS RELACIONES ANIDADAS
        foreach ($colaboradores as $col) {
            //en este caso un colaborador tiene una relacion con el usuario
            $nombre = $col->user->name;
            $email = $col->user->mail;
            $asunto = \Yii::$app->params['alertaPREJuridico_Carta']['asunto'];
            $this->enviarEmail($nombre, $email, $asunto, "Enviar carta proceso {$proceso->id}",$col->user->id,$proceso->id);
        }
    }


    private function alertaPrejuridico_LlamadaRealizada($proceso)
    {
        //se obtienen los dias para alertar
        $diasHabilesParaAlerta = \Yii::$app->params['alertaPREJuridico_Llamada']['diasParaAlerta'];
        //ya con estos dias se hace el calculo necesario 
    }

    private function enviarEmail($nombre, $email, $asunto,$descripcion,$usuarioID,$procesoID)
    {

        //PASO 1: ENVIAR EMAIL
        //Yii::$app->mailer->compose()
            // ->setFrom(\Yii::$app->params['adminEmail'])
            // ->setTo($email)
            // ->setSubject($asunto)
            // //->setTextBody($asunto) 'Contenido en texto plano'
            // ->setHtmlBody($descripcion) //'<b>Contenido HTML</b>'
            // ->send();

        //PASO 2: guardar la alerta en la DB
        $modeloAlerta = new \app\models\Alertas();
        $modeloAlerta->usuario_id = $usuarioID;
        $modeloAlerta->proceso_id = $procesoID;
        $modeloAlerta->descripcion_alerta = $asunto;
        $modeloAlerta->save();
    }

    public function hallarFechaAlerta($fechaInicial, $dias)
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

    public function obtenerFechasNoHabiles($fechaInicial)
    {
        $diasNohabilesArray = \app\models\DiasNoHabiles::find()
            ->select("fecha_no_habil")
            ->where(['>=', 'fecha_no_habil', $fechaInicial])
            ->asArray()
            ->all();
        return array_column($diasNohabilesArray, "fecha_no_habil");
    }
}
