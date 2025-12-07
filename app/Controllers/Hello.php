<?php
namespace App\Controllers;

class Hello extends BaseController
{
    public function index()
    {
        $data['nama'] = "Uyab";
        return view('hello_view', $data);          
    }
}
