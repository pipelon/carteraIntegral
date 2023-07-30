<?php

namespace app\components;

use yii\base\Widget;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Dompdf\Dompdf;

class LiquidacionesWidget extends Widget {

    public $tipo;
    public $cliente;
    public $deudor;
    public $datos;
    public $carta;
    public $liquidacion;
    public $totalLiquidacion;
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

        /*
         * ****************************
         * EXCEL
         * ****************************
         */
        $this->crearLiquidacion();

        /*
         * ****************************
         * CARTA
         * ****************************
         */
        $this->crearCarta();
    }

    public function run() {

        switch ($this->tipo) {
            case 'vista':
                return json_encode(["carta" => $this->carta, "liquidacion" => $this->liquidacion]);
            case 'carta':
                return $this->generarCarta();
            case 'liquidacion':
                $this->generarLiquidacion();
        }
    }

    private function generarCarta() {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->carta);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream();
        exit;
    }

    private function crearCarta() {
        // ENCAEBZADO CARTA
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
                date("d", strtotime(date("Y-m-d"))),
                $this->meses[date("m", strtotime(date("Y-m-d")))],
                date("Y", strtotime(date("Y-m-d"))),
                number_format(round($this->totalLiquidacion), 2, ",", "."),
                $this->cliente->nombre,
                date("d", strtotime($en10Dias)),
                $this->meses[date("m", strtotime($en10Dias))],
                date("Y", strtotime($en10Dias)));
        //PIE DE PAGINA
        $carta .= sprintf(\Yii::$app->params["cartaLiquidacionDeuda"]["pie"],
                \yii\bootstrap\Html::img("@web/images/firma-elkin.jpg", ["width" => "100px"]));

        $this->carta = $carta;
    }

    private function generarLiquidacion() {

        $spread = new Spreadsheet();
        $sheet = $spread->getActiveSheet();

        //LOGO
        $objDrawing = new Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath("images/logo-cartera-integral-grande.jpg");
        $objDrawing->setHeight(50);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setWorksheet($sheet);

        //ENCABEZADO
        $sheet->mergeCells('A1:A3');
        $sheet->SetCellValue('B1', 'CARTERA INTEGRAL S.A.S')
                ->mergeCells('B1:J1')
                ->getStyle('B1:J1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->SetCellValue('B2', 'LIQUIDACIÓN DE DEUDA')
                ->mergeCells('B2:J2')
                ->getStyle('B2:J2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->SetCellValue('B3', 'CÓDIGO: M2GPFR02')
                ->mergeCells('B3:E3')
                ->getStyle('B3:J3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->SetCellValue('F3', 'VERSIÓN 01')->mergeCells('F3:H3');
        $sheet->SetCellValue('I3', 'PÁGINA 1')->mergeCells('I3:J3');
        $sheet->getStyle("A1:I3")->getFont()->setBold(true);

        //INFO DEL CLIENTE Y DEUDOR
        $sheet->SetCellValue('A5', 'NOMBRE CLIENTE')->mergeCells('A5:B5');
        $sheet->SetCellValue('C5', $this->cliente->nombre);
        $sheet->SetCellValue('A6', 'NOMBRE DEUDOR')->mergeCells('A6:B6');
        $sheet->SetCellValue('C6', $this->deudor->nombre);
        $sheet->SetCellValue('A7', 'NIT')->mergeCells('A7:B7');
        $sheet->SetCellValue('C7', $this->deudor->documento);
        $sheet->SetCellValue('A8', 'FECHA LIQUIDACIÓN')->mergeCells('A8:B8');
        $sheet->SetCellValue('C8', date("Y-m-d"));
        $sheet->SetCellValue('A9', 'FECHA LIQUIDACIÓN')->mergeCells('A9:B9');
        $sheet->SetCellValue('C9', $this->liquidacion["tasa"] . "%");
        $sheet->getStyle("A5:A9")->getFont()->setBold(true);

        //TABLA ENCABEZADO DE LIQUIDACION
        $sheet->SetCellValue('A11', "TÍTULO / DOCUMENTO");
        $sheet->SetCellValue('B11', "FECHA");
        $sheet->SetCellValue('C11', "FECHA VENCIMIENTO");
        $sheet->SetCellValue('D11', "DÍAS LIQUIDADOS");
        $sheet->SetCellValue('E11', "SALDO TÍTULO");
        $sheet->SetCellValue('F11', " INTERESES");
        $sheet->SetCellValue('G11', "IVA INTERESES");
        $sheet->SetCellValue('H11', "HONORARIOS");
        $sheet->SetCellValue('I11', "IVA HONORARIOS");
        $sheet->SetCellValue('J11', "TOTAL");
        $sheet->getStyle("A11:J11")->getFont()->setBold(true);

        //TABLA DE LIQUIDACION
        $rowCount = 12;
        foreach ($this->liquidacion["tabla"] as $v) {

            $sheet->setCellValueExplicit("A{$rowCount}", $v[0],
                    empty($v[0]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit("B{$rowCount}", $v[1], DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("C{$rowCount}", $v[2], DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("D{$rowCount}", $v[3],
                    empty($v[3]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit("E{$rowCount}", $v[4],
                    empty($v[4]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit("F{$rowCount}", $v[5],
                    empty($v[5]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit("G{$rowCount}", $v[6],
                    empty($v[6]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit("H{$rowCount}", $v[7],
                    empty($v[7]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit("I{$rowCount}", $v[8],
                    empty($v[8]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit("J{$rowCount}", $v[9],
                    empty($v[9]) ? DataType::TYPE_STRING : DataType::TYPE_NUMERIC);

            $rowCount++;
        }

        //FIRMA
        $objDrawingF = new Drawing();
        $objDrawingF->setName('Firma');
        $objDrawingF->setDescription('Firma');
        $objDrawingF->setPath("images/firma-elkin-2.jpg");
        $objDrawingF->setHeight(100);
        $objDrawingF->setCoordinates("A{$rowCount}");
        $objDrawingF->setWorksheet($sheet);
        $sheet->SetCellValue("A" . ($rowCount + 5), "LUIS ELKIN PÉREZ ORTIZ");
        $sheet->SetCellValue("A" . ($rowCount + 6), "Director Operativo");

        // Write a new .xlsx file
        $writer = new Xlsx($spread);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode("liquidacion.xlsx") . '"');
        $writer->save('php://output');
        exit;
    }

    /**
     * Este método indexa la pagina de la republica.co para sacar la tasa de usuara
     * NOTA: este método es delicado y propenso a fallas, si por alguna razón 
     * la republica decide cambiar su HTML la tasa de usuara no se calculará jamás
     * En ese caso se debe cambiar la plantilla de indexacion
     * @return type
     */
    private function obtenerTasaUsura() {

        //URL DONDE ESTÁ LA TASA DE USUARA QUE USUALMENTE USA ELKIN
        $url = "https://www.larepublica.co/indicadores-economicos/bancos/tasa-de-usura";

        //OBTENER EL HTML DE ESA PAGINA
        $html = file_get_contents($url);

        //DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Desactivar errores por HTML mal formado
        $dom->loadHTML($html);
        libxml_use_internal_errors(false); // Reactivar errores por HTML mal formado
        // BUSCAR LA TASA DE USUARA EN EL DIV ESPECIFICADO
        $xpath = new \DOMXPath($dom);
        $divElements = $xpath->query("//div[contains(@class, 'priceIndicator down')]//span[contains(@class, 'price')]");
        if (isset($divElements->item(0)->textContent)) {
            return floatval(str_replace(",", ".", $divElements->item(0)->textContent));
        } else {
            return 0;
        }
    }

    private function crearLiquidacion() {
        $datos = json_decode($this->datos);
        $excelFinal = [];
        $tSaldos = $tIntereses = $tIvaInteres = $tHonorarios = $tIvaHonorarios = 0;
        $tasaUsura = $this->obtenerTasaUsura();
        $tasa = $tasaUsura / 12;

        foreach ($datos as $k => $v) {
            if ($k == 0)
                continue;

            //FECHAS EN FORMATO Y-m-d
            $fechaActual = "2023-04-26"; //date("Y-m-d");
            $fechaIni = date("Y-m-d", strtotime($v[1]));
            $fechaFin = date("Y-m-d", strtotime($v[2]));

            //FECHAS EN DateTime Y RESTADAS
            $fActual = new \DateTime($fechaActual);
            $fIni = new \DateTime($fechaIni);
            $fFin = new \DateTime($fechaFin);
            $intervalo = $fActual->diff($fFin);

            //SALDO
            $saldo = floatval($v[3]);
            //TOTAL SALDOS
            $tSaldos += $saldo;

            //INTERES
            $interes = (($saldo * $tasa) / 30 * $intervalo->days) / 100;
            //TOTAL INTERESES
            $tIntereses += $interes;

            //IVA INTERESES
            $ivaInteres = $interes * 0.19;
            //TOTAL IVA INTERESES
            $tIvaInteres += $ivaInteres;

            //HONORARIOS
            $honorarios = ($saldo + $interes) * 0.1;
            //TOTAL HONORARIOS
            $tHonorarios += $honorarios;

            //IVA HONORARIOS
            $ivaHonorarios = $honorarios * 0.19;
            //TOTAL IVA HONORARIOS
            $tIvaHonorarios += $ivaHonorarios;

            //TOTAL POR FACTURA
            $totalXFactura = $saldo + $interes + $ivaInteres + $honorarios + $ivaHonorarios;

            // TOTAL LIQUIDACION
            $this->totalLiquidacion = $totalLiquidacion = $tSaldos + $tIntereses + $tIvaInteres + $tHonorarios + $tIvaHonorarios;

            $excelFinal[] = [
                $v[0],
                $v[1],
                $v[2],
                $intervalo->days,
                $v[3],
                round($interes),
                round($ivaInteres),
                round($honorarios),
                round($ivaHonorarios),
                round($totalXFactura)
            ];
        }

        $excelFinal[] = [
            "",
            "",
            "",
            "",
            round($tSaldos),
            round($tIntereses),
            round($tIvaInteres),
            round($tHonorarios),
            round($tIvaHonorarios),
            ""
        ];
        $excelFinal[] = [
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            round($totalLiquidacion)
        ];

        $this->liquidacion = ["tasa" => $tasa, "tabla" => $excelFinal];
    }

}
