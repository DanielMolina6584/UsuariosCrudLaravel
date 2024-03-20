<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    protected $table = 'Users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    public $timestamps = false;
    protected $fillable  = [
     'email',
     'password',
      'token'
    ];
}
