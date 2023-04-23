<?php

namespace App\Controllers;
use App\Models\Registro_bien;
use Dompdf\Dompdf;
use Dompdf\Options;
//use Fpdf\Fpdf;
//use Jurosh\PDFMerge\PDFMerger;
use iio\libmergepdf\Merger;

class RegistroController extends Controller {

    public function index() {
        $bienes = Registro_bien::all();
        response()->json($bienes);
    }

    public function codigoPatrimonial($codigo) {
        $codigo = Registro_bien::where('CODIGO_PATRIMONIAL', $codigo)->first();
        // $producto = Productos::where('idproductos', $idproductos)->get();
        // $producto = Productos::find($idproductos);

        //validar si el producto existe
        if (!$codigo) {
               return  response()->json(["message" => "Inventario no encontrado"], 404);
         }
        response()->json($codigo);
    }
   
    public function agregar(){
        $bien = new Registro_bien;
        $objeto= request()->get(['CODIGO_PATRIMONIAL','DENOMINACION_BIEN',
                                'NRO_DOCUMENTO_ADQUIS','OPC_ASEGURADO',
                                'FECHA_DOCUMENTO_ADQUIS','VALOR_ADQUIS',
                                'TIPO_CUENTA','NRO_CTA_CONTABLE',
                                'NOM_EST_BIEN','CONDICION']);

        $codigo = Registro_bien::where('CODIGO_PATRIMONIAL', $objeto['CODIGO_PATRIMONIAL'])->first();

        //$bien->RUC_ENTIDAD = $objeto['RUC_ENTIDAD'];
        //$bien->ITEM=$objeto['NRO'];
        if(!$codigo){
        $bien->CODIGO_PATRIMONIAL = $objeto['CODIGO_PATRIMONIAL'];
        $bien->DENOMINACION_BIEN = $objeto['DENOMINACION_BIEN'];
        //$bien->ACTOS_DE_ADQUISICION_QUE_GENERA_ALTA = $objeto['ACTOS_DE_ADQUISICION_QUE_GENERA_ALTA'];
        $bien->NRO_DOC_ADQUISICION = $objeto['NRO_DOCUMENTO_ADQUIS'];
        $bien->FECHA_ADQUISICION = $objeto['FECHA_DOCUMENTO_ADQUIS'];
        $bien->VALOR_ADQUISICION = $objeto['VALOR_ADQUIS'];
        //$bien->TIP_USO_CUENTA = $objeto['TIP_USO_CUENTA'];
        $bien->CTA_CON_SEGURO = $objeto['OPC_ASEGURADO'];
        $bien->TIPO_CUENTA = $objeto['TIPO_CUENTA'];
        $bien->NRO_CUENTA_CONTABLE = $objeto['NRO_CTA_CONTABLE'];
        $bien->ESTADO_BIEN = $objeto['NOM_EST_BIEN'];


        $bien->CONDICION = $objeto['CONDICION'];
        $bien->save();
        response()->json([
            "message" => "Tabla completa agregada",
            "bien" =>
             $bien]);
        }
        if (!$bien) {
            return response()->json(["message" => "Error al guardar la lista de bienes"], 500);
        }
        if($codigo){
            return response()->json(["codigo" => "mismo código"]);
        }
        

        // $json = json_encode($objeto);
        //$ruc = $objeto->RUC_ENTIDAD;
        // echo $objeto['RUC_ENTIDAD'];
        //response()->json($objeto);
    }

    public function imprimirSelect(){
        
        $objeto= request()->get(['item0','item1','item2','item3','item4']);

        $codigo0 = Registro_bien::where('CODIGO_PATRIMONIAL', $objeto['item0'])->first();
        $codigo1 = Registro_bien::where('CODIGO_PATRIMONIAL', $objeto['item1'])->first();
        $codigo2 = Registro_bien::where('CODIGO_PATRIMONIAL', $objeto['item2'])->first();
        $codigo3 = Registro_bien::where('CODIGO_PATRIMONIAL', $objeto['item3'])->first();
        $codigo4 = Registro_bien::where('CODIGO_PATRIMONIAL', $objeto['item4'])->first();

        $options = new Options();
        
        $options->set('isRemoteEnabled',TRUE);
        $dompdf0 = new Dompdf($options);
        $dompdf1 = new Dompdf($options);
        $dompdf2 = new Dompdf($options);
        $dompdf3 = new Dompdf($options);
        $dompdf4 = new Dompdf($options);
        
        

        if($codigo0!=null){
           
            $dompdf0->setPaper('10.5cm', '2.4cm', 'landscape');
            ob_start();
        
            $html = view('generarLista',['codigo'=>$codigo0->CODIGO_PATRIMONIAL,
                                         'fecha'=>$codigo0->FECHA_ADQUISICION,
                                         'descripcion'=>$codigo0->DENOMINACION_BIEN]);
            $dompdf0->loadHtml($html);
            $dompdf0->render();
            $pdf_content = $dompdf0->output();
    
    
            // Guardar el archivo PDF en la carpeta deseada
            $save_path0 = __DIR__ . '../../pdftemporal/'.$codigo0->CODIGO_PATRIMONIAL.'file.pdf'; // Ruta de la carpeta y el archivo destino
            file_put_contents($save_path0, $pdf_content);
            $listaArchivosPDF[]='../../pdftemporal/'.$codigo0->CODIGO_PATRIMONIAL.'file.pdf';
            $listaArchivosPDF2[]= $save_path0;
    
        }
        if($codigo1!=null){
            $dompdf1->setPaper('10.5cm', '2.4cm', 'landscape');
            ob_start();
        
            $html = view('generarLista',['codigo'=>$codigo1->CODIGO_PATRIMONIAL,
                                         'fecha'=>$codigo1->FECHA_ADQUISICION,
                                         'descripcion'=>$codigo1->DENOMINACION_BIEN]);
            $dompdf1->loadHtml($html);
            $dompdf1->render();
            $pdf_content = $dompdf1->output();
    
    
            // Guardar el archivo PDF en la carpeta deseada
            $save_path1 = __DIR__ . '../../pdftemporal/'.$codigo1->CODIGO_PATRIMONIAL.'file.pdf'; // Ruta de la carpeta y el archivo destino
            file_put_contents($save_path1, $pdf_content);
            $listaArchivosPDF[]='../../pdftemporal/'.$codigo1->CODIGO_PATRIMONIAL.'file.pdf';
            $listaArchivosPDF2[]= $save_path1;
    
        }
        if($codigo2!=null){
            $dompdf2->setPaper('10.5cm', '2.4cm', 'landscape');
            ob_start();
        
            $html = view('generarLista',['codigo'=>$codigo2->CODIGO_PATRIMONIAL,
                                         'fecha'=>$codigo2->FECHA_ADQUISICION,
                                         'descripcion'=>$codigo2->DENOMINACION_BIEN]);
            $dompdf2->loadHtml($html);
            $dompdf2->render();
            $pdf_content = $dompdf2->output();
    
    
            // Guardar el archivo PDF en la carpeta deseada
            $save_path2 = __DIR__ . '../../pdftemporal/'.$codigo2->CODIGO_PATRIMONIAL.'file.pdf'; // Ruta de la carpeta y el archivo destino
            file_put_contents($save_path2, $pdf_content);
            $listaArchivosPDF[]='../../pdftemporal/'.$codigo2->CODIGO_PATRIMONIAL.'file.pdf';
            $listaArchivosPDF2[]= $save_path2;
    
        }
        
        if($codigo3!=null){
            $dompdf3->setPaper('10.5cm', '2.4cm', 'landscape');
            ob_start();
        
            $html = view('generarLista',['codigo'=>$codigo3->CODIGO_PATRIMONIAL,
                                         'fecha'=>$codigo3->FECHA_ADQUISICION,
                                         'descripcion'=>$codigo3->DENOMINACION_BIEN]);
            $dompdf3->loadHtml($html);
            $dompdf3->render();
            $pdf_content = $dompdf3->output();
    
    
            // Guardar el archivo PDF en la carpeta deseada
            $save_path3= __DIR__ . '../../pdftemporal/'.$codigo3->CODIGO_PATRIMONIAL.'file.pdf'; // Ruta de la carpeta y el archivo destino
            file_put_contents($save_path3, $pdf_content);
            $listaArchivosPDF[]='../../pdftemporal/'.$codigo3->CODIGO_PATRIMONIAL.'file.pdf';
            $listaArchivosPDF2[]= $save_path3;
    
        }
        
        if($codigo4!=null){
            $dompdf4->setPaper('10.5cm', '2.4cm', 'landscape');
            ob_start();
        
            $html = view('generarLista',['codigo'=>$codigo4->CODIGO_PATRIMONIAL,
                                         'fecha'=>$codigo4->FECHA_ADQUISICION,
                                         'descripcion'=>$codigo4->DENOMINACION_BIEN]);
            $dompdf4->loadHtml($html);
            $dompdf4->render();
            $pdf_content = $dompdf4->output();
    
    
            // Guardar el archivo PDF en la carpeta deseada
            $save_path4 = __DIR__ . '../../pdftemporal/'.$codigo4->CODIGO_PATRIMONIAL.'file.pdf'; // Ruta de la carpeta y el archivo destino
            file_put_contents($save_path4, $pdf_content);
            $listaArchivosPDF[]='../../pdftemporal/'.$codigo4->CODIGO_PATRIMONIAL.'file.pdf';
            $listaArchivosPDF2[]= $save_path4;
    
        }
        
        /*===combinar===*/
        $combinador = new Merger;
        //$pdf = new FPDF();
        //echo (implode(", ", $listaArchivosPDF));
        foreach ($listaArchivosPDF2 as $archivoPDF) {
            $combinador->addFile($archivoPDF);
            
            
        }
        $salida = $combinador->merge();
        foreach ($listaArchivosPDF2 as $archivoPDF) {
            
            unlink($archivoPDF);
            
        }
        $nombreArchivo = "combinado.pdf";
        header("Content-type:application/pdf");
        header("Content-disposition: inline; filename=$nombreArchivo");
        // header("content-Transfer-Encoding:binary");
        // header("Accept-Ranges:bytes");
        # Imprimir salida luego de encabezados
        echo $salida;

        }

    
}