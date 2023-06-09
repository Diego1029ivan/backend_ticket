<?php

app()->get("/", function () {
    response()->json(["message" => "No existe página"]);
});
app()->get("/inventario", "InventarioController@index");
app()->get("/inventario/{id}", "InventarioController@inventarioid");
app()->post("/inventario", "InventarioController@agregarinventario");
app()->delete("/inventario/{id}", "InventarioController@borrarinventario");
app()->put("/inventario/{id}", "InventarioController@actualizarinventario");

app()->get("inventarioBarra/{id}", "InventarioController@codigoBarras");
app()->get("inventarioQR/{id}", "InventarioController@codigoQR");

app()->get("/inventarioBarra/{id}", "InventarioController@codigoBarras");
app()->get("/inventarioBarraExcel/{id}", "InventarioController@codigoBarrasExcel");
app()->get("/inventarioQR/{id}", "InventarioController@codigoQR");
app()->get("/inventarioQRExcel/{codigo}/{dia}/{mes}/{year}/{nombre}", "InventarioController@codigoQRExcel");

app()->get('/ticketPDF/{codigo}', 'InventarioController@ticketPDF');
app()->get('/ticketPDFExcel/{codigo}/{dia}/{mes}/{year}', 'InventarioController@ticketPDFExcel');
app()->get('/impresionExcel/{codigo}/{dia}/{mes}/{year}/{descripcion}', 'InventarioController@impresionExcel');

app()->get('/ticketapi/{codigo}', 'InventarioController@generarPdf');


/*=======BIEN==========*/
app()->get('/bien',"RegistroController@index");
app()->get('/biencodigo/{codigo}',"RegistroController@codigoPatrimonial");
app()->post('/agregar',"RegistroController@agregar");
app()->post('/imprimir',"RegistroController@imprimirSelect");
app()->get("/inventarioQRExcel/{codigo}/{fecha}/{nombre}", "InventarioController@codigoQRselect");
