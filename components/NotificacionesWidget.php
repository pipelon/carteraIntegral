<?php

namespace app\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use kartik\mpdf\Pdf;


class NotificacionesWidget extends Widget {

    public $tipo;
    public $carta;
    public $codcarta;
    public $pdfNotificacionName;
    public $pathNotificacionPdf;
    public $juzgado;
    public $demandante;
    public $demandado;
    public $radicado;
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
        
        $this->pathNotificacionPdf = Yii::$app->basePath.'/web/pdfs/';
        //elegir el tipo de carta a generar
        switch ($this->codcarta) {
            case 'NotificacionAutorizacion':
                $this->carta = $this->shapeNotificacionAutorizacion();
                break;
            case 'NotificacionRelacionTitulosJudiciales':
                $this->carta = $this->shapeNotificacionRelacionTitulosJudiciales();
                break;
        }        
    }

    public function run() {

        if ($this->tipo == 'vista') {
            return $this->carta;
        } elseif ($this->tipo == 'generar') {
            $pdf = new Pdf([
                'filename' => $this->pathNotificacionPdf.$this->pdfNotificacionName,
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE,
                // A4 paper format
                'format' => Pdf::FORMAT_A4,
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT,
                // stream to browser inline
                //'destination' => Pdf::DEST_BROWSER,
                //'destination' => Pdf::DEST_BROWSER,
                'destination' => Pdf::DEST_FILE,
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
                    'SetHeader' => ['Cartera Integral'],
                    'SetFooter' => ['{PAGENO}'],
                ]
            ]);
            // return the pdf output as per the destination setting
            return $pdf->render();
            
            //enviar correo
            $this->enviarNotificacion($this->codcarta);
            
        }
    }

    private function enviarNotificacion($codCarta){
        //enviar correo
        Yii::$app->mailer->compose()
        ->setFrom(\Yii::$app->params['notificacionesJudicialesEmail'])
        ->setTo('dcastanom@gmail.com,pipe.echeverri.1@gmail.com')
        ->setSubject(\Yii::$app->params['TiposCartas'][$codCarta])
        ->attachContent($this->pathNotificacionPdf, [
            "fileName"    => $this->pdfNotificacionName,
            "contentType" => "application/pdf"
            ])
        ->send();
    }
    private function shapeNotificacionAutorizacion(){
        //asignar nombre del pdf
        $this->pdfNotificacionName = $this->codcarta.$this->demandado.date("d-m-Y").'.pdf';      

        // ENCABEZADO
        $textoCarta = sprintf(\Yii::$app->params["cartaNotificacionDeudaAutorizacion"]["encabezado"],
        \yii\bootstrap\Html::img("@web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]),
        date("d"),
        $this->meses[date("m")],
        date("Y"),
        $this->juzgado,
        $this->demandante,
        $this->demandado,
        $this->radicado);

        // CUERPO
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionDeudaAutorizacion"]["cuerpo"]);

        //PIE DE PAGINA
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionDeudaAutorizacion"]["pie"],
            \yii\bootstrap\Html::img("@web/images/firma-jhon-jairo.jpg", ["width" => "100px"]));

        return $textoCarta;
    }

    private function shapeNotificacionRelacionTitulosJudiciales(){
        //asignar nombre del pdf
        $this->pdfNotificacionName = $this->codcarta.$this->demandado.date("d-m-Y").'.pdf';
        // ENCABEZADO
        $textoCarta = sprintf(\Yii::$app->params["cartaNotificacionRelacionTitulosJudiciales"]["encabezado"],
        \yii\bootstrap\Html::img("@web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]),
        date("d"),
        $this->meses[date("m")],
        date("Y"),
        $this->juzgado,
        $this->demandante,
        $this->demandado,
        $this->radicado);

        // CUERPO
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionRelacionTitulosJudiciales"]["cuerpo"]);

        //PIE DE PAGINA
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionRelacionTitulosJudiciales"]["pie"],
            \yii\bootstrap\Html::img("@web/images/firma-jhon-jairo.jpg", ["width" => "100px"]));

        return $textoCarta;
    }
    

}
