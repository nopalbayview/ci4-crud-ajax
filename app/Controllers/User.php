<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function index()
    {
        return view('user_view');
    }

    public function fetch() 
    {
        $query = $this->request->getVar('query');
        $model = new UserModel();
        $data = $model->getUsers($query);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $model = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender'),
            'umur' => $this->request->getPost('umur'),
        ];

        if ($model->updateUser($id, $data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'errors' => $model->errors()]);
        }
    }

    public function delete($id)
    {
        $model = new UserModel();
        if ($model->deleteUser($id)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus user']);
        }
    }

    public function store()
    {
        $model = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender'),
            'umur' => $this->request->getPost('umur'),
        ];

        // Hapus validasi manual, gunakan Model
        if ($model->saveUser($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'errors' => $model->errors()]);
        }
    }

    public function edit($id) 
    {
        $model = new UserModel();
        $data = $model->editUser($id);
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }
    }
}