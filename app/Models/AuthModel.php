<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'password', 'jabatan'];


    public function cekUsername($username)
    {
        $query = $this->table($this->table)->getWhere(['username' => $username]);
        return $query;
    }

    // public function setPassword(string $pass)
    // {
    //     $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);

    //     return $this;
    // }
}
