<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends Controller
{
    public function index() {
        return view('user_view');
    }

    public function fetch() {
        $keyword = $this->request->getGet('search');
        $model = new UserModel();

        if($keyword){
            $data = $model->like('nama', $keyword)
                          ->orLike('email', $keyword)
                          ->orLike('gender', $keyword)
                          ->orderBy('id','ASC')
                          ->findAll();
        } else {
            $data = $model->orderBy('id','ASC')->findAll();
        }
        return json_encode($data);
    }

    public function create() {
        $model = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender')
        ];
        $model->insert($data);
        return json_encode(['status'=>'success']);
    }

    public function edit($id) {
        $model = new UserModel();
        $data = $model->find($id);
        return json_encode($data);
    }

    public function update($id) {
        $model = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'gender' => $this->request->getPost('gender')
        ];
        $model->update($id, $data);
        return json_encode(['status'=>'success']);
    }

    public function delete($id) {
        $model = new UserModel();
        $model->delete($id);
        return json_encode(['status'=>'success']);
    }
}
