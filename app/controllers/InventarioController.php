<?php

namespace App\Controllers;
use App\Models\Inventario;

use Dompdf\Dompdf;
use Dompdf\Options;

include_once "./vendor/autoload.php";

class InventarioController extends Controller {

    public function index() {
        $inventarios = Inventario::all();
        response()->json($inventarios);
    }

    public function inventarioid($idinventario) {
        $inventario = Inventario::where('idinventario', $idinventario)->first();
        // $producto = Productos::where('idproductos', $idproductos)->get();
        // $producto = Productos::find($idproductos);

        //validar si el producto existe
        if (!$inventario) {
               return  response()->json(["message" => "Inventario no encontrado"], 404);
         }
        response()->json($inventario);
    }


public function agregarinventario() {
        $inventario = new Inventario;
        $inventario->nombre = app()->request()->get('nombre');
        $inventario->codigo = app()->request()->get('codigo');
        $inventario->fecha = app()->request()->get('fecha');
        $inventario->ubicacion = app()->request()->get('ubicacion');
        $inventario->correlativo = app()->request()->get('correlativo');
        $inventario->save();
        // validar si el producto se guardo
        if (!$inventario) {
            return response()->json(["message" => "Error al guardar el inventario"], 500);
        }

        response()->json([
            "message" => "Inventario agregado",
            "inventario" =>
             $inventario]);
    }

    public function borrarinventario($idinventario) {
        // $producto = Productos::find($idproductos);
         $inventario = Inventario::where('idinventario', $idinventario)->first();

        //validar si el producto existe
        if (!$inventario) {
               return  response()->json(["message" => "inventario no encontrado"], 404);
         }
        //borrar idproductos de la tabla productos
         $inventario = Inventario::where('idinventario', $idinventario)->delete();
        //  $producto->delete();
        response()->json(["message" => "inventario eliminado"]);
    }
  public function actualizarinventario($idinventario) {
        // $producto = Productos::find($idproductos);
         $inventario = Inventario::where('idinventario', $idinventario)->first();

        //validar si el producto existe
        if (!$inventario) {
               return  response()->json(["message" => "Inventario no encontrado"], 404);
         }
        //actualizar idproductos de la tabla productos
         $inventario = Inventario::where('idinventario', $idinventario)->update([
            "nombre" => app()->request()->get('nombre') ? app()->request()->get('nombre') : $inventario->nombre,
            "fecha" => app()->request()->get('fecha') ? app()->request()->get('fecha') : $inventario->fecha,
            "ubicacion" => app()->request()->get('ubicacion') ? app()->request()->get('ubicacion') : $inventario->ubicacion,
            "codigo" => app()->request()->get('codigo') ? app()->request()->get('codigo') : $inventario->codigo,
            "correlativo" => app()->request()->get('correlativo') ? app()->request()->get('correlativo') : $inventario->correlativo
        ]);
        response()->json(["message" => "Invetario actualizado"]);
    }
/*======================Generar barras====================================*/
    //functio permite crear env
    public function codigoBarras($codigo) {


          $inventario = Inventario::where('codigo', $codigo)->first();
  //convertir a string
        if (empty($inventario)) {
               return  response()->json(["message" => "Inventario no encontrado"], 404);
         }
         $inventariobR = (string)$inventario->codigo;
         $barcode = new \Com\Tecnick\Barcode\Barcode();

            $bobj = $barcode->getBarcodeObj(
                "PDF417", 			// Tipo de Barcode o Qr
                $inventariobR, 	// Datos
                -1, 			// Width
                -3, 			// Height
                'black', 		// Color del codigo
                array(0, 0, 0, 0)	// Padding
            );

            $imageData = $bobj->getPngData(); // Obtenemos el resultado en formato PNG
            header('Content-Type: image/png');
            echo  $imageData;
    }

    public function codigoBarrasExcel($codigo) {

       $barcode = new \Com\Tecnick\Barcode\Barcode();

          $bobj = $barcode->getBarcodeObj(
              "PDF417", 			// Tipo de Barcode o Qr
              $codigo, 	// Datos
              -2, 			// Width
              -5, 			// Height
              'black', 		// Color del codigo
              array(0, 0, 0, 0)	// Padding
          );

          $imageData = $bobj->getPngData(); // Obtenemos el resultado en formato PNG
          header('Content-Type: image/png');
          echo  $imageData;
  }

/*======================Generar QR====================================*/
    public function codigoQR($codigo) {
        $inventario = Inventario::where('codigo', $codigo)->first();
        //validar si el producto existe
        if (empty($inventario)) {
            return  response()->json(["message" => "Inventario no encontrado"], 404);
      }
      $inventariobR = (string)$inventario->codigo;

        $barcode = new \Com\Tecnick\Barcode\Barcode();

        $bobj = $barcode->getBarcodeObj(
            'QRCODE,H',                     // Tipo de Barcode o Qr
            $inventariobR,          // Datos
            -2,                             // Width
            -2,                             // Height
            'black',                        // Color del codigo
            array(-2, -2, -2, -2)           // Padding
            )->setBackgroundColor('white'); // Color de fondo

        $imageData = $bobj->getPngData(); // Obtenemos el resultado en formato PNG
        header('Content-Type: image/png');
        echo  $imageData;
        //file_put_contents('qrcode.png', $imageData); // Guardamos el resultado
    }

    public function codigoQRExcel($codigo,$dia,$mes,$year,$nombre) {

        $barcode = new \Com\Tecnick\Barcode\Barcode();
        // Crea una lista de información
        $infoList = array(
            'Codigo' => $codigo,
            'Fecha' => $dia."-".$mes."-".$year,
            'Descripcion' => $nombre
        );
      //convertir en

        $jsonInfo = json_encode($infoList);

        $bobj = $barcode->getBarcodeObj(
            'QRCODE,H',                     // Tipo de Barcode o Qr
            $jsonInfo,          // Datos
            -1,                             // Width
            -1,                             // Height
            'black',                        // Color del codigo
            array(0, 0, 0, 0)           // Padding
            )->setBackgroundColor('white'); // Color de fondo

        $imageData = $bobj->getPngData(); // Obtenemos el resultado en formato PNG

        header('Content-Type: image/png');

        echo  $imageData;
        //file_put_contents('qrcode.png', $imageData); // Guardamos el resultado
    }


/*======================Generar ticket PDF====================================*/

    public function ticketPDF($codigo){

        $options = new Options();
        $options->set('isRemoteEnabled',TRUE);
        $dompdf = new Dompdf($options);
        //    $dompdf->setPaper(array(1, 1, 12, 8), 'portrait');
        $dompdf->setPaper(array(0.2, -1, 12, 5), 'portrait');
        ob_start();
        $inventario = Inventario::where('codigo', $codigo)->first();
        //echo $inventario;


        $html = view('generar_ticket',['codigo'=>$codigo,

                                       'inventario'=>$inventario]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=ticket".$codigo.".pdf");

        echo $dompdf->output();
    }

    public function ticketPDFExcel($codigo,$dia,$mes,$year){

        $options = new Options();
        $options->set('isRemoteEnabled',TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper(array(-1, -1, 108, 72), 'portrait');
        ob_start();

        $html = view('generar_ticket_excel',['codigo'=>$codigo,
                                             'dia'=>$dia,
                                             'mes'=>$mes,
                                             'year'=>$year]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=ticket".$codigo.".pdf");

        echo $dompdf->output();
    }

     public function generarPdf($codigo) {
        $inventario = Inventario::where('codigo', $codigo)->first();
     $inventariobR = (string)$inventario->codigo;

        $barcode = new \Com\Tecnick\Barcode\Barcode();

            $bobj = $barcode->getBarcodeObj(
                "PDF417", 			// Tipo de Barcode o Qr
                $inventariobR, 	// Datos
                -2, 			// Width
                -5, 			// Height
                'black', 		// Color del codigo
                array(0, 0, 0, 0)	// Padding
            );

        $imageData = $bobj->getPngData(); // Obtenemos el resultado en formato PNG
        header('Content-Type: image/png');

    // Crear el archivo PDF con Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled',TRUE);
        $dompdf = new Dompdf($options);
        // $dompdf->setPaper('b7', 'portrait');
        $dompdf->setPaper(array(-1, -1, 108, 72), 'portrait');
        ob_start();

// Agregar el contenido del PDF
// styles css

// $html='<body style="margin:0; padding: 0;box-sizing: border-box;">';
// $html.='<div ">';
// $html = '<span style="font-size: 4px;  padding: 0;">Universidad Nacional de San Martin</span>';
// $html.='<div ">';
// $html .= '<img  style="display: block;" src="data:image/png;base64,' . base64_encode($imageData) . '"/>';
// $html .= '</div>';
// $html .= '<span style="font-size: 4px;" >'.$inventario['codigo'].'</span>';
// $html .= '</div>';
// $html .= '</body>';

$html='<body style="box-sizing: inherit;  font-family:  serif; margin: 0;  padding: 0;" >';
  $html.='<div  style="max-width: 144px; width: 90%; margin: 8 auto;">';
   $html.='<div style=" position:  relative; margin-bottom: 6px;">';
  $html.='<div >';
     $html.='<h1 style="font-size: 2px; position: absolute;     top: 0;">Universidad Nacional de San Martin</h1>';
     $html.='</div>';
    $html.='<div>';
       $html.=' <img  src="https://unsm.edu.pe/wp-content/uploads/2016/10/cropped-logo-ICONO.png" alt="logo" style="max-width:10%;   max-width: 100%; display: block; height: auto; margin: 0 auto;   position: absolute;
    top: 0;
    right: 0;"></div>';
     $html.='</div>';
         $html.='<div  style=" display: flex;  align-items: center; justify-content: center;     flex-direction: column;    gap: 0;">';
             $html.='<div class="col-3">';
           $html .= '<img  style="  max-width: 100%;  display: block;  height: auto; margin: 0 auto; " src="data:image/png;base64,' . base64_encode($imageData) . '"/>';
             $html .= '</div>';
             $html .= '<div class="ticket-position">';
    $html .= '<span style="font-size: 4px;" >'.$inventario['codigo'].'</span>';
        $html .= ' </div>';

         $html .= '</div>';
     $html .= '</div>';
 $html .= '</body>';





$dompdf->loadHtml($html);

$dompdf->render();

// Descargar el archivo PDF generado
$dompdf->stream("codigo-de-barras.pdf", array("Attachment" => false));
    }




    public function impresionExcel($codigo,$dia,$mes,$year,$descripcion){

        $options = new Options();

        $options->set('isRemoteEnabled',TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper('10.5cm', '2cm', 'landscape');




        ob_start();

        $html = view('generar_ticket_excel2',['codigo'=>$codigo,
                                                'dia'=>$dia,
                                                'mes'=>$mes,
                                                'year'=>$year,
                                                'descripcion'=>$descripcion]);
        $dompdf->loadHtml($html);
        $dompdf->render();
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename=ticket".$codigo.".pdf");

        echo $dompdf->output();
    }



}
