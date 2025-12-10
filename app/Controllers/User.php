<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends Controller
{
    protected $model;

    public function __construct() 
    {
        $this->model = new UserModel();
    }

    public function index() 
    {
        return view('user_view');
    }

    public function fetch() 
    {
        $keyword = $this->request->getGet('search');
        $data = $keyword
            ? $this->model->search($keyword)
            : $this->model->orderBy('id','ASC')->findAll();

        return $this->response->setJSON($data);
    }

    public function create() 
    {
        $data = $this->request->getPost();
        $this->model->insert($data);

        return $this->response->setJSON(['status'=>'success']);
    }

    public function edit($id) {
        return $this->response->setJSON($this->model->find($id));
    }

    public function update($id) {
        $data = $this->request->getPost();
        $this->model->update($id, $data);

        return $this->response->setJSON(['status'=>'success']);
    }

    public function delete($id) 
    {
        $this->model->delete($id);

        return $this->response->setJSON(['status'=>'success']);
    }
}
