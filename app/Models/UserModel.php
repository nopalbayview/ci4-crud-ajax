<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'gender', 'umur'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword) 
    {
        return $this->like('nama', $keyword)
                    ->orLike('email', $keyword)
                    ->orLike('gender', $keyword)
                    ->orderBy('id','ASC')
                    ->findAll();
    }                
}    