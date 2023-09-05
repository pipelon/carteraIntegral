<?php

namespace app\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use Dompdf\Dompdf;
use Dompdf\Options;

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
            case 'Autorizacion':
                $this->carta = $this->shapeNotificacionAutorizacion();
                break;
            case 'RelacionTitulosJudiciales':
                $this->carta = $this->shapeNotificacionRelacionTitulosJudiciales();
                break;
        }        
    }

    public function run() {

         switch ($this->tipo) {
            case 'vista':
                return $this->carta;
                break;
            case 'generar':
                return $this->generarPdf('generar');
                break;
            case 'enviar-email':
                $this->enviarNotificacion($this->codcarta);
                return $this->generarPdf('enviar-email');
                break;
            case 'form-correo':
                return $this->generarPdf('form-correo');
                break;
        }        
        
    }

    private function generarPdf($destination) {
        
        try {
            $options = new Options();
            //Y debes activar esta opción "TRUE"
            $options->set('isRemoteEnabled', true);
            $options->set('defaultFont', 'Arial');
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($this->carta);
            // Render the HTML as PDF
            $dompdf->render();
            if ($destination == 'generar'){
                // Output the generated PDF to Browser
                $dompdf->stream($this->pdfNotificacionName);
                exit;
            } elseif($destination == 'form-correo'){
                $rutaPdfs = $this->pathNotificacionPdf;
                $nombreArchivo = $this->pdfNotificacionName;
                $contenido = $dompdf->output();
                $bytes = file_put_contents($rutaPdfs.$nombreArchivo, $contenido);
                //$out = $this->enviarNotificacion($this->codcarta);
                return  $nombreArchivo;
            } 
        } catch (Exception $ex) {
            return 'El archivo de carta no se generó. Error: '. $ex->getMessage();
        }       
    }

    private function enviarNotificacion($codCarta){
 
        //enviar correo
        try {
            Yii::$app->mailer->compose()
            ->setFrom(\Yii::$app->params['notificacionesJudicialesEmail'])
            ->setTo(\Yii::$app->params['adminEmail'])
            ->setSubject(\Yii::$app->params['TiposCartas'][$codCarta]." proceso ".$this->demandado)
            ->attach($this->pathNotificacionPdf.$this->pdfNotificacionName)
            ->send();
            return  'El correo se envió';
        } catch (Exception $ex) {
            return 'El correo no se envió. Error: '. $ex->getMessage();
        }        
    }  

    private function shapeNotificacionAutorizacion(){
        //asignar nombre del pdf
        $this->pdfNotificacionName = $this->codcarta.$this->demandado.date("d-m-Y").'.pdf';      

        // ENCABEZADO
        $textoCarta = sprintf(\Yii::$app->params["cartaDeudaAutorizacion"]["encabezado"],
        \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]),
        date("d"),
        $this->meses[date("m")],
        date("Y"),
        $this->juzgado,
        $this->demandante,
        $this->demandado,
        $this->radicado);

        // CUERPO
        $textoCarta .= sprintf(\Yii::$app->params["cartaDeudaAutorizacion"]["cuerpo"]);

        //PIE DE PAGINA
        $textoCarta .= sprintf(\Yii::$app->params["cartaDeudaAutorizacion"]["pie"],
            \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/firma-jhon-jairo.jpg", ["width" => "100px"]));

        return $textoCarta;
    }

    private function shapeNotificacionRelacionTitulosJudiciales(){
        //asignar nombre del pdf
        $this->pdfNotificacionName = $this->codcarta.$this->demandado.date("d-m-Y").'.pdf';
        // ENCABEZADO
        $textoCarta = sprintf(\Yii::$app->params["cartaRelacionTitulosJudiciales"]["encabezado"],
        \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]),
        date("d"),
        $this->meses[date("m")],
        date("Y"),
        $this->juzgado,
        $this->demandante,
        $this->demandado,
        $this->radicado);

        // CUERPO
        $textoCarta .= sprintf(\Yii::$app->params["cartaRelacionTitulosJudiciales"]["cuerpo"]);

        //PIE DE PAGINA
        $textoCarta .= sprintf(\Yii::$app->params["cartaRelacionTitulosJudiciales"]["pie"],
            \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/firma-jhon-jairo.jpg", ["width" => "100px"]));

        return $textoCarta;
    }

}