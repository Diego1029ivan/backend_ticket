<?php

namespace App\Controllers;
use App\Models\Registro_bien;


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
        
        //$bien->RUC_ENTIDAD = $objeto['RUC_ENTIDAD'];
        //$bien->ITEM=$objeto['NRO'];
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

        if (!$bien) {
            return response()->json(["message" => "Error al guardar la lista de bienes"], 500);
        }

        response()->json([
            "message" => "Tabla completa agregada",
            "bien" =>
             $bien]);

        // $json = json_encode($objeto);
        //$ruc = $objeto->RUC_ENTIDAD;
        // echo $objeto['RUC_ENTIDAD'];
        //response()->json($objeto);
    }
}