<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Colonia;
use App\Models\Calle;
class ubicaciones_controller extends Controller
{
    public function obtenerColoniasId(Request $request) {
        $pkMunicipio = $request->dato;

        if ($pkMunicipio) {
            $municipio = Colonia::where('fkMunicipio', $pkMunicipio)
                 ->where('colonia.estatus', 1)
                ->orderBy('nombreColonia', 'asc') // Puedes cambiar 'asc' a 'desc' si es necesario
                ->get();
        
            return response()->json($municipio);
        } else {
            // Maneja el caso en el que el nivel educativo no se encontró
            return response()->json([]);
        }
     } 
     public function obtenerColoniasString(Request $request) {
        $nombreMunicipio = $request->dato;

        if ($nombreMunicipio) {
            $municipio = Colonia::join('municipio','municipio.pkMunicipio','=','colonia.fkMunicipio')
            ->where('municipio.nombreMunicipio', $nombreMunicipio)
            ->where('colonia.estatus', 1)
            ->orderBy('nombreColonia', 'asc') // Puedes cambiar 'asc' a 'desc' si es necesario
            ->get();
        
            return response()->json($municipio);
        } else {
            // Maneja el caso en el que el nivel educativo no se encontró
            return response()->json([]);
        }
     } 
     public function obtenerCallesId(Request $request) {
        $pkColonia = $request->dato;
        if ($pkColonia) {
            $calle = Calle::where('fkColonia', $pkColonia)
                ->where('calle.estatus', 1)
                ->orderBy('nombreCalle', 'asc') // Puedes cambiar 'asc' a 'desc' si es necesario
                ->get();
        
            return response()->json($calle);
        } else {
            // Maneja el caso en el que el nivel educativo no se encontró
            return response()->json([]);
        }
     } 
     public function obtenerCallesString(Request $request) {
        $nombreColonia = $request->dato;
        if ($nombreColonia) {
        $calle = Calle::join('colonia','colonia.pkColonia','=','calle.fkColonia')
            ->where('colonia.nombreColonia', $nombreColonia)
            ->where('calle.estatus', 1)
            ->orderBy('nombreCalle', 'asc') // Puedes cambiar 'asc' a 'desc' si es necesario
                ->get();
            return response()->json($calle);
        } else {
            // Maneja el caso en el que el nivel educativo no se encontró
            return response()->json([]);
        }
     } 

    




}