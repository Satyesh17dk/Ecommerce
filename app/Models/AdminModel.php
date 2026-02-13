<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'login_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password'];
    protected $returnType = 'array';
}
