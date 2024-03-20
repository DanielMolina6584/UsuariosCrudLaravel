<?php

namespace App\Services;

use App\Models\LoginModel;
use App\Models\UserModel;


class SvcRequest
{
    private $userModel;
    private $loginModel;

    public function __construct(UserModel $userModel, LoginModel $loginModel)
    {
        $this->userModel = $userModel;
        $this->loginModel = $loginModel;
    }
    //LOGIN
    public function registrarUsuario($data)
    {
        $this->loginModel->fill($data);
        return $this->loginModel->save();
    }
    public function IniciarSesion($email, $password)
    {
        return $this->loginModel->where("email", $email)->first();
    }
    //USUARIOS

    public function listar()
    {
        return $this->userModel->all();
    }
    public function AgregarUsuario($data)
    {
        $this->userModel->fill($data);

        return $this->userModel->save();
    }
    public function eliminarUsuario($id)
    {
        return $this->userModel->where('id', $id)->delete();
    }
    public function obtenerUsuario($id)
    {
        return $this->userModel->select('id', 'nombre', 'apellido', 'email', 'cel', 'image')
            ->where('id', $id)->first();
    }
    public function actualizarUsuario($id, $data)
    {
        return $this->userModel->find($id)->update($data);
    }

    // TOKEN 
    public function validarToken($token)
    {
        $tok = $this->loginModel->where('token', $token)->first();

        if (!empty ($tok)) {
            return true;
        } else {
            return false;
        }
    }
}