<?php

app()->get("/", function () {
    response()->json(["message" => "Hola MUNDO"]);
});
app()->get("/inventario", "InventarioController@index");
app()->get("/inventario/{id}", "InventarioController@inventarioid");
app()->post("/inventario", "InventarioController@agregarinventario");
app()->delete("/inventario/{id}", "InventarioController@borrarinventario");
app()->put("/inventario/{id}", "InventarioController@actualizarinventario");
app()->get("inventarioBarra/{id}", "InventarioController@codigoBarras");
app()->get("inventarioQR/{id}", "InventarioController@codigoQR");
app()->get("/inventarioBarra/{id}", "InventarioController@codigoBarras");
app()->get("/inventarioQR/{id}", "InventarioController@codigoQR");

app()->get('/ticketPDF/{codigo}', 'InventarioController@ticketPDF');
app()->get('/ticketapi/{codigo}', 'InventarioController@generarPdf');
