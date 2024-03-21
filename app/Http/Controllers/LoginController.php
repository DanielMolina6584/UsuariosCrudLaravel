<?php

namespace App\Http\Controllers;

use App\Services\SvcRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
     private $svcRequest;
     private$request;
     public function __construct(SvcRequest $svcRequest, Request $request)
     {
          $this->svcRequest = $svcRequest; 
          $this->request = $request;    
     }

     public function index()
     {
          return view("login");
     }
     public function viewRegister(Request $request)
     {
          return view("register");
     }
     
     public function registrar()
     {
          $validator = Validator::make($this->request->all(), [
               'email' => 'required|email',
               'password' => 'required|min:8',
          ]);

          if ($validator->fails()) {
               return response()->json([
                    'error' => 'Los datos no son válidos',
                    'errors' => $validator->errors(),
               ]);
          }

          $jsonData =$this->request->all();
          $password = $jsonData['password'];

          $hash = Hash::make($password);
          $jsonData['token'] = bin2hex(random_bytes(16));
          $jsonData['password'] = $hash;

          $this->svcRequest->registrarUsuario($jsonData);
          return response()->json($jsonData);
     }

     public function IniciarSesion()
     {
          $validator = Validator::make($this->request->all(), [
               'email' => 'required|email',
               'password' => 'required|min:8',
          ]);

          if ($validator->fails()) {
               return response()->json([
                    'error' => 'Los datos no son válidos',
                    'errors' => $validator->errors(),
               ]);
          }

          $jsonData = $this->request->all();
          $email = $jsonData['email'];
          $password = $jsonData['password'];


          $resultado = $this->svcRequest->IniciarSesion($email, $password);
          
          if (!empty ($resultado) && password_verify($password, $resultado['password'])) {
               session()->put('token', $resultado['token']);

               return response()->json($resultado);
          }else {
               return response()->json([
                   'errors' => ['Datos incorrectos']
               ]);
           }
     }

     public function logout()
     {
         session()->forget('token');
     
     }
}
