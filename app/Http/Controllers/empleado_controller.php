<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;

class empleado_controller extends Controller
{
       /*fincionn de login*/
       public function login(Request $request)
       {
           $nombre = $request->input('nombreUsuario');
           $contraseña = $request->input('contraseña');
       
           $empleado = $this->buscar($nombre,$contraseña);
       
           if ($empleado) {
               // Establecer las variables de sesión
               session([
                   'id' => $empleado->pkEmpleado,
                   'nombre' => $empleado->nombreUsuario,
                   'contraseña' => $empleado->$contraseña,
                   'fkTipoUsuario' => $empleado->fkTipoUsuario
               ]);
       
               if ($empleado->fkTipoUsuario == 1 ||$empleado->fkTipoUsuario == 3 ) { // Redirigir al usuario con un mensaje de bienvenida
                   return redirect()->to( '/tuInicio')->with('success', '¡Bienvenido(a)!');
               }
               if ($empleado->fkTipoUsuario == 2) {
                   return redirect()->to('/tuInicioCobrador')->with('success', 'Bienvenido(a)');
               }
               
           } else {
               // Redirigir al usuario con un mensaje de error
               return redirect()->to('/')
               ->with('error_credentials', 'Usuario o contraseña incorrectos')
               ->with('error_retry', 'Introduzca sus datos de nuevo')
               ->with('use_js_alerts', true);
           }
       }
        /*funcion cerrar sesión*/
       public function logout() {
           Auth::logout(); 
           session()->flush();// Cierra la sesión del usuario
           return redirect('/')->with('success', 'Sesión Cerrada'); // Redirige a la página de inicio de sesión u otra página de tu elección
       }
        /*busqueda de usuario en la base de datos*/
       private function buscar($nombre, $contraseña)
       {
           $usuario = Empleado::where('nombreUsuario', $nombre)
               ->where('estatus', 1)
               ->first();
       
           if ($usuario && $contraseña == $usuario->contraseña) {
               return $usuario;
           } else {
               return null;
           }
       }
       
        /*funcion agregar usuario en la base de datos*/
       public function agregar(Request $req)
       {
           $empleado= new Empleado();
           //nombre base de datos       //nombre formulario
           $empleado->nombreEmpleado=$req->nombreEmpleado;
           $empleado->fkColonia=$req->fkColonia;
           $empleado->calle=$req->calle;
           $empleado->numCasa=$req->numCasa;
           $empleado->telefono=$req->telefono;
           $empleado->nombreUsuario=$req->nombreUsuario;
           $empleado->contraseña=$req->contraseña;
           $empleado->fkTipoUsuario=$req->fkTipoUsuario;
           $empleado->estatus=1;
           $empleado->save();
           if($empleado->pkEmpleado){
           return redirect(url('/allEmployees'))->with('success', '¡Empleado Agregado Exitosamente!');
        } else {
            return redirect(url('/allEmployees'))->with('error', 'Error en Agregacion De Empleado');
    }
          
       }
           /*funcion actualizar usuario en la base de datos*/
       public function actualizar(Request $req)
       {
           $empleado= Empleado::find($req->pkEmpleado);
           //nombre base de datos       //nombre formulario
           $empleado->nombreEmpleado=$req->nombreEmpleado;
           $empleado->fkColonia=$req->fkColonia;
           $empleado->calle=$req->calle;
           $empleado->numCasa=$req->numCasa;
           $empleado->telefono=$req->telefono;
           $empleado->nombreUsuario=$req->nombreUsuario;
           $empleado->contraseña=$req->contraseña;
           $empleado->fkTipoUsuario=$req->fkTipoUsuario;
           $empleado->save();
           if($empleado){
           return redirect(url('/allEmployees'))->with('success', '¡Actualizacion Empleado Completada!');
        } else {
            return redirect(url('/allEmployees'))->with('error', 'Error en Actualizacion de Empleado');
    }
          
       }
        /*funcion baja usuario en la base de datos*/
       public function baja(Request $req)
       {
        $empleado= Empleado::find($req->pkEmpleado);
           //nombre base de datos       //nombre formulario
           $empleado->estatus=0;
           $empleado->save();
           if($empleado){
            return redirect(url('/allEmployees'))->with('success', '¡Baja de Empleado Completada!');
        } else {
            return redirect(url('/allEmployees'))->with('error', 'Error en Baja de Empleado');
          
       }
    }
            /*funcion mostrar todos los usuarios  en la base de datos*/
       function mostrarUsuariosGeneral(){
           $datosUsuarios=Empleado::join('tipousuario', 'empleado.fkTipoUsuario', '=', 'tipousuario.pkTipoUsuario')
           ->join('colonia', 'colonia.pkColonia', '=', 'empleado.fkColonia')
           ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                       ->select('empleado.*', 'tipousuario.*','municipio.*','colonia.*')->where('empleado.estatus', '=', '1')->get();
           return view("listaEmpleados",compact("datosUsuarios"));
         }
              /*funcion actualizar usuario especifico en la base de datos*/
         function mostrarUsuarioPorId($pkEmpleado, $vista = "detalleEmpleado"){
           $dato=Empleado::join('tipousuario', 'empleado.fkTipoUsuario', '=', 'tipousuario.pkTipoUsuario')
           ->join('colonia', 'colonia.pkColonia', '=', 'empleado.fkColonia')
           ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                       ->select('empleado.*', 'tipousuario.*','municipio.*','colonia.*')->where('empleado.estatus', '=', '1')->where('empleado.pkEmpleado', '=', $pkEmpleado)->first();
                       return view($vista,compact("dato"));
         }
         function mostrarSoloCobradores(){
            $datosUsuarios=Empleado::join('tipousuario', 'empleado.fkTipoUsuario', '=', 'tipousuario.pkTipoUsuario')
            ->join('colonia', 'colonia.pkColonia', '=', 'empleado.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                        ->select('empleado.*', 'tipousuario.*','municipio.*','colonia.*')->where('empleado.estatus', '=', '1')->where('empleado.fkTipoUsuario', '=', '2')->get();
            return view("listaCobradores",compact("datosUsuarios"));
          }
   
}
