<?php

namespace App\Http\Controllers;

use App\Services\SvcRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $svcRequest;
    private $request;
    public function __construct(SvcRequest $svcRequest, Request $request)
    {
        $this->svcRequest = $svcRequest;
        $this->request = $request;
    }

    /***************INDEX****************/
    public function index()
    {
        $datos = $this->svcRequest->listar();

        return view("crud", ["datos" => $datos]);
    }

    /***************CREAR USUARIO****************/
    public function viewCrear(){
        return view("crear");
    }
    public function crearUsuario()
    {
        $validator = Validator::make($this->request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'cel' => 'required|numeric',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Los datos no son correctos',
                'errors' => $validator->errors(),
            ]);
        }

        $imageName = $this->request->file('image')->getClientOriginalName();
        $this->request->file('image')->move(public_path('uploads/'), $imageName);
        $imageUrl = 'uploads/' . $imageName;


        $jsonData = $this->request->except('image');
        $jsonData['image'] = $imageUrl;

        $this->svcRequest->AgregarUsuario($jsonData);

        return response()->json($jsonData);
    }

    /***************ELIMINAR USUARIO****************/
    public function eliminarUsuario()
    {
        $id = $this->request->get('id');
        if ($this->svcRequest->eliminarUsuario($id)) {
            return response()->json([
                'message' => 'Usuario eliminado correctamente'
            ]);
        } else {
            return response()->json([
                'message' => 'No se pudo eliminar el usuario'
            ]);
        }
    }

    /***************OBTENER ID DE USUARIO****************/
    public function ObtenerID()
    {
        $id = $this->request->get('id');
        $datos = $this->svcRequest->obtenerUsuario($id);
    

        return view('actualizar', ["datos" => $datos]);
    }

    /***************ACTUALIZAR USUARIO****************/
    public function actualizarUsuario()
    {
        $validator = Validator::make($this->request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'cel' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Los datos no son correctos',
                'errors' => $validator->errors(),
            ]);
        }

        $jsonData = $this->request->except('image');

        if ($this->request->hasFile('image')) {
        $imageName = $this->request->file('image')->getClientOriginalName();
        $this->request->file('image')->move(public_path('uploads/'), $imageName);
        $imageUrl = 'uploads/' . $imageName;
        
        $jsonData['image'] = $imageUrl;
        }

        $this->svcRequest->actualizarUsuario($jsonData['id'], $jsonData);

        return response()->json($jsonData);
    }

}
