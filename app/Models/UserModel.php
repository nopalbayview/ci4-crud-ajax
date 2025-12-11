<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'email', 'gender', 'umur'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true; // Aktifkan jika ingin auto created_at/updated_at
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => 'required|max_length[255]',
        'email' => 'required|valid_email',
        'gender' => 'required',
        'umur' => 'required|integer'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getUsers($query = null)
    {
        if ($query) {
            $q = strtolower($query);
            return $this->where("LOWER(nama) LIKE '%{$q}%'", null, false)->findAll();
        }
        return $this->findAll();
    }

    public function updateUser($id, $data)
    {
        if (!$id || !$data) {
            return false;
        }
        return $this->update($id, $data); // Mengembalikan true/false
    }

    public function deleteUser($id)
    {
        if (!$id) {
            return false;
        }
        return $this->delete($id); // Mengembalikan true/false
    }

    public function saveUser($data)
    {
        if (!$data) {
            return false;
        }
        return $this->insert($data); // Mengembalikan ID atau false
    }

    public function editUser($id)
    {
        if (!$id) {
            return false;
        }
        return $this->find($id); // Mengembalikan array user atau null
    }
}