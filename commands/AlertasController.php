<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Test controller
 */
class AlertasController extends Controller {

    public function actionIndex() {
        
        //TRAER TODOS LOS PROCESOS COMO UN OBJETO
        $procesos  = \app\models\Procesos::find()
                ->all();        
        
        foreach ($procesos as $proceso) {            
            //OBETENER LA FECHA DE RECEPCIÓN DE CADA PROCESO
            $fechaR = $proceso->prejur_fecha_recepcion;  
            
            //PARA USAR RELACIONES (por ejemplo los procesos tienen colaboradores)
            //SIMPLEMENTE LLAMAS A LA RELACION            
            //aca tienes la lista de ID decolaboradores
            $colaboradores = $proceso->procesosXColaboradores;
            
            //LUEGO HACESUN FOREACH PARA CADA COLABORADOR Y COGES SU NOMBRE Y SU EMAIL USANDO LAS MISMAS RELACIONES ANIDADAS
            foreach ($colaboradores as $col) {
                //en este caso un colaborador tiene una relacion con el usuario
                $nombre = $col->user->name;
                $email = $col->user->mail;      
                $descripcion = "Alerta por XYZ";
                $this->enviarEmail($nombre, $email, $descripcion);
            }
        }
    }

    private function enviarEmail($nombre, $email, $descripcion) {
        echo "Sending mail to " . $nombre;
    }

}
