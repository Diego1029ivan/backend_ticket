<?php
namespace App\Models;

    class Inventario extends Model{
        protected $table='inventario';
        public $timestamps = false;//si no tiene timestamps en la tabla(updated_at y created_at no los agrega)
    }