<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use kartik\mpdf\Pdf;

class LiquidacionesWidget extends Widget {

    public $tipo;
    public $cliente;
    public $deudor;
    public $factura;
    public $fecha_inicio;
    public $fecha_fin;
    public $saldo;
    public $carta;
    public $liquidacion;
    private $meses = [
        "01" => "enero",
        "02" => "febrero",
        "03" => "marzo",
        "04" => "abril",
        "05" => "mayo",
        "06" => "junio",
        "07" => "julio",
        "08" => "agosto",
        "09" => "septiembre",
        "10" => "octubre",
        "11" => "noviembre",
        "12" => "diciembre"
    ];

    public function init() {
        parent::init();
        
        // ENCAEBZADO
        $carta = sprintf(\Yii::$app->params["cartaLiquidacionDeuda"]["encabezado"],
                \yii\bootstrap\Html::img("@web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]),
                date("d"),
                $this->meses[date("m")],
                date("Y"),
                $this->deudor->nombre,
                $this->deudor->direccion,
                $this->deudor->telefono_representante_legal,
                $this->deudor->ciudad);
        
        // CUERPO
        $en10Dias = date("Y-m-d", strtotime(date("Y-m-d") . "+ 10 days"));
        $carta .= sprintf(\Yii::$app->params["cartaLiquidacionDeuda"]["cuerpo"],
                date("d"),
                $this->meses[date("m")],
                date("Y"),
                $this->cliente->nombre,
                date("d", strtotime($this->fecha_fin)),
                $this->meses[date("m", strtotime($this->fecha_fin))],
                date("Y", strtotime($this->fecha_fin)),
                number_format($this->saldo, 2, ",", "."),
                $this->cliente->nombre,
                date("d", strtotime($en10Dias)),
                $this->meses[date("m", strtotime($en10Dias))],
                date("Y", strtotime($en10Dias)));
        //PIE DE PAGINA
        $carta .= sprintf(\Yii::$app->params["cartaLiquidacionDeuda"]["pie"],
                \yii\bootstrap\Html::img("@web/images/firma-elkin.jpg", ["width" => "100px"]));
        
        $this->carta = $carta;
    }

    public function run() {

        if ($this->tipo == 'vista') {
            return $this->carta;
        } elseif ($this->tipo == 'generar') {
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE,
                // A4 paper format
                'format' => Pdf::FORMAT_A4,
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT,
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER,
                // your html content input
                'content' => $this->carta,
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}',
                // set mPDF properties on the fly
                'options' => ['title' => 'Krajee Report Title'],
                // call mPDF methods on the fly
                'methods' => [
                    'SetHeader' => ['Krajee Report Header'],
                    'SetFooter' => ['{PAGENO}'],
                ]
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }
    }

}
