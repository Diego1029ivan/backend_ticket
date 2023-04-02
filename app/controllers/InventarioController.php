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
                -2, 			// Width
                -5, 			// Height
                'black', 		// Color del codigo
                array(0, 0, 0, 0)	// Padding
            );

            $imageData = $bobj->getPngData(); // Obtenemos el resultado en formato PNG
            header('Content-Type: image/png');
            echo  $imageData;
    }


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




    public function ticketPDF($codigo){

        $options = new Options();
        $options->set('isRemoteEnabled',TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->setPaper('b7', 'portrait');
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
}
