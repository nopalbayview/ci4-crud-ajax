<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index() {
        return view('user_view');
    }

    public function fetch() {
        $keyword = $this->request->getGet('search');
        $model = new UserModel();
        if($keyword) {
            $users = $model->like('nama', $keyword)
                           ->orLike('email', $keyword)
                           ->findAll();
        } else {
            $users = $model->findAll();
        }
        return $this->response->setJSON($users);
    }

    public function store() {
        $model = new UserModel();
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender'),
            'umur'   => $this->request->getPost('umur'),
        ];
        $model->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function edit($id) {
        $model = new UserModel();
        $user = $model->find($id);
        return $this->response->setJSON($user);
    }

    public function update($id) {
        $model = new UserModel();
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender'),
            'umur'   => $this->request->getPost('umur'),
        ];
        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete($id) {
        $model = new UserModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}
